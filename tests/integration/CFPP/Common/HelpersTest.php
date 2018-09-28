<?php
namespace CFPP\Common;

use CFPP\Common\Helpers;

class HelpersTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_normalize_product_weight_kilos()
    {
        $formatted_kilos =  number_format(4123, 2, '.', ',');

        update_option('woocommerce_weight_unit', 'kg');
        $this->assertEquals($formatted_kilos, Helpers::normalizeProductWeight(4123));
    }

    public function test_normalize_product_weight_grams()
    {
        $grams = 4123;
        $grams_in_kilos = number_format(4.123, 2, '.', ',');

        update_option('woocommerce_weight_unit', 'g');
        $this->assertEquals($grams_in_kilos, Helpers::normalizeProductWeight($grams));
    }

    public function test_normalize_product_weight_lbs()
    {
        $lbs = 4123;
        $lbs_in_kilos = number_format(1870.161, 2, '.', ',');

        update_option('woocommerce_weight_unit', 'lbs');
        $this->assertEquals($lbs_in_kilos, Helpers::normalizeProductWeight($lbs));
    }

    public function test_normalize_product_weight_oz()
    {
        $oz = 4123;
        $oz_in_kilos = number_format(116.88, 2, '.', ',');

        update_option('woocommerce_weight_unit', 'oz');
        $this->assertEquals($oz_in_kilos, Helpers::normalizeProductWeight($oz));
    }

    public function test_normalize_product_weight_returns_same_value_if_argument_not_numeric()
    {
        $this->assertEquals('not a number', Helpers::normalizeProductWeight('not a number'));
        $this->assertEquals('', Helpers::normalizeProductWeight(''));
    }

    public function test_normalize_product_weight_throws_exception_if_measurement_unrecognized()
    {
        $this->expectException(\Exception::class);
        update_option('woocommerce_weight_unit', 'foobar123');
        Helpers::normalizeProductWeight(30);
    }

}
