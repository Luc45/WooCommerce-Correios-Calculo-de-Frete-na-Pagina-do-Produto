<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Traits\ValidationRules;
use WC\SmoothGenerator\Generator\Product;

class CostsTest extends \Codeception\TestCase\WPTestCase
{
    use \TraitCostsTests;

    /** @var \WC_Product */
    protected $default_product;

    /** @var \CFPP\Shipping\Payload */
    protected $default_payload;

    /** @var \WC_Shipping_Zone */
    protected $default_shippingzone;

    public function setUp()
    {
        parent::setUp();

        if (empty($this->default_shippingzone)) {
            $this->default_shippingzone = $this->generateShippingZone();
        }
        if (empty($this->default_product)) {
            $this->default_product = Product::generate_simple_product(30, 30, 30, 30, 30);
        }

        $this->setOriginPostcode('30360-230');

        if (empty($this->default_payload)) {
            $this->default_payload = Payload::makeFrom($this->default_product, 30360230, 1, null);
        }

    }

    public function tearDown()
    {
        // Deletes all shipping methods from the default shipping zone
        $shipping_methods = $this->default_shippingzone->get_shipping_methods();
        foreach ($shipping_methods as $id => $shipping_method) {
            $this->default_shippingzone->delete_shipping_method($id);
        }
        parent::tearDown();
    }

    /**
     * PackageException::invalid_package should throw if
     * invalid product dimensions provided
     */
    public function test_package_exception_throws_if_invalid_product_dimensions()
    {
        $this->default_shippingzone->add_shipping_method('correios-pac');
        $shipping_methods = $this->default_shippingzone->get_shipping_methods();

        $product = Product::generate_simple_product(-1, 30, 30, 30, 30);
        $payload = Payload::makeFrom($product, 30360230, 1, null);

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('error', $cost[0]['status']);
        $this->assertEquals('501', $cost[0]['error_code']);
    }

    /**
     * FactoryException::handler_not_found_exception should throw if
     * not supported shipping method requested
     */
    public function test_factory_exception_throws_if_shipping_method_not_supported()
    {
        $this->default_shippingzone->add_shipping_method('correios-impresso-normal');
        $shipping_methods = $this->default_shippingzone->get_shipping_methods();

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $this->default_payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('error', $cost[0]['status']);
        $this->assertEquals('202', $cost[0]['error_code']);
    }

    /**
     * FactoryException::invalid_custom_handler_exception should throw if
     * an invalid custom handler is provided through add_filter
     */
    public function test_factory_exception_throws_if_custom_handler_provided()
    {
        $this->default_shippingzone->add_shipping_method('correios-pac');
        $shipping_methods = $this->default_shippingzone->get_shipping_methods();

        add_filter('cfpp_custom_handler_wc_correios_shipping_pac', function() {
            return 'foo';
        });

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $this->default_payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('error', $cost[0]['status']);
        $this->assertEquals('201', $cost[0]['error_code']);
    }

    /**
     * ValidationErrorException::validation_error should throw if
     * a validation rule for a specific shipping method fails
     * according to payload dimensions or total cost
     */
    public function test_validation_exception_throws_if_invalid_dimensions()
    {
        $this->default_shippingzone->add_shipping_method('correios-pac');
        $shipping_methods = $this->default_shippingzone->get_shipping_methods();

        $product_height = rand(1, 1000);
        $min_height = $product_height + 1;

        $product = Product::generate_simple_product($product_height, 30, 30, 30, 30);
        $payload = Payload::makeFrom($product, 30360230, 1, null);

        add_filter('cfpp_handler_rules_wc_correios_shipping_pac', function(ValidationRules $rules) use ($min_height) {
            $rules->setMin('height', $min_height);
            return $rules;
        });

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('error', $cost[0]['status']);
        $this->assertContains((string) $min_height, $cost[0]['debug']);
        $this->assertEquals('1001', $cost[0]['error_code']);
    }

}