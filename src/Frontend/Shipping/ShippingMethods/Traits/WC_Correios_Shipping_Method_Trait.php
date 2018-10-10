<?php

namespace CFPP\Frontend\Shipping\ShippingMethods\Traits;

use CFPP\Common\Cep;

trait WC_Correios_Shipping_Method_Trait
{
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
        $maximum_price = $this->shipping_method->id == 'correios-pac' ? 3000 : 10000;
        $errors = array();
        if (!is_numeric($price)) {
            $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
        } elseif (is_numeric($price) && $price > $maximum_price) {
            $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido para esta modalidade de envio (R$ '.$maximum_price.').';
        }
        return $errors;
    }
}
