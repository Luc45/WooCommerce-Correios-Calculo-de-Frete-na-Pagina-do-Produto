<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Shipping\Payload;

abstract class Handler
{
    /** @var \WC_Shipping_Method */
    protected $shipping_method;

    /** @var \CFPP\Shipping\ShippingMethods\Response */
    protected $response;

    /**
     * Handler constructor.
     * @param \WC_Shipping_Method $shipping_method
     */
    public function __construct(\WC_Shipping_Method $shipping_method)
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
