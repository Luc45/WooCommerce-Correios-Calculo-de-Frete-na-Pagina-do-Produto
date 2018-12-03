<?php

use WC\SmoothGenerator\Generator\Product;

class RestCest
{
    public function _before(FunctionalTester $I)
    {
    }


    public function should_return_successful_response_for_valid_product(FunctionalTester $I, $scenario)
    {
        $product = Product::generate_simple_product(30, 30, 30, 30);

        $url = 'calculate/' . $product->get_id() . '/30360230';

        $I->sendGET($url);

        $I->dontHaveInDatabase('wp_postmeta', ['post_id' => $product->get_id()]);
        $I->dontHaveInDatabase('wp_posts', ['ID' => $product->get_id()]);
        $I->dontHaveInDatabase('wp_posts', ['ID' => get_post_thumbnail_id($product->get_id())]);

        $I->seeResponseCodeIsSuccessful();
    }

    public function should_return_error_response_for_invalid_product(FunctionalTester $I, $scenario)
    {
        $url = 'calculate/823904823904823/30360230';

        $I->sendGET($url);

        $I->seeResponseCodeIsClientError();
    }
}
