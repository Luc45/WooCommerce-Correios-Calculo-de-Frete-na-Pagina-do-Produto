<?php

namespace CFPP\Common;

class Validate
{

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    */
    public static function cfppShippingCostAjaxRequest(array $request)
    {
        // Since we're receiving this from the front-end, let's not trust it.
        if (!self::cep($request['destination_postcode'])) {
            return array(
                'success' => false,
                'message' => 'CEP destinatário inválido.'
            );
        }

        return self::product($request['product']);
    }

    /**
    *   Validates a Shipping Cost Ajax Request from CFPP
    *   Product must have all values required by Correios
    */
    public static function product(\WC_Product $product)
    {
        $errors = array();

        $errors[] = self::productHeight($product->get_height());
        $errors[] = self::productWidth($product->get_width());
        $errors[] = self::productLength($product->get_length());
        $errors[] = self::productWeight($product->get_weight());
        $errors[] = self::productPrice($product->get_price());
        $errors[] = self::productId($product->get_id());

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
    private static function productHeight($height)
    {
        $errors = array();
        if (!is_numeric($height)) {
            $errors[] = 'Altura inválida ou não preenchida.';
        } else {
            if ($height <= 0) {
                $errors[] = 'Altura deve ser maior que zero.';
            }
        }
        return $errors;
    }

    /**
     * Validates a product width
     * @return array
     */
    private static function productWidth($width)
    {
        $errors = array();
        if (!is_numeric($width)) {
            $errors[] = 'Largura inválida ou não preenchida.';
        } else {
            if ($width <= 0) {
                $errors[] = 'Largura deve ser maior que zero.';
            }
        }
        return $errors;
    }

    /**
     * Validates a product length
     * @return array
     */
    private static function productLength($length)
    {
        $errors = array();
        if (!is_numeric($length)) {
            $errors[] = 'Comprimento inválido ou não preenchido.';
        } else {
            if ($length <= 0) {
                $errors[] = 'Comprimento deve ser maior que zero.';
            }
        }
        return $errors;
    }

    /**
     * Validates a product weight
     * @return array
     */
    private static function productWeight($weight)
    {
        $errors = array();
        if (!is_numeric($weight)) {
            $errors[] = 'Peso inválido ou não preenchido.';
        } else {
            if ($weight <= 0) {
                $errors[] = 'Peso deve ser maior que zero.';
            }
        }
        return $errors;
    }

    /**
     * Validates a product price
     * @return array
     */
    private static function productPrice($price)
    {
        $errors = array();
        if (!is_numeric($price)) {
            $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
        }
        return $errors;
    }

    /**
     * Validates a product ID
     * @return array
     */
    private static function productId($id)
    {
        $errors = array();
        if (!is_numeric($id)) {
            $errors[] = 'Erro interno: ID do produto inválido. ('.$id.')';
        }
        return $errors;
    }

    /**
     * Checks if given CEP is valid
     *
     *  @param string $cep Cep to check if valid
     *  @return boolean
     */
    public static function cep($cep)
    {
        // String type-hinting for older versions of PHP
        if (gettype($cep) != 'string') {
            return false;
        }

        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) == 8;
    }
}
