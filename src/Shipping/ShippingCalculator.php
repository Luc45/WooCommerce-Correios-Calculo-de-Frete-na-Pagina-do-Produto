<?php

namespace CFPP\Shipping;

use CFPP\Exceptions\PayloadException;
use CFPP\Exceptions\ShippingCalculatorException;

/**
 * Class Shipping
 *
 * Calculate shipping costs with Payload object.
 *
 * @package CFPP\Shipping
 */
class ShippingCalculator
{
    /** @var \CFPP\Shipping\Payload $payload */
    protected $payload;

    /**
     * ShippingCalculator constructor.
     * @param \WC_Product $product
     * @param $destination_postcode
     * @param $quantity
     * @param $selected_variation
     * @throws ShippingCalculatorException
     */
    public function __construct(\WC_Product $product, $destination_postcode, $quantity, $selected_variation)
    {
        try {
            $this->payload = Payload::makeFrom($product, $destination_postcode, $quantity, $selected_variation);
        } catch (PayloadException $e) {
            throw new ShippingCalculatorException($e->getMessage());
        }
    }

    /**
     * Processes a REST calculate request
     *
     * @return array
     * @throws ShippingCalculatorException
     */
    public function processRequest()
    {
        try {
            $costs = new Costs($this->payload);
            return $costs->calculate();
        } catch(\Exception $e) {
            throw new ShippingCalculatorException($e->getMessage());
        }
    }
}
