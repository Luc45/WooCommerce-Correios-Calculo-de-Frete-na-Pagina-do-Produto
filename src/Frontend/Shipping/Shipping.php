<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Common\Sanitize;
use CFPP\Common\Validate;
use CFPP\Frontend\Shipping\ShippingZones;
use CFPP\Frontend\Shipping\ShippingMethods;
use CFPP\Frontend\ShippingMethods\WooCommerceCorreios;

class Shipping
{

    /**
     * Processes an AJAX request to calculate shipping costs
     */
    public function calculateShippingCostsAjax()
    {
        $request = $this->sanitizeAndValidateRequest($_POST);

        // WooCommerce matches the first Shipping Zone from top to bottom as the shipping zone used for calculations.
        $shipping_zone = new ShippingZones;
        $shipping_zone = $shipping_zone->getFirstMatchingShippingZone($request['cep_destinatario']);

        if ($shipping_zone === false) {
            wp_send_json_error('Não há Áreas de Entrega disponíveis para o CEP informado. Verifique suas Áreas de entrega. Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/');
        }


        $cfpp_shipping_costs = array();

        // Gets Shipping Costs for each Shipping Method
        $shipping_methods = new ShippingMethods;

        $shipping_methods_array = empty($shipping_zone['shipping_methods']) ? $shipping_zone->get_shipping_methods() : $shipping_zone['shipping_methods'];
        $cfpp_shipping_costs = $shipping_methods->calculateShippingOptions($shipping_methods_array, $request);

        wp_send_json_success($cfpp_shipping_costs);
    }

    /**
     * Sanitizes and Validates a $_POST request sent to calculateShippingCostsAjax method
     */
    private function sanitizeAndValidateRequest($post)
    {
        // Do we have the amount of parameters required?
        if (!(is_array($post['data']))) {
            wp_send_json_error(__('Error at "listen_cfpp_ajax", check what is coming at $_POST["data"]', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Normalize quantity if not available
        if (empty($post['quantidade'])) {
            $post['quantidade'] = 1;
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
