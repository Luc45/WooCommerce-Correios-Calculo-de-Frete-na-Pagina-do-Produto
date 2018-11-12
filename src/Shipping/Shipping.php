<?php

namespace CFPP\Shipping;

use CFPP\Common\Sanitize;
use CFPP\Common\Validate;
use CFPP\Shipping\ShippingZones;
use CFPP\Shipping\ShippingMethods;

class Shipping
{

    /**
     * Processes an AJAX request to calculate shipping costs
     */
    public function calculateShippingCostsAjax()
    {
        $request = $this->sanitizeAndValidateRequest($_POST);

        // WooCommerce matches the first Shipping Zone from top to bottom as the shipping zone used for calculations.
        // Fallback to "Locations not covered by your other zones" if can't find a shipping zone
        $shipping_zone = new ShippingZones;
        $shipping_zone = $shipping_zone->getFirstMatchingShippingZone($request['destination_postcode']);

        // Gets Shipping Costs for each Shipping Method
        $shipping_methods = new ShippingMethods;
        $cfpp_shipping_costs = $shipping_methods->calculateShippingOptions($shipping_zone->get_shipping_methods(), $request);

        wp_send_json_success($cfpp_shipping_costs);
    }

    /**
     * Sanitizes and Validates a $_POST request sent to calculateShippingCostsAjax method
     */
    private function sanitizeAndValidateRequest($post)
    {
        // Do we have the amount of parameters required?
        if (empty($post['data']) || !(is_array($post['data']))) {
            wp_send_json_error(__('Error at "listen_cfpp_ajax", check what is coming at $_POST["data"]', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Normalize quantity if not available
        if (empty($post['quantity'])) {
            $post['quantity'] = 1;
        }

        // Sanitize input
        $sanitized_request = Sanitize::cfppShippingCostAjaxRequest($post['data']);

        // Validate input
        $validation_response = Validate::cfppShippingCostAjaxRequest($sanitized_request);

        if ($validation_response['success'] !== true) {
            wp_send_json_error($validation_response['message']);
        }

        // Validate WP Nonce
        if (!wp_verify_nonce($sanitized_request['cfpp_nonce'], 'cfpp_nonce')) {
            wp_send_json_error(__('Unable to verify WP Nonce: "cfpp_nonce".'));
        }

        return $sanitized_request;
    }
}
