<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Local_Pickup_Shipping_Method extends ShippingMethodsAbstract {

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {

        // Additional cost for local pickup?
        if (is_numeric($this->shipping_method->cost)) {
            $cost = 'R$ ' . number_format($this->shipping_method->cost, 2, ',', '.');
        } else {
            $cost = 'Grátis';
        }

        return array(
            'name' => $this->shipping_method->method_title,
            'status' => 'show',
            'price' => (string) $cost,
            'days' => apply_filters( 'cfpp_local_pickup_days', 'Consulte-nos' )
        );
    }

}
