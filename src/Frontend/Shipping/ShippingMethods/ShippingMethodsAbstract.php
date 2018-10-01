<?php

namespace CFPP\Frontend\Shipping\ShippingMethods;

abstract class ShippingMethodsAbstract
{
    protected $shipping_method;

    public function setup($shipping_method) {
        // Stores a copy of the original shipping method class, so we can get costs, etc
        $this->shipping_method = $shipping_method;
    }

    abstract public function calculate(array $request);
}
