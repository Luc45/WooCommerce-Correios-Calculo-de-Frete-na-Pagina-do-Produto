<?php
namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Exceptions\ValidationErrorException;
use CFPP\Shipping\Costs;
use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Traits\ValidationRules;
use WC\SmoothGenerator\Generator\Product;

class CorreiosThroughWebServiceTest extends \Codeception\TestCase\WPTestCase
{
    use \TraitCostsTests;

    protected $shipping_zone;

    public function setUp()
    {
        parent::setUp();

        // Creates Shipping Zone
        $shipping_zone = $this->generateShippingZone();
        $shipping_zone->set_zone_locations([
            'type' => 'country',
            'code' => 'BR'
        ]);
        $this->shipping_zone = $shipping_zone;

        // Registers Origin Postcode
        add_filter('woocommerce_countries_base_postcode', function() {
            return '30360-230';
        });
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test a valid response is returned with a valid payload
     *
     * @throws \CFPP\Exceptions\PayloadException
     */
    public function test_correios_webservice_returns_success()
    {
        $this->shipping_zone->add_shipping_method('correios-pac');
        $shipping_methods = $this->shipping_zone->get_shipping_methods();

        $product = Product::generate_simple_product(30, 30, 30, 30, 30);
        $payload = Payload::makeFrom($product, 30360230, 1, null);

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('success', $cost[0]['status']);
    }

    /**
     * Tests an error response is returned if dimension rules are not met
     *
     * @throws \CFPP\Exceptions\PayloadException
     */
    public function test_correios_webservice_returns_error_if_invalid_dimensions()
    {
        $this->shipping_zone->add_shipping_method('correios-sedex');
        $shipping_methods = $this->shipping_zone->get_shipping_methods();

        $product = Product::generate_simple_product(30, 30, 30, 30, 30);
        $payload = Payload::makeFrom($product, 30360230, 1, null);

        add_filter('cfpp_handler_rules_wc_correios_shipping_sedex', function(ValidationRules $rules) {
            $rules->setMin('height', 50);
            return $rules;
        });

        $cost = Costs::getCostPerShippingMethod($shipping_methods, $payload);

        $this->assertCount(1, $cost);
        $this->assertEquals('error', $cost[0]['status']);
        $this->assertContains('50', $cost[0]['debug']);
    }

}