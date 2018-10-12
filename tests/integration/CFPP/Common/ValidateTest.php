<?php
namespace CFPP\Common;

use CFPP\Common\Validate;

class ValidateTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_valid_cep_returns_true()
    {
        $valid_ceps = ['30360-230', '30360230'];
        foreach ($valid_ceps as $valid_cep) {
            $this->assertTrue(Validate::cep($valid_cep));
        }
    }

    public function test_invalid_cep_returns_false()
    {
        $invalid_ceps = ['30360-2301', '303602301', '123', 'aaaaaaaaa', '*9)sd'];
        foreach ($invalid_ceps as $invalid_cep) {
            $this->assertFalse(Validate::cep($invalid_cep));
        }
    }

    public function test_valid_product_succeeds()
    {
        $product = [
            'height' => 15,
            'width' => 15,
            'length' => 15,
            'weight' => 15,
            'price' => 15,
            'id' => 15
        ];

        $response = Validate::product($product);

        $this->assertTrue($response['success']);
    }

    public function test_missing_product_height_fails()
    {
        $product = [
            'height' => NULL,
            'width' => 15,
            'length' => 15,
            'weight' => 15,
            'price' => 15,
            'id' => 15
        ];

        $response = Validate::product($product);

        $this->assertFalse($response['success']);
    }

}
