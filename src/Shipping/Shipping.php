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
        // Get first matching shipping zone for destination postcode
        $cfpp_shipping_zones = new ShippingZones;
        $shipping_zone = $cfpp_shipping_zones->getFirstMatchingShippingZone($payload->getPostcode());

        // Get available shipping methods within this shipping zone
        $cfpp_shipping_methods = new ShippingMethods;
        $shipping_methods = $cfpp_shipping_methods->getShippingMethods($shipping_zone, $payload);

        $cfpp_shipping_costs = $cfpp_shipping_methods->getCostPerShippingMethod($shipping_methods, $payload);


        $cfpp_shipping_costs = $shipping_methods_class->calculateShippingOptions($shipping_zone->get_shipping_methods(), $payload);

        return $cfpp_shipping_costs;
    }
}
