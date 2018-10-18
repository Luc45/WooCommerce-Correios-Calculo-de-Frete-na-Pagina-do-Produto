<?php

namespace CFPP\Shipping\ShippingMethods;

class ShippingMethodsFactory
{

    /**
    *   Returns a Shipping Method class
    */
    public function getInstance($shipping_method)
    {
        // String type-hinting for older versions of PHP
        if (gettype($shipping_method) != 'string') {
            return false;
        }

        $class = $shipping_method.'_Shipping_Method';
        $file = __DIR__.'/Methods/'.$class.'.php';

        if (!file_exists($file)) {
            return false;
        }

        include_once($file);
        return new $class;
    }
}
