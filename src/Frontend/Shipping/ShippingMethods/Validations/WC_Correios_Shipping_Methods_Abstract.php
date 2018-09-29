<?php

namespace CFPP\Frontend\Shipping\ShippingMethods\Validations;

abstract class WC_Correios_Shipping_Methods_Abstract {
    /**
    *   Validates a product according to WooCommerce Correios requirements
    */
    public function validate($request) {
        $errors = array();

        $errors[] = $this->productHeight($product['height']) &
                    $this->productWidth($product['width']) &
                    $this->productLength($product['length']) &
                    $this->productSumHeightWidthLength($product['height'], $product['width'], $product['length']) &
                    $this->productWeight($product['weight']) &
                    $this->productPrice($product['price']);

        // Flattens array
        $errors = call_user_func_array('array_merge', $errors);

        dd($errors);
    }

    /**
     * Validates a product height
     * @return array
     */
    private function productHeight($height) {
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
    private function productWidth($width) {
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
    private function productLength($length) {
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
    private function productSumHeightWidthLength($height, $width, $length) {
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
    private function productWeight($weight) {
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
    private function productPrice($price) {
        $errors = array();
            if (!is_numeric($price)) {
                $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
            } elseif (is_numeric($price) && $price > 10000) {
                $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido pelos correios (R$ 10.000,00).';
            }
        return $errors;
    }

}
