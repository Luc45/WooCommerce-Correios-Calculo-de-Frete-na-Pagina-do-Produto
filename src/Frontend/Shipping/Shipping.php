<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Common\Sanitize,
    CFPP\Common\Validate,
    CFPP\Frontend\Shipping\ShippingZones,
    CFPP\Frontend\Shipping\ShippingMethods,
    CFPP\Frontend\ShippingMethods\WooCommerceCorreios;

class Shipping {

    /**
     * Processes an AJAX request to calculate shipping costs
     */
    public function calculateShippingCostsAjax()
    {
        $request = $this->sanitizeAndValidateRequest($_POST);

        // Get Shipping Zones available for this post code
        $shipping_zones = new ShippingZones;
        $available_shipping_zones = $shipping_zones->getShippingZonesByCEP($request['cep_destinatario']);

        if (!$available_shipping_zones)
            wp_send_json_error('Não há Áreas de Entrega disponíveis para o CEP informado. Verifique suas Áreas de entrega. Leia: https://docs.woocommerce.com/document/setting-up-shipping-zones/');


        $cfpp_shipping_costs = array();

        // Gets Shipping Costs for each Shipping Method
        $shipping_methods = new ShippingMethods;
        foreach ($available_shipping_zones as $available_shipping_zone) {
            $cfpp_shipping_costs[$available_shipping_zone['zone_name']] = $shipping_methods->calculateShippingOptions($available_shipping_zone['shipping_methods'], $request);
        }

        dd($cfpp_shipping_costs);

        wp_send_json_success( $cfpp_shipping_costs );

        dd($available_shipping_zones);



        $available_shipping_zones = $shipping_zones->get(
                                        $request['cep_destinatario'],
                                        $request['produto_preco'],
                                        $this->getAllowedShippingMethods()
                                    );

        dd($available_shipping_zones);

        $shipping = new WooCommerceCorreios;
        $shipping->calculate($request, $available_shipping_zones);
        //$this->prepara_calculo_de_frete($cep_destinatario, $produto_altura, $produto_largura, $produto_comprimento, $produto_peso, $produto_preco);
    }

    /**
     * Sanitizes and Validates a $_POST request sent to calculateShippingCostsAjax method
     */
    private function sanitizeAndValidateRequest($post) {
        // Do we have the amount of parameters required?
        if (!(is_array($post['data']))) {
            wp_send_json_error(__('Error at "listen_cfpp_ajax", check what is coming at $_POST["data"]', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Normalize quantity if not available
        if (empty($post['quantidade']))
            $post['quantidade'] = 1;

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
