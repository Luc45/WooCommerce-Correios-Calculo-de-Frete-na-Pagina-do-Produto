<?php

namespace CFPP;

use CFPP\Shipping\Costs;
use CFPP\Shipping\Payload;

class Rest
{
    /**
     * Register REST routes in WordPress
     */
    public static function registerRoutes()
    {
        /**
         * @route calculate
         * @param1 int WC_Product ID
         * @param2 int Destination Postcode
         * @param3 int Quantity (optional, defaults to 1)
         * @param4 string Selected Variation (optional, captures a-z, 0-9 and -)
         */
        register_rest_route('cfpp/v1', '/calculate/(?P<product_id>\d+)/(?P<destination_postcode>\d+)(?:/(?P<quantity>\d+))?(?:/(?P<selected_variation>[0-9a-z-]+))?', [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => array($this, 'calculate'),
            'args' => [
                'product_id' => [
                    'validate_callback' => function($param, $request, $key) {
                        return wc_get_product($param) !== false;
                    }
                ],
                'destination_postcode' => [
                    'validate_callback' => function($param, $request, $key) {
                        return strlen($param) === 8;
                    }
                ]
            ]
        ]);
    }

    /**
     * Receives a REST Request, creates the payload object and pass it
     * to Costs to calculate it, then send the JSON response
     *
     * @param \WP_REST_Request $request
     */
    public function calculate(\WP_REST_Request $request)
    {
        $product = wc_get_product($request->get_param('product_id'));
        $destination_postcode = absint($request->get_param('destination_postcode'));
        $quantity = $request->offsetExists('quantity') ? absint($request->get_param('quantity')) : 1;
        $selected_variation = $request->offsetExists('selected_variation') ? $request->get_param('selected_variation') : null;

        try {
            $payload = new Payload;
            $payload = $payload->makeFrom($product, $destination_postcode, $quantity, $selected_variation);
        } catch (\Exception $e) {
            wp_send_json_error($e->getMessage());
        }

        try {
            $costs = new Costs;
            $response = $costs->calculate($payload);
        } catch(\Exception $e) {
            wp_send_json_error($e->getMessage());
        }

        wp_send_json_success($response);
    }
}
