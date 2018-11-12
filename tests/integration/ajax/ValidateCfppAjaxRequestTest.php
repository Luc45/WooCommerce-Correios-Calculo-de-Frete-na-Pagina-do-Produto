<?php

/**
 * AbstractAjax holds basic structure for these Ajax tests, and Data Providers.
 */
require_once(__DIR__ . '/AbstractAjax.php');

class ValidateCfppAjaxRequestTest extends AbstractAjax
{
    /**
     * @test Should succeed with default data
     */
    public function test_should_succeed_with_default_data()
    {
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertTrue($response['success']);
    }

    /**
     * @test Should fail if empty data
     */
    public function test_should_fail_if_empty_data()
    {
        $_POST['data'] = null;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
    }

    /**
     * @test Should fail if invalid nonce
     *
     * @dataProvider provider_invalid_nonces
     */
    public function test_should_fail_if_invalid_nonce($invalid_nonce)
    {
        $_POST['data']['cfpp_nonce'] = $invalid_nonce['nonce'];
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('verify WP Nonce', $response['data']);
    }

    /**
     * @test Should fail if invalid postcode
     *
     * @dataProvider provider_invalid_postcodes
     */
    public function test_should_fail_if_invalid_postcode($invalid_postcode)
    {
        $_POST['data']['destination_postcode'] = $invalid_postcode;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('CEP', $response['data']);
    }

    /**
     * @test Should fail if invalid height
     *
     * @dataProvider provider_invalid_dimensions
     */
    public function test_should_fail_if_invalid_height($height)
    {
        $_POST['data']['height'] = $height;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('Altura', $response['data']);
    }

    /**
     * @test Should fail if invalid width
     *
     * @dataProvider provider_invalid_dimensions
     */
    public function test_should_fail_if_invalid_width($width)
    {
        $_POST['data']['width'] = $width;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('Largura', $response['data']);
    }

    /**
     * @test Should fail if invalid length
     *
     * @dataProvider provider_invalid_dimensions
     */
    public function test_should_fail_if_invalid_length($length)
    {
        $_POST['data']['length'] = $length;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('Comprimento', $response['data']);
    }

    /**
     * @test Should fail if invalid weight
     *
     * @dataProvider provider_invalid_dimensions
     */
    public function test_should_fail_if_invalid_weight($weight)
    {
        $_POST['data']['weight'] = $weight;
        $this->expectException('WPAjaxDieContinueException');
        $this->_handleAjax('nopriv_cfpp_request_shipping_costs');
        $response = json_decode($this->_last_response, true);
        $this->assertFalse($response['success']);
        $this->assertContains('Peso', $response['data']);
    }
}