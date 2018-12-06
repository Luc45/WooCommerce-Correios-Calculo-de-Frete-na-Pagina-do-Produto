<?php

namespace CFPP\Shipping\ShippingMethods\Traits;

use CFPP\Exceptions\ValidationErrorException;
use CFPP\Shipping\Payload;

trait ValidateRequestTrait
{
    /** @var array $package */
    protected $package;

    /** @var string $dimensions_unit */
    protected $dimensions_unit;

    /** @var string $weight_unit */
    protected $weight_unit;

    /**
     * Validates a product according to given rules and payload
     *
     * @param Payload $payload
     * @throws ValidationErrorException
     */
    public function validateRequest(Payload $payload)
    {
        $this->package = $payload->getPackage();
        $this->dimensions_unit = get_option('woocommerce_dimension_unit');
        $this->weight_unit = get_option('woocommerce_weight_unit');

        $validation_rules = new ValidationRules;

        /** Allows for custom validation rules per shipping method using filters */
        $validation_rules = apply_filters('cfpp_handler_rules_' . $this->shipping_method_slug, $validation_rules);

        if ($validation_rules->hasRules() === false) {
            return;
        }

        $validation_rules = $validation_rules->getRules();

        $errors = array();
        $errors[] = $this->checkDimensionsAndTotalCost($validation_rules);
        $errors[] = $this->checkSumHeightWidthLength($validation_rules['sum_height_width_length']);

        // Flattens array
        $errors = call_user_func_array('array_merge', $errors);

        if ( ! empty($errors)) {
            do_action('cfpp_exception_validation_error', $errors, $payload);
            throw ValidationErrorException::validation_error(implode('<br>', $errors));
        }
    }

    /**
     * Validates minimum and maximum values for
     * Height, Width, Length, Weight and Price
     * according to given $rules and $payload
     *
     * @param array $rules
     * @return array
     */
    public function checkDimensionsAndTotalCost(array $rules)
    {
        $errors = array();

        $allowed_properties = ['height', 'width', 'length', 'weight', 'total_cost'];

        foreach ($rules as $property => $rule) {
            if ( ! in_array($property, $allowed_properties)) {
                continue;
            }
            $value = $this->package[$property];

            $max = $rules[$property]['max'];
            $min = $rules[$property]['min'];

            switch ($property) {
                case 'height':
                case 'width':
                case 'length':
                    $unit = $this->dimensions_unit;
                    break;
                case 'weight':
                    $unit = $this->weight_unit;
                    break;
                case 'total_cost':
                    $unit = '';
                    break;
            }

            // Max
            if ($value > $max) {
                $errors[] = sprintf(
                    /* translators: 1: readable property, 2: value, 3: maximum value, 4: unit */
                    __('Package %1$s (%2$s%4$s) is bigger than the maximum allowed for this shipping method (%3$s%4$s).', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    $property,
                    $value,
                    $max,
                    $unit
                );
            } else if ($value < $min) {
                // Min
                $errors[] = sprintf(
                    /* translators: 1: readable property, 2: value, 3: minimum value, 4: unit */
                    __('Package %1$s (%2$s%4$s) is smaller than the minimum required for this shipping method (%3$s%4$s).', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    $property,
                    $value,
                    $min,
                    $unit
                );
            }
        }

        return $errors;
    }

    /**
     * Validates the product sum of height, width and length
     *
     * @param array $package
     * @param $max
     * @return array
     */
    private function checkSumHeightWidthLength($sum_height_width_length)
    {
        $max = $sum_height_width_length['max'];
        $min = $sum_height_width_length['min'];
        $height = $this->package['height'];
        $width = $this->package['width'];
        $length = $this->package['length'];

        $errors = array();

        if (is_numeric($height) && is_numeric($width) && is_numeric($length)) {
            if ($height + $width + $length > $max) {
                $errors[] = sprintf(
                    /* translators: 1: height, 2: width, 3: length, 4: maximum value, 5: unit */
                    __('Sum of Height, Width and Length (%1$sx%2$sx%3$s%5$s) is bigger than the maximum allowed for this shipping method (%4$s%5$s).', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    $height,
                    $width,
                    $length,
                    $max,
                    $this->dimensions_unit
                );
            } else if ($height + $width + $length < $min) {
                $errors[] = sprintf(
                    /* translators: 1: height, 2: width, 3: length, 4: maximum value, 5: unit */
                    __('Sum of Height, Width and Length (%1$sx%2$sx%3$s%5$s) is smaller than the minimum required for this shipping method (%4$s%5$s).', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    $height,
                    $width,
                    $length,
                    $min,
                    $this->dimensions_unit
                );
            }
        }

        return $errors;
    }
}
