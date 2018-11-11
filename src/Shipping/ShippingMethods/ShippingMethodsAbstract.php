<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Shipping\ShippingMethods\ShippingMethodResponse as Response;

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
     * Instance of ShippingMethodResponse
     */
    protected $response;

    /**
     * Stores a copy of the original shipping method class, so we can get costs, etc
     */
    public function setup($shipping_method)
    {
        $this->shipping_method = $shipping_method;
        $this->response = new Response($shipping_method);
    }

    /**
     * Calculate shipping costs for Request based on Shipping Method
     */
    abstract public function calculate(array $request);

    /**
     * Calculates cubage of request per quantity
     */
    public function calculateCubageByQuantity(array $request)
    {
        return $request;
    }
}
