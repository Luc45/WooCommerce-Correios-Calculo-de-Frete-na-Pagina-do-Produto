<?php

/**
 * Class ProductTest
 *
 * @package Woo_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 */

/**
 * Product test case.
 */
class ProductTest extends WP_UnitTestCase {

    private $product;

    public function setUp()
    {
        parent::setUp();

        $stub = $this->getMockBuilder('WC_Product')
                ->setMockClassName('WC_Product')
                ->getMock();

        $stub->method('get_height')->willReturn('10.00');
        $stub->method('get_width')->willReturn('10.00');
        $stub->method('get_length')->willReturn('10.00');
        $stub->method('get_weight')->willReturn('10.00');
        $stub->method('get_price')->willReturn('10.00');
        $stub->method('get_id')->willReturn('10');

        $this->product = new CFPP\Frontend\Product($stub);
    }

    /**
     * Test that a invalid CEP returns false
     */
    public function test_invalid_cep_returns_false()
    {
        $this->assertEquals(10.00, $this->product->normalize_product_weight($this->product->productShippingInfo['weight']));
    }

}
