<?php

namespace CFPP\Common;

use CFPP\Common\Sanitize,
    CFPP\Common\Validate;

class Ajax {

    /**
    *   Listens for Ajax calls on the front-end
    */
    public function listen()
    {
        add_action( 'wp_ajax_cfpp_request_shipping_costs', array($this, 'processCfppRequestShippingCosts') );
        add_action( 'wp_ajax_nopriv_cfpp_request_shipping_costs', array($this, 'processCfppRequestShippingCosts') );
    }

    /**
     * Processes an AJAX request to calculate shipping costs
     */
    public function processCfppRequestShippingCosts()
    {
        // Do we have the amount of parameters required?
        if (!(is_array($_POST['data']) && count($_POST['data']) == 8)) {
            wp_send_json_error(__('Error at "listen_cfpp_ajax", check what is coming at $_POST["data"]', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Sanitize input
        $request = Sanitize::cfppShippingCostAjaxRequest($_POST['data']);

        // Validate input
        $validation_response = Validate::cfppShippingCostAjaxRequest($request);

        if ($validation_response !== true) {
            wp_send_json_error($validation_response);
        }

        // Validate WP Nonce
        if (!wp_verify_nonce($request['solicita_calculo_frete'], 'solicita_calculo_frete')) {
            wp_send_json_error(__('Unable to verify WP Nonce: "solicita_calculo_frete".'));
        }

        // Everything looking good. Let's proceed.
        $this->prepara_calculo_de_frete($cep_destinatario, $produto_altura, $produto_largura, $produto_comprimento, $produto_peso, $produto_preco);
    }

}
