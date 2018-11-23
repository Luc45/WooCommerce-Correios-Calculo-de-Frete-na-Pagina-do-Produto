<?php

namespace CFPP\Shipping;

class Shipping
{
    /**
     * Processes a request to calculate shipping costs
     *
     * @param \CFPP\Shipping\Payload $payload
     * @throws \Exception
     */
    public function calculateShippingCosts(Payload $payload)
    {
        // WooCommerce matches the first Shipping Zone from top to bottom as the shipping zone used for calculations.
        // Fallback to "Locations not covered by your other zones" if can't find a shipping zone
        $shipping_zone = new ShippingZones;
        $shipping_zone = $shipping_zone->getFirstMatchingShippingZone($payload->getPostcode());

        // Gets Shipping Costs for each Shipping Method
        $shipping_methods = new ShippingMethods;
        $cfpp_shipping_costs = $shipping_methods->calculateShippingOptions($shipping_zone->get_shipping_methods(), $payload);

        return $cfpp_shipping_costs;
    }
}
