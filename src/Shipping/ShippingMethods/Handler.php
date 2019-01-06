<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Traits\ValidateRequestTrait;
use CFPP\Exceptions\HandlerException;

abstract class Handler
{
    use ValidateRequestTrait;

    /** @var \CFPP\Shipping\ShippingMethods\Response */
    public $response;

    /** @var \WC_Shipping_Method */
    protected $shipping_method;

    /** @var string $shipping_method_slug */
    protected $shipping_method_slug;

    /** @var array */
    protected $validation_rules;

    /**
     * Handler constructor.
     * @param \WC_Shipping_Method $shipping_method
     */
    public function __construct(\WC_Shipping_Method $shipping_method)
    {
        $this->shipping_method = $shipping_method;
        $this->shipping_method_slug = sanitize_title(get_class($shipping_method));
        $this->response = new Response($shipping_method);
    }

    /**
     * Calculate cost for Shipping Method based on Payload
     *
     * @param Payload $payload
     * @throws HandlerException
     * @return mixed
     */
    abstract public function calculate(Payload $payload);

    /**
     * Gives a chance to modify validation behavior
     *
     * @return $this
     */
    public function beforeValidateRequest() {
        return $this;
    }
}
