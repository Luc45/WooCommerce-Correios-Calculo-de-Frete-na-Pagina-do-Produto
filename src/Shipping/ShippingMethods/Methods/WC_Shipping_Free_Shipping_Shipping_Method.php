<?php

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Free_Shipping_Shipping_Method extends ShippingMethodsAbstract
{

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        // Check if this product is entitled for free shipping
        $should_show = $this->meetsFreeShippingRequirements($request) ? 'show' : 'hide';

        return array(
            'name' => $this->shipping_method->method_title,
            'status' => $should_show,
            'price' => 'Grátis',
            'days' => apply_filters('cfpp_free_shipping_days', 'Consulte-nos')
        );
    }

    /**
    *   Check if current request meets free shipping requirements
    */
    private function meetsFreeShippingRequirements(array $request)
    {
        if (empty($this->shipping_method->requires)) {
            return true;
        } elseif ($this->shipping_method->requires == 'min_amount' || $this->shipping_method->requires == 'either') {
            if (is_numeric($this->shipping_method->min_amount)) {
                if (($request['price'] * $request['quantity']) > $this->shipping_method->min_amount) {
                    return true;
                }
            }
        }
        return false;
    }
}
