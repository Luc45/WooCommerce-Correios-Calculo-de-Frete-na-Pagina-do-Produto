<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsInterface;

class WC_Shipping_Flat_Rate_Shipping_Method implements ShippingMethodsInterface {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName() {
        return 'Frete Único';
    }

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request) {
        dd($request);
    }



}
