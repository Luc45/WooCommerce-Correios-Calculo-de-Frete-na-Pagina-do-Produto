<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract,
    CFPP\Frontend\Shipping\ShippingMethods\Traits\WC_Correios_Shipping_Method_Trait;

class WC_Correios_Shipping_PAC_Shipping_Method extends ShippingMethodsAbstract {

    use WC_Correios_Shipping_Method_Trait;

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName()
    {
        return 'PAC';
    }

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        $errors = $this->validate($request);

        if (empty($errors)) {
           return $this->calculateCorreiosCosts($this->shipping_method, $request);
        } else {
            return false;
        }
    }

}
