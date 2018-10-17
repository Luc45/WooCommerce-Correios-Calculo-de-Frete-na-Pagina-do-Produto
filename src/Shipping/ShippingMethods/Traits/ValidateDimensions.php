<?php

namespace CFPP\Shipping\ShippingMethods\Traits;

trait ValidateDimensions
{
    /**
    *   Validates a product according to WooCommerce Correios requirements
    *
    *   @param $rules array Validation rules
    *   @param $request array Product info sent through AJAX
    */
    public function validate(array $rules,  array $request)
    {
        $errors = array();

        $rules = $this->normalizeValidationRules($rules);

        // Each of these methods returns an array.
        $errors[] = $this->checkHeight($request['height'], $rules['height']['max'], $rules['height']['min']);
        $errors[] = $this->checkWidth($request['width'], $rules['width']['max'], $rules['width']['min']);
        $errors[] = $this->checkLength($request['length'], $rules['length']['max'], $rules['length']['min']);
        $errors[] = $this->checkWeight($request['weight'], $rules['maxWeight']);
        $errors[] = $this->checkPrice($request['price'], $rules['maxPrice']);
        if ($rules['checkSumHeightWidthLength'] !== false) {
            $errors[] = $this->checkSumHeightWidthLength($request['height'], $request['width'], $request['length'], $rules['checkSumHeightWidthLength']);
        }

        // Flattens array
        $errors = call_user_func_array('array_merge', $errors);

        // Do we have any error?
        return $errors;
    }

    /**
    *   Normalizes a set of rules. Since we do numeric comparison, we either add
    *   0 for minimum values or PHP_INT_MAX for max values, if those are empty.
    */
    protected function normalizeValidationRules(array $rules) {
        return array(
            'height' => array(
                'max' => !empty($rules['height']['max']) ? $rules['height']['max'] : PHP_INT_MAX,
                'min' => !empty($rules['height']['min']) ? $rules['height']['min'] : 0
            ),
            'width' => array(
                'max' => !empty($rules['width']['max']) ? $rules['width']['max'] : PHP_INT_MAX,
                'min' => !empty($rules['width']['min']) ? $rules['width']['min'] : 0
            ),
            'length' => array(
                'max' => !empty($rules['length']['max']) ? $rules['length']['max'] : PHP_INT_MAX,
                'min' => !empty($rules['length']['min']) ? $rules['length']['min'] : 0
            ),
            'maxWeight' => !empty($rules['maxWeight']) ? $rules['maxWeight'] : PHP_INT_MAX,
            'maxPrice' => !empty($rules['maxPrice']) ? $rules['maxPrice'] : PHP_INT_MAX,
            'checkSumHeightWidthLength' => !empty($rules['checkSumHeightWidthLength']) ? $rules['checkSumHeightWidthLength'] : false
        );
    }

    /**
     * Validates a product height
     * @return array
     */
    private function checkHeight($height, $max, $min)
    {
        $errors = array();
        if (!is_numeric($height)) {
            $errors[] = 'Altura inválida ou não preenchida.';
        } elseif (is_numeric($height) && $height > $max) {
            $errors[] = 'Altura ('.$height.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($height) && $height < $min) {
            $errors[] = 'Altura ('.$height.'cm) é menor do que o mínimo permitido pelos correios (2cm).';
        }
        return $errors;
    }

    /**
     * Validates a product width
     * @return array
     */
    private function checkWidth($width, $max, $min)
    {
        $errors = array();
        if (!is_numeric($width)) {
            $errors[] = 'Largura inválida ou não preenchida.';
        } elseif (is_numeric($width) && $width > $max) {
            $errors[] = 'Largura ('.$width.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($width) && $width < $min) {
            $errors[] = 'Largura ('.$width.'cm) é menor do que o mínimo permitido pelos correios (11cm).';
        }
        return $errors;
    }

    /**
     * Validates a product length
     * @return array
     */
    private function checkLength($length, $max, $min)
    {
        $errors = array();
        if (!is_numeric($length)) {
            $errors[] = 'Comprimento inválido ou não preenchido.';
        } elseif (is_numeric($length) && $length > $max) {
            $errors[] = 'Comprimento ('.$length.'cm) ultrapassa o máximo permitido pelos correios (105cm).';
        } elseif (is_numeric($length) && $length < $min) {
            $errors[] = 'Comprimento ('.$length.'cm) é menor do que o mínimo permitido pelos correios (16cm).';
        }
        return $errors;
    }

    /**
     * Validates a product weight
     * @return array
     */
    private function checkWeight($weight, $max)
    {
        $extra_weight = !empty($this->shipping_method->extra_weight) ? $this->shipping_method->extra_weight: 0;

        $errors = array();
        if (!is_numeric($weight)) {
            $errors[] = 'Peso inválido ou não preenchido.';
        } elseif (is_numeric($weight) && ($weight + $extra_weight) > $max) {
            if ($extra_weight > 0) {
                $errors[] = 'Peso ('.$weight.'kg) ultrapassa o máximo permitido deste método de entrega ('.$max.'kg). Considerando peso extra configurado do método de entrega, que é de '.$extra_weight.'kg';
            } else {
                $errors[] = 'Peso ('.$weight.'kg) ultrapassa o máximo permitido deste método de entrega ('.$max.'kg).';
            }
        }
        return $errors;
    }

    /**
     * Validates a product price
     * @return array
     */
    private function checkPrice($price, $max)
    {
        $errors = array();
        if (!is_numeric($price)) {
            $errors[] = 'Preço inválido ou não preenchido. ('.$price.')';
        } elseif (is_numeric($price) && $price > $max) {
            $errors[] = 'Preço (R$ '.$price.') ultrapassa o máximo permitido para esta modalidade de envio (R$ '.$max.').';
        }
        return $errors;
    }

    /**
     * Validates a product length
     * @return array
     */
    private function checkSumHeightWidthLength($height, $width, $length, $max)
    {
        $errors = array();
        if (is_numeric($height) && is_numeric($width) && is_numeric($length)) {
            if ($height + $width + $length > $max) {
                $errors[] = "Soma da Altura, Largura e Comprimento (".$height + $width + $length.") ultrapassa o máximo permitido pelos correios (".$max."cm).";
            }
        }
        return $errors;
    }
}
