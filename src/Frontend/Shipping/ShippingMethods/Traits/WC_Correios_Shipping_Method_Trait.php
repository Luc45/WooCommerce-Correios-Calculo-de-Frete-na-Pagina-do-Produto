<?php

namespace CFPP\Frontend\Shipping\ShippingMethods\Traits;

use CFPP\Common\Cep;

trait WC_Correios_Shipping_Method_Trait {

    /**
    *   Calculates Correios Costs
    */
    public function calculateCorreiosCosts($shipping_method, $request)
    {
        $correiosWebService = new \WC_Correios_Webservice;

        $correiosWebService->set_height($request['produto_altura']);
        $correiosWebService->set_width($request['produto_largura']);
        $correiosWebService->set_length($request['produto_comprimento']);
        $correiosWebService->set_weight($request['produto_peso']);
        $correiosWebService->set_destination_postcode($request['cep_destinatario']);
        $correiosWebService->set_origin_postcode(Cep::getOriginCep());
        $correiosWebService->set_service($shipping_method->get_code());

        // Agora vamos setar os condicionais...

        // Valor declarado
        if ($shipping_method->declare_value == 'yes' && $request['produto_preco'] > 18.50) {
            $correiosWebService->set_declared_value($request['produto_preco']);
        }

        // Mão Propria
        if ($shipping_method->own_hands == 'yes') {
            $correiosWebService->set_own_hands = 'S';
        }

        // Peso extra
        if (!empty($shipping_method->extra_weight)) {
            $correiosWebService->set_extra_weight($shipping_method->extra_weight);
        }

        // Aviso de recebimento
        if ($shipping_method->receipt_notice == 'yes') {
            $correiosWebService->set_receipt_notice('S');
        }

        $entrega = $correiosWebService->get_shipping();

        // Normalize Shipping Price
        $price = $entrega->Valor;
        $price = (string) $price;
        $price = floatval(str_replace(',', '.', str_replace('.', '', $price)));

        // Dias adicionais
        if (!empty($shipping_method->additional_time) && $shipping_method->show_delivery_time == 'yes') {
            $entrega->PrazoEntrega = $entrega->PrazoEntrega + $shipping_method->additional_time;
            $entrega->DiasAdicionais = $shipping_method->additional_time;
        }

        // Custo adicional
        if (!empty($shipping_method->fee)) {
            if (substr($shipping_method->fee, -1) == '%') {
                $porcentagem = preg_replace('/[^0-9]/', '', $shipping_method->fee);
                $price = ($price/100)*(100+$porcentagem);
                $entrega->Fee = $porcentagem.'%';
            } else {
                $price = $price + $shipping_method->fee;
                $entrega->Fee = $shipping_method->fee;
            }
        }

        $return = array();

        $return['name'] = $shipping_method->method_title;
        $return['price'] = 'R$ ' . number_format($price, 2, ',', '.');
        $return['days'] = 'Em até ' . (int) $entrega->PrazoEntrega . ' dias';
        $return['debug'] = $entrega;

        return $return;
    }

    /**
    *   Validates a product according to WooCommerce Correios requirements
    */
    public function validate($request)
    {
        $errors = array();

        // Each of these methods returns an array.
        $errors[] = $this->checkHeight($request['produto_altura']);
        $errors[] = $this->checkWidth($request['produto_largura']);
        $errors[] = $this->checkLength($request['produto_comprimento']);
        $errors[] = $this->checkWeight($request['produto_peso']);
        $errors[] = $this->checkPrice($request['produto_preco']);

        // Flattens array
        $errors = call_user_func_array('array_merge', $errors);

        // Do we have any error?
        return $errors;
    }

    /**
     * Validates a product height
     * @return array
     */
    private function checkHeight($height)
    {
        $errors = array();
            if (!is_numeric($height)) {
                $errors[] = 'Altura inválida ou não preenchida.';
            } elseif (is_numeric($height) && $height > 105) {
                $errors[] = 'Altura ('.$height.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
            } elseif (is_numeric($height) && $height < 2) {
                $errors[] = 'Altura ('.$height.'cm) é menor do que o mínimo permitido pelos correios (2cm).';
            }
        return $errors;
    }

    /**
     * Validates a product width
     * @return array
     */
    private function checkWidth($width)
    {
        $errors = array();
            if (!is_numeric($width)) {
                $errors[] = 'Largura inválida ou não preenchida.';
            } elseif (is_numeric($width) && $width > 105) {
                $errors[] = 'Largura ('.$width.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
            } elseif (is_numeric($width) && $width < 11) {
                $errors[] = 'Largura ('.$width.'cm) é menor do que o mínimo permitido pelos correios (11cm).';
            }
        return $errors;
    }

    /**
     * Validates a product length
     * @return array
     */
    private function checkLength($length)
    {
        $errors = array();
            if (!is_numeric($length)) {
                $errors[] = 'Comprimento inválido ou não preenchido.';
            } elseif (is_numeric($length) && $length > 105) {
                $errors[] = 'Comprimento ('.$length.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
            } elseif (is_numeric($length) && $length < 11) {
                $errors[] = 'Comprimento ('.$length.'cm) é menor do que o mínimo permitido pelos correios (16cm).';
            }
        return $errors;
    }

    /**
     * Validates a product length
     * @return array
     */
    private function checkSumHeightWidthLength($height, $width, $length)
    {
        $errors = array();
            if (is_numeric($height) && is_numeric($width) && is_numeric($length)) {
                if ($height + $width + $length > 200) {
                    $errors[] = 'Soma da Altura, Largura e Comprimento ('.$height + $width + $length.') ultrapassa o máximo permitido pelos correios (200cm).';
                }
            }
        return $errors;
    }

    /**
     * Validates a product weight
     * @return array
     */
    private function checkWeight($weight)
    {
        $errors = array();
            if (!is_numeric($weight)) {
                $errors[] = 'Peso inválido ou não preenchido.';
            } elseif (is_numeric($weight) && $weight > 30) {
                $errors[] = 'Peso ('.$weight.'kg) ultrapassa o máximo permitido pelos correios (30kg).';
            }
        return $errors;
    }

    /**
     * Validates a product price
     * @return array
     */
    private function checkPrice($price)
    {
        $errors = array();
            if (!is_numeric($price)) {
                $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
            } elseif (is_numeric($price) && $price > 10000) {
                $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido pelos correios (R$ 10.000,00).';
            }
        return $errors;
    }
}
