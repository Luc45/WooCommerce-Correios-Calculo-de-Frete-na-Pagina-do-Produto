<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Common\Sanitize,
    CFPP\Common\Validate,
    CFPP\Frontend\Shipping\ShippingZones,
    CFPP\Frontend\ShippingMethods\WooCommerceCorreios;

class Shipping {

    /**
     * Processes an AJAX request to calculate shipping costs
     */
    public function calculateShippingCostsAjax()
    {
        // Do we have the amount of parameters required?
        if (!(is_array($_POST['data']) && count($_POST['data']) == 8)) {
            wp_send_json_error(__('Error at "listen_cfpp_ajax", check what is coming at $_POST["data"]', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Sanitize input
        $sanitized_request = Sanitize::cfppShippingCostAjaxRequest($_POST['data']);

        // Validate input
        $validation_response = Validate::cfppShippingCostAjaxRequest($sanitized_request);

        if ($validation_response['success'] !== true) {
            wp_send_json_error($validation_response['message']);
        }

        // Validate WP Nonce
        if (!wp_verify_nonce($sanitized_request['cfpp_nonce'], 'cfpp_nonce')) {
            wp_send_json_error(__('Unable to verify WP Nonce: "cfpp_nonce".'));
        }

        // Everything looking good. Let's proceed.
        $shipping_zones = new ShippingZones;
        $available_shipping_zones = $shipping_zones->get(
                                        $sanitized_request['cep_destinatario'],
                                        $sanitized_request['produto_preco'],
                                        $this->getAllowedShippingMethods()
                                    );

        dd($available_shipping_zones);

        $shipping = new WooCommerceCorreios;
        $shipping->calculate($sanitized_request, $available_shipping_zones);
        //$this->prepara_calculo_de_frete($cep_destinatario, $produto_altura, $produto_largura, $produto_comprimento, $produto_peso, $produto_preco);
    }

    /**
     * Returns a list of Shipping Methods we will be using
     */
    public function getAllowedShippingMethods() {
        return array(
            'WC_Correios_Shipping_PAC' => 'PAC',
            'WC_Correios_Shipping_SEDEX' => 'SEDEX',
        );
    }

}
