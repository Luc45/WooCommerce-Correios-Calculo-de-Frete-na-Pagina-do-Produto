<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Shipping\Payload;

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
     * Instance of Response
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
    abstract public function calculate(Payload $payload);
}
