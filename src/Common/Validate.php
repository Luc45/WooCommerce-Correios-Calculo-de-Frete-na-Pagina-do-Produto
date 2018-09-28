<?php

namespace CFPP\Common;

class Validate {

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    */
    public static function cfppShippingCostAjaxRequest(array $request)
    {
        // Since we're receiving this from the front-end, let's not trust it.
        if (!self::cep($request['cep_destinatario']))
            return array(
                'success' => false,
                'message' => 'CEP destinatário inválido.'
            );

        $product = array();
        $product['height'] = $request['produto_altura'];
        $product['width'] = $request['produto_largura'];
        $product['length'] = $request['produto_comprimento'];
        $product['weight'] = $request['produto_peso'];
        $product['price'] = $request['produto_preco'];

        return self::product($product);
    }

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    *   Product must have all values required by Correios
    */
    public static function product(array $product)
    {
        $errors = array();

        $errors[] = self::productHeight($product['height']);
        $errors[] = self::productWidth($product['width']);
        $errors[] = self::productLength($product['length']);
        $errors[] = self::productSumHeightWidthLength($product['height'], $product['width'], $product['length']);
        $errors[] = self::productWeight($product['weight']);
        $errors[] = self::productPrice($product['price']);

        // Flattens array
        $errors = call_user_func_array('array_merge', $errors);

        if (!empty($errors)) {
            $success = false;
            $message = '';
            foreach ($errors as $error) {
                $message .= '<li>'.$error.'</li>';
            }
        } else {
            $success = true;
            $message = '';
        }

        return array(
            'success' => $success,
            'message' => $message
        );
    }

    /**
     * Validates a product height
     * @return array
     */
    private static function productHeight($height) {
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
    private static function productWidth($width) {
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
    private static function productLength($length) {
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
    private static function productSumHeightWidthLength($height, $width, $length) {
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
    private static function productWeight($weight) {
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
    private static function productPrice($price) {
        $errors = array();
            if (!is_numeric($price)) {
                $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
            } elseif (is_numeric($price) && $price > 10000) {
                $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido pelos correios (R$ 10.000,00).';
            }
        return $errors;
    }

    /**
     * Checks if given CEP is valid
     *
     *  @param string $cep Cep to check if valid
     *  @return boolean
     */
    public static function cep(string $cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) == 8;
    }

}
