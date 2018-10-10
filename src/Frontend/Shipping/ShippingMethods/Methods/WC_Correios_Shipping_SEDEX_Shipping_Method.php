<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;
use CFPP\Frontend\Shipping\ShippingMethods\Traits\WC_Correios_Webservice_Trait;
use CFPP\Frontend\Shipping\ShippingMethods\Traits\WC_Correios_Shipping_Method_Trait;

class WC_Correios_Shipping_SEDEX_Shipping_Method extends ShippingMethodsAbstract
{
    use WC_Correios_Webservice_Trait;
    use WC_Correios_Shipping_Method_Trait;

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        $errors = $this->validate($request);

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
