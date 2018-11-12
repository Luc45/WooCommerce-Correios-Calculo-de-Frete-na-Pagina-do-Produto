<?php

use function Helper\clearAndCreateShippingZone;

class ShippingMethodsTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown()
    {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    /**
    *
    */
    public function prepareRequest() {
        return [
            'cep_destinatario' => '30360-230',
            'produto_altura' => 15,
            'produto_largura' => 15,
            'produto_comprimento' => 15,
            'produto_peso' => 15,
            'produto_preco' => 15,
            'id_produto' => 29,
            'quantidade' => 15
        ];
    }

    /**
     * Unsupported shipping method should return informative array
     */
    public function test_unsupported_shipping_method()
    {
        $shipping_zone = clearAndCreateShippingZone();
        $shipping_zone->add_shipping_method( 'correios-leve-internacional' );

        $request = $this->prepareRequest();

        $cfpp_shipping_methods = new CFPP\Shipping\ShippingMethods;
        $cfpp_shipping_costs = $cfpp_shipping_methods->calculateShippingOptions($shipping_zone->get_shipping_methods(), $request);

        $this->assertEquals(1, count($cfpp_shipping_costs));
        $this->assertEquals('cfpp_shipping_method_not_available', $cfpp_shipping_costs[0]['additional_class']);
    }

}
