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

    public function test_normalize_product_weight()
    {
        $input = 4123;

        // KG
        $expected_output =  4123;
        update_option('woocommerce_weight_unit', 'kg');
        $this->assertEquals($expected_output, Helpers::normalizeProductWeight($input));

        // G
        $expected_output =  4.12;
        update_option('woocommerce_weight_unit', 'g');
        $this->assertEquals($expected_output, Helpers::normalizeProductWeight($input));

        // LBS
        $expected_output =  1870.16;
        update_option('woocommerce_weight_unit', 'lbs');
        $this->assertEquals($expected_output, Helpers::normalizeProductWeight($input));

        // OZ
        $expected_output =  116.88;
        update_option('woocommerce_weight_unit', 'oz');
        $this->assertEquals($expected_output, Helpers::normalizeProductWeight($input));

        // Not a number
        $this->assertEquals('not a number', Helpers::normalizeProductWeight('not a number'));
        $this->assertEquals('', Helpers::normalizeProductWeight(''));
    }

    public function test_normalize_product_weight_throws_exception_if_measurement_unrecognized()
    {
        $this->expectException(\Exception::class);
        update_option('woocommerce_weight_unit', 'foobar123');
        Helpers::normalizeProductWeight(30);
    }

    /**
    *   Provides data to test_is_cep_from_state
    */
    public function ceps_and_states() {
        return [
            'AC' => ['AC', '69900-028'], 'AC2' => ['AC', '69975-970'],
            'AL' => ['AL', '57010-002'], 'AL2' => ['AL', '57980-970'],
            'AP' => ['AP', '68900-011'], 'AP2' => ['AP', '68976-970'],
            'AM' => ['AM', ''],
            'BA' => ['BA', ''],
            'CE' => ['CE', ''],
            'DF' => ['DF', ''],
            'ES' => ['ES', ''],
            'GO' => ['GO', ''],
            'MA' => ['MA', ''],
            'MT' => ['MT', ''],
            'MS' => ['MS', ''],
            'MG' => ['MG', ''],
            'PA' => ['PA', ''],
            'PB' => ['PB', ''],
            'PR' => ['PR', ''],
            'PE' => ['PE', ''],
            'PI' => ['PI', ''],
            'RJ' => ['RJ', ''],
            'RN' => ['RN', ''],
            'RS' => ['RS', ''],
            'RO' => ['RO', ''],
            'RR' => ['RR', ''],
            'SC' => ['SC', ''],
            'SP' => ['SP', ''],
            'SE' => ['SE', ''],
            'TO' => ['TO', ''],
        ];
    }

    /**
     *  @dataProvider ceps_and_states
     *  PS: DataProvider code are loaded before WordPress core.
     */
    public function test_is_cep_from_state($estado, $cep) {
        if (!empty($cep))
            $this->assertTrue(Helpers::isCepFromState($cep, $estado), 'Failed: '.$cep.'. is not a cep from '.$estado);
    }

}
