<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Shipping\Payload;

abstract class ShippingMethodsAbstract
{
    /** @var Instance of current Shipping Method */
    protected $shipping_method;

    /** @var \CFPP\Shipping\Response */
    protected $response;

    /**
     * Stores a copy of the original shipping method class, so we can get costs, etc
     *
     * @param $shipping_method
     */
    public function setup($shipping_method)
    {
        $this->shipping_method = $shipping_method;
        $this->response = new Response($shipping_method);
    }

    /**
     * Calculate cost for Shipping Method based on Payload
     *
     * @param Payload $payload
     * @return mixed
     */
    abstract public function calculate(Payload $payload);
}
