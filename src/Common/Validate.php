<?php

namespace CFPP\Common;

class Validate {

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    */
    public static function cfppShippingCostAjaxRequest(array $request)
    {
        $success = true;
        $message = '';

        return array(
            'success' => $success,
            'message' => $message
        );
    }

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    *   Product must have all values required by Correios
    */
    public static function product(array $product)
    {
        $height = $product['height'];
        $width = $product['width'];
        $length = $product['length'];
        $weight = $product['weight'];
        $price = $product['price'];

        $errors = [];

        // Height
        if (!is_numeric($height)) {
            $errors[] = 'Altura inválida ou não preenchida.';
        } elseif (is_numeric($height) && $height > 105) {
            $errors[] = 'Altura ('.$height.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($height) && $height < 2) {
            $errors[] = 'Altura ('.$height.'cm) é menor do que o mínimo permitido pelos correios (2cm).';
        }

        // Width
        if (!is_numeric($width)) {
            $errors[] = 'Largura inválida ou não preenchida.';
        } elseif (is_numeric($width) && $width > 105) {
            $errors[] = 'Largura ('.$width.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($width) && $width < 11) {
            $errors[] = 'Largura ('.$width.'cm) é menor do que o mínimo permitido pelos correios (11cm).';
        }

        // Length
        if (!is_numeric($length)) {
            $errors[] = 'Comprimento inválido ou não preenchido.';
        } elseif (is_numeric($length) && $length > 105) {
            $errors[] = 'Comprimento ('.$length.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($length) && $length < 11) {
            $errors[] = 'Comprimento ('.$length.'cm) é menor do que o mínimo permitido pelos correios (16cm).';
        }

        // Sum of Height, Width and Length
        if (is_numeric($height) && is_numeric($width) && is_numeric($length)) {
            if ($height + $width + $length > 200) {
                $errors[] = 'Soma da Altura, Largura e Comprimento ('.$height + $width + $length.') ultrapassa o máximo permitido pelos correios (200cm).';
            }
        }

        // Weight
        if (!is_numeric($weight)) {
            $errors[] = 'Peso inválido ou não preenchido.';
        } elseif (is_numeric($weight) && $weight > 30) {
            $errors[] = 'Peso ('.$weight.'kg) ultrapassa o máximo permitido pelos correios (30kg).';
        }

        // Price
        if (!is_numeric($price)) {
            $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
        } elseif (is_numeric($price) && $price > 10000) {
            $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido pelos correios (R$ 10.000,00).';
        }

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

}
