<?php

/**
 * Class AjaxTest
 *
 * @package Woo_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 */

// Helper functions
require_once('helpers.php');

/**
 * Cep test case.
 */
class AjaxTest extends WP_UnitTestCase {

    private $ajax;
    private $ch;

    public function setUp()
    {
        parent::setUp();
        $this->ajax = new CFPP\Common\Ajax;
    }

    public function test_missing_parameter_for_cfpp_request_shipping_costs_fails()
    {
        $data = [
            'cep_origem' => 'cep_origem',
            'produto_altura' => 'produto_altura',
            'produto_largura' => 'produto_largura',
        ];

        $response = cfpp_ajax_test('cfpp_request_shipping_costs', $data);

        $this->assertEquals(false, $response['success']);
    }

}
