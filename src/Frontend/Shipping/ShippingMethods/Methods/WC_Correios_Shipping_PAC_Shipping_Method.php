<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;
use CFPP\Frontend\Shipping\ShippingMethods\Traits\WC_Correios_Shipping_Method_Trait;

class WC_Correios_Shipping_PAC_Shipping_Method extends ShippingMethodsAbstract
{

    use WC_Correios_Shipping_Method_Trait;

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        // Takes into account how many items we are requesting shipping for
        $request = $this->multiplyMeasurementsByQuantity($request);

        $errors = $this->validate($request);

        if (empty($errors)) {
            return $this->calculateCorreiosCosts($this->shipping_method, $request);
        } else {
            $errors = implode(', ', $errors);
            return array(
                        'name' => $this->shipping_method->method_title,
                        'status' => 'debug',
                        'debug' => $errors
                    );
        }
    }
}
