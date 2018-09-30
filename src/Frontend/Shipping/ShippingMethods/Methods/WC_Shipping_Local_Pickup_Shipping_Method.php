<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Local_Pickup_Shipping_Method extends ShippingMethodsAbstract {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName()
    {
        return 'Retirar no Local';
    }

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        $cost = 0;

        // Additional cost for local pickup?
        if (is_numeric($this->shipping_method->cost))
            $cost += $this->shipping_method->cost;

        return array(
            'price' => (string) $cost,
            'days' => '-'
        );
    }

}
