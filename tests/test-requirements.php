<?php

/**
 * Class RequirementsTest
 *
 * @package Woo_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 *
 * @todo test_woocommerce_installed_check_fails_if_not_installed
 * @todo test_woocommerce_installed_check_suceeds_if_installed
 */
class RequirementsTest extends WP_UnitTestCase {

    private $requirements;

    public function setUp()
    {
        parent::setUp();
        $this->requirements = new CFPP\Admin\Requirements;

        # We'll be running these in the Admin screen
        set_current_screen( 'dashboard' );
    }

    /**
     * Test that PHP Version check returns correctly
     */
    public function test_php_version_check()
    {
        if (version_compare(PHP_VERSION, '5.3.0', '<')) {
            $this->assertEquals(false, $this->requirements->phpVersionSupported());
        } else {
            $this->assertEquals(true, $this->requirements->phpVersionSupported());
        }
    }

}
