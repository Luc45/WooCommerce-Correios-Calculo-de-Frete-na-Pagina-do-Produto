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
        if (!self::cep($request['cep_destinatario'])) {
            return array(
                'success' => false,
                'message' => 'CEP destinatário inválido.'
            );
        }

        $product = array();
        $product['height'] = $request['produto_altura'];
        $product['width'] = $request['produto_largura'];
        $product['length'] = $request['produto_comprimento'];
        $product['weight'] = $request['produto_peso'];
        $product['price'] = $request['produto_preco'];
        $product['id'] = $request['id_produto'];
        $product['quantity'] = $request['quantidade'];

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
        $errors[] = self::productWeight($product['weight']);
        $errors[] = self::productPrice($product['price']);
        $errors[] = self::productId($product['id']);

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
        if (gettype($cep) != 'string') return false;

        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) == 8;
    }
}
