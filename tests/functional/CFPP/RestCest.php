<?php

use WC\SmoothGenerator\Generator\Product;

class RestCest
{
    protected $product_single;
    protected $product_variable;

    public function _before(FunctionalTester $I)
    {
        if (empty($this->product_single)) {
            $this->product_single = Product::generate_simple_product();
        }

        if (empty($this->product_variable)) {
            $this->product_variable = Product::generate_variable_product();
        }
    }

    public function should_return_successful_response_for_valid_product_single(FunctionalTester $I)
    {
        $url = 'calculate/' . $this->product_single->get_id() . '/30360230';
        $I->sendGET($url);
        $I->seeResponseCodeIsSuccessful();
    }

    public function should_return_successful_response_for_valid_product_variable(FunctionalTester $I)
    {
        $url = 'calculate/' . $this->product_variable->get_id() . '/30360230';
        $I->sendGET($url);
        $I->seeResponseCodeIsSuccessful();
    }

    public function should_return_error_response_for_invalid_product(FunctionalTester $I)
    {
        $url = 'calculate/823904823904823/30360230';
        $I->sendGET($url);
        $I->seeResponseCodeIsClientError();
    }
}
