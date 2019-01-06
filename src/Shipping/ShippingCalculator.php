<?php

namespace CFPP\Shipping;

use CFPP\Exceptions\ShippingCalculatorException;
use CFPP\Exceptions\ShippingMethodsException;
use CFPP\Exceptions\ShippingZoneException;
use CFPP\Exceptions\PayloadException;

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
     * @return mixed
     * @throws ShippingCalculatorException
     */
    public function processRestRequest()
    {
        try {
            // Get first matching Shipping Zone for this postcode
            $shipping_zone = ShippingZone::getFirstMatchingShippingZone($this->payload->getPostcode());

            // Get available shipping methods within this shipping zone
            $shipping_methods = ShippingMethods::filterShippingMethods($shipping_zone->get_shipping_methods(true), $this->payload->getProduct());

            // Return costs for each available shipping method
            return Costs::getCostPerShippingMethod($shipping_methods, $this->payload);

        } catch(ShippingZoneException $e) {
            do_action('cfpp_exception_invalid_shipping_zone', $this->payload);
            throw new ShippingCalculatorException($e->getMessage());
        } catch(ShippingMethodsException $e) {
            do_action('cfpp_exception_invalid_shipping_method_provided', $shipping_methods, $this->payload);
            throw new ShippingCalculatorException($e->getMessage());
        } catch(\Exception $e) {
            // Unknown error?
            do_action('cfpp_exception_unknown_error', __METHOD__, $shipping_methods, $this->payload);
            throw new ShippingCalculatorException($e->getMessage());
        }
    }
}
