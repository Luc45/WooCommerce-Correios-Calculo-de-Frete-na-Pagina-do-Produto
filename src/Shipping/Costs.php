<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Response;

class Costs
{
    /**
     * Calculate the shipping costs for the payload object
     *
     * @param Payload $payload
     * @return array
     * @throws \Exception
     */
    public function calculate(Payload $payload)
    {
        // Get first matching shipping zone for destination postcode
        $cfpp_shipping_zones = new ShippingZones;
        $shipping_zone = $cfpp_shipping_zones->getFirstMatchingShippingZone($payload->getPostcode());

        if ( ! $shipping_zone instanceof \WC_Shipping_Zone) {
            throw new \Exception('Couldn\'t find a matching shipping zone for this postcode.');
        }

        // Get available shipping methods within this shipping zone
        $cfpp_shipping_methods = new ShippingMethods;
        $shipping_methods = $cfpp_shipping_methods->getShippingMethods($shipping_zone, $payload);

        // Get shipping cost for each shipping method
        return $this->getCostPerShippingMethod($shipping_methods, $payload);
    }

    /**
     * Calculates shipping costs for an array of shipping methods
     *
     * @param array $shipping_methods
     * @param Payload $payload
     * @return array
     */
    public function getCostPerShippingMethod(array $shipping_methods, Payload $payload)
    {
        $shipping_costs = array();

        foreach ($shipping_methods as $shipping_method) {
            // Get CFPP handler for Shipping Method
            try {
                $cfpp_handler = Factory::create($shipping_method);
            } catch (\Exception $e) {
                $response = new Response($shipping_method);
                $shipping_costs[] = (array) $response->generateNotSupportedShippingMethodResponse();
                continue;
            }

            // Pass the Shipping Method class to the CFPP Shipping Method
            $cfpp_handler->setup($shipping_method);

            try {
                $response = $cfpp_handler->calculate($payload);
                $shipping_costs[] = (array) $response;
            } catch (\Exception $e) {
                $response = new Response($shipping_method);
                $shipping_costs[] = (array) $response->generateUnknownErrorResponse();
                continue;
            }
        }

        // Success first, error last
        $shipping_costs = $this->orderShippingCosts($shipping_costs);

        return $shipping_costs;
    }

    /**
     * Sorts an array of costs by successes first
     *
     * @param $shipping_costs
     * @return array
     */
    private function orderShippingCosts($shipping_costs)
    {
        $successes = array();
        $errors = array();
        foreach ($shipping_costs as $shipping_cost) {
            $shipping_cost['status'] == 'success' ? $successes[] = $shipping_cost : $errors[] = $shipping_cost;
        }
        return array_merge($successes, $errors);
    }
}
