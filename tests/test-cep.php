<?php

/**
 * Class CepTest
 *
 * @package Woo_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 */

/**
 * Cep test case.
 */
class CepTest extends WP_UnitTestCase {

    private $cep;

    public function setUp()
    {
        parent::setUp();
        $this->cep = new CFPP\Common\Cep;
    }

    /**
     * Test that a invalid CEP returns false
     */
    public function test_invalid_cep_returns_false()
    {
        $invalid_cep = '123abc';
        $this->assertEquals(false, $this->cep->isValid($invalid_cep));
    }

    /**
     * Test that a valid CEP returns true
     */
    public function test_valid_cep_returns_true()
    {
        $valid_cep = '30360230';
        $this->assertEquals(true, $this->cep->isValid($valid_cep));

        $valid_cep = '30360-230';
        $this->assertEquals(true, $this->cep->isValid($valid_cep));
    }

}
