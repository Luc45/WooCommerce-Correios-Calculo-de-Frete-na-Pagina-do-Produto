<?php

namespace CFPP\Frontend\Shipping\ShippingMethods;

class ShippingMethodsFactory {

    /**
    *   Returns a Shipping Method class
    */
    public function getClass(string $shipping_method)
    {
        $class = $shipping_method.'_Shipping_Method';
        $file = __DIR__.'/Methods/'.$class.'.php';

        if (!file_exists($file))
            return false;

        include_once($file);
        return new $class;
    }

}
