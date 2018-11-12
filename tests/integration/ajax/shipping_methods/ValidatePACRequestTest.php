<?php

use function Helper\clearAndCreateShippingZone;

/**
 * AbstractAjax holds basic structure for these Ajax tests, and Data Providers.
 */
require_once(__DIR__ . '/../AbstractAjax.php');

class ValidatePACRequestTest extends AbstractAjax
{
    /** @var \WC_Shipping_Zone instance */
    protected $shipping_zone;

    /** @var $_POST['data'] */
    protected $data;

    /** @var \CFPP\Shipping\ShippingMethods instance */
    protected $cfpp_shipping_methods;

    public function setUp()
    {
        // before
        parent::setUp();

        // Copy of default values
        $this->data = $_POST['data'];

        // Clears all shipping zones and create one for test
        $this->shipping_zone = clearAndCreateShippingZone();
        $shipping_method_id = $this->shipping_zone->add_shipping_method( 'correios-pac' );
        $shipping_method = new \WC_Correios_Shipping_PAC($shipping_method_id);
        if (!$shipping_method->update_option('origin_postcode', '30360230')) {
            $this->markTestSkipped('Couldn\'t set origin postcode for shipping method.');
        }

        // Workaround
        if (!defined("CFPP_CEP")) {
            define('CFPP_CEP', '30360230');
        }

        $this->cfpp_shipping_methods = new \CFPP\Shipping\ShippingMethods;
    }

    /**
     * @test Should succeed with valid data
     */
    public function test_should_succeed_with_valid_data()
    {
        $pageObj = get_page_by_title('Cap', OBJECT, 'product');
        $productId = $pageObj->ID;
        $productObj = wc_get_product($productId);

        $data['id'] = $productId;
        $data['height'] = $productObj->get_height();
        $data['width'] = $productObj->get_width();
        $data['length'] = $productObj->get_length();
        $data['weight'] = $productObj->get_weight();
        $data['price'] = $productObj->get_price();

        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('success', $cfpp_shipping_costs[0]['status']);
        $this->assertEquals('0', $cfpp_shipping_costs[0]['debug']->Erro);
    }

    /**
     * @test Should fail with height bigger than max
     */
    public function test_should_fail_with_height_bigger_than_max()
    {
        $data = $this->data;
        $data['height'] = 106;
        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Altura', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains('106cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with length bigger than max
     */
    public function test_should_fail_with_length_bigger_than_max()
    {
        $data = $this->data;
        $data['length'] = 106;
        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Comprimento', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains('106cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with width bigger than max
     */
    public function test_should_fail_with_width_bigger_than_max()
    {
        $data = $this->data;
        $data['width'] = 106;
        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Largura', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains('106cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with weight bigger than max
     */
    public function test_should_fail_with_weight_bigger_than_max()
    {
        $data = $this->data;
        $this->shipping_zone->service_type = 'conventional';
        $data['weight'] = 31;
        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Peso', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains('31kg', $cfpp_shipping_costs[0]['debug']);

        $this->shipping_zone->service_type = 'corporate';
        $data['weight'] = 51;
        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Peso', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains('51kg', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with height smaller than min
     */
    public function test_should_fail_with_height_smaller_than_min()
    {
        $data = $this->data;
        $shipping_method = $this->shipping_zone->get_shipping_methods();
        $shipping_method = array_shift($shipping_method);
        $data['height'] = $shipping_method->minimum_height - 1;

        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Altura', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains($data['height'] . 'cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with width than min
     */
    public function test_should_fail_with_width_smaller_than_min()
    {
        $data = $this->data;
        $shipping_method = $this->shipping_zone->get_shipping_methods();
        $shipping_method = array_shift($shipping_method);
        $data['width'] = $shipping_method->minimum_width - 1;

        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Largura', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains($data['width'] . 'cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should fail with length than min
     */
    public function test_should_fail_with_length_smaller_than_min()
    {
        $data = $this->data;
        $shipping_method = $this->shipping_zone->get_shipping_methods();
        $shipping_method = array_shift($shipping_method);
        $data['length'] = $shipping_method->minimum_length - 1;

        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Comprimento', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains($data['length'] . 'cm', $cfpp_shipping_costs[0]['debug']);
    }

    /**
     * @test Should succeed with height than min with two quantities
     */
    public function test_should_succeed_with_height_smaller_than_min_with_two_quantities()
    {
        $data = $this->data;
        $shipping_method = $this->shipping_zone->get_shipping_methods();
        $shipping_method = array_shift($shipping_method);
        $data['height'] = $shipping_method->minimum_height - 1;
        $data['quantity'] = 2;
        $data['weight'] = 1;

        $cfpp_shipping_costs = $this->cfpp_shipping_methods->calculateShippingOptions($this->shipping_zone->get_shipping_methods(), $data);
        $this->assertEquals('error', $cfpp_shipping_costs[0]['status']);
        $this->assertContains('Altura', $cfpp_shipping_costs[0]['debug']);
        $this->assertContains($data['height'] . 'cm', $cfpp_shipping_costs[0]['debug']);
    }
}