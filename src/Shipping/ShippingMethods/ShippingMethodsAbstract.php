<?php

namespace CFPP\Shipping\ShippingMethods;

abstract class ShippingMethodsAbstract
{
    /**
     * Request received through AJAX, containing product info
     */
    #protected $request;

    /**
     * Instance of Current Shipping Method
     */
    protected $shipping_method;

    /**
     * Stores a copy of the original shipping method class, so we can get costs, etc
     */
    public function setup($shipping_method)
    {
        $this->shipping_method = $shipping_method;
    }

    /**
     * Calculate shipping costs for Request based on Shipping Method
     */
    abstract public function calculate(array $request);

    /**
     * Calculates cubage of request per quantity
     */
    abstract public function setupQuantity(array $request);
}
