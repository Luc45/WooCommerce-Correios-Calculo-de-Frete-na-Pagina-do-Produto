<?php
namespace CFPP;

use WC\SmoothGenerator\Generator\Product;

class RestTest extends \Codeception\TestCase\WPRestApiTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown()
    {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    /**
     * @skip
     */
    public function testMe()
    {
        $product = Product::generate_simple_product();

        $request = new \WP_REST_Request('GET', 'calculate');
        $request->set_query_params([
            'product_id' => $product->get_id(),
            'destination_postcode' => '30360230',
            'quantity' => 1,
            'selected_variation' => null
        ]);

        $rest = new Rest;
        $rest->calculate($request);
    }

}