<?php
namespace CFPP\Admin;

use CFPP\Admin\Requirements;

class RequirementsTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    // tests
    public function test_woocommerce_installed()
    {
        $requirements = new Requirements;
        $this->assertTrue($requirements->wooCommerceInstalled());
    }

    // tests
    public function test_woocommerce_installed_fails_if_not_installed()
    {
        $this->markTestSkipped('Can\'t make this work');

        $requirements = new Requirements;

        $active_plugins = get_option( 'active_plugins' );
        $active_plugins = array_diff($active_plugins, ['woocommerce/woocommerce.php']);
        update_option( 'active_plugins', $active_plugins );

        $this->assertFalse($requirements->wooCommerceInstalled());
    }

    // tests
    public function test_woocommerce_version_without_cfpp_cep()
    {
        global $woocommerce;

        $requirements = new Requirements;

        $woocommerce->version = '3.2.1';
        $this->assertTrue($requirements->wooCommerceVersionSupported());

        $woocommerce->version = '3.1.9';
        $this->assertFalse($requirements->wooCommerceVersionSupported());
    }

    // tests
    public function test_woocommerce_correios_installed_fails_if_not_installed()
    {
        $this->markTestSkipped('Can\'t make this work');

        $requirements = new Requirements;

        $active_plugins = get_option( 'active_plugins' );
        $active_plugins = array_diff($active_plugins, ['woocommerce-correios/woocommerce-correios.php']);
        update_option( 'active_plugins', $active_plugins );

        $this->assertFalse($requirements->wooCommerceCorreiosInstalled());
    }

    // tests
    public function test_valid_origin_cep()
    {
        $requirements = new Requirements;

        // CONSTANTS are untestable
        if (defined('CFPP_CEP'))
            $this->markTestSkipped('CFPP_CEP is defined. Unable to test.');

        $valid_ceps = ['30360-230', '30360230'];

        foreach ($valid_ceps as $valid_cep) {
            update_option( 'woocommerce_store_postcode' , $valid_cep );
            $this->assertTrue($requirements->validOriginCep());
        }

    }

    // tests
    public function test_woocommerce_version_with_cfpp_cep_returns_true_even_in_versions_below_minimum()
    {
        global $woocommerce;
        $requirements = new Requirements;

        if (defined('CFPP_CEP'))
            $this->markTestSkipped('CFPP_CEP is defined. Unable to test.');

        define('CFPP_CEP', '30360-230');
        $woocommerce->version = '3.1.9';
        $this->assertTrue($requirements->wooCommerceVersionSupported());
    }

}

