<?php

namespace CFPP\Shipping\ShippingMethods;

use InvalidCfppResponseException;

class ShippingMethodResponse
{
    //Wether the calculation was succesful or not
    public $status;
    // Additional HTML classes for the output
    public $class;
    // Costs for shipping
    public $price;
    // Estimated delivery days
    public $days;
    // Debug info
    public $debug;
    // Wether the method should display or not
    public $should_display;

    public function __construct($shipping_method)
    {
        $this->name = $shipping_method->method_title;
        $this->price = 'Indefinido';
        $this->days = 'Indefinido';
        $this->status = 'Indefinido';
        $this->debug = '';
    }

    /**
    *   Returns a succesful response
    */
    public function success(
        $price,
        $days,
        $debug = '',
        $class = ''
    ) {
        $price = $this->formatPrice($price);

        if ($price === false) {
            return $this->error('Tentou enviar uma resposta, porém preço foi inválido: ' . $price);
        }

        $days = $this->formatDays($days);

        $this->status = 'success';
        $this->price = $price;
        $this->days = $days;
        $this->debug = $debug;
        $this->class = $class;
        $this->should_display = true;
        return $this;
    }

    /**
    *   Returns an error response
    */
    public function error(
        $debug = ''
    ) {
        $this->status = 'error';
        $this->debug = $debug;
        $this->class = 'cfpp-has-error';
        // Only show errors to logged in users
        $this->should_display = current_user_can('manage_options');

        return $this;
    }

    /**
     * Formats a price to be returned
     */
    private function formatPrice($price)
    {
        if (is_numeric($price)) {
            return wc_price($price);
        } elseif ($price === 'Grátis') {
            return $price;
        } else {
            return false;
        }
    }

    /**
     * Formats a price to be returned
     */
    private function formatDays($days)
    {
        if (is_numeric($days)) {
            $after_days = (int) $days > 1 ? ' dias' : ' dia';
            $before_days = apply_filters('cfpp_days_nomenclature', 'Em até ');
            return $before_days . $days . $after_days;
        } else {
            return $days;
        }
    }
}
