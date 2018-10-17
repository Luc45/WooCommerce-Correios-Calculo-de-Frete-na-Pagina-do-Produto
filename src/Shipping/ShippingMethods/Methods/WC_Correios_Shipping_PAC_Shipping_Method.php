<?php

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;
use CFPP\Shipping\ShippingMethods\Traits\ValidateDimensions;
use CFPP\Shipping\ShippingMethods\Traits\WC_Correios_Webservice_Trait;

class WC_Correios_Shipping_PAC_Shipping_Method extends ShippingMethodsAbstract
{
    use ValidateDimensions;
    use WC_Correios_Webservice_Trait;

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {

        $errors = $this->validate(array(), $request);

        if (empty($errors)) {
            return $this->correiosWebService($request);
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
