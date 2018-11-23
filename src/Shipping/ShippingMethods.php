<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Response as Response;

class ShippingMethods
{
    public function getShippingMethods(\WC_Shipping_Zone $shipping_zone, Payload $payload)
    {
        $shipping_methods = $shipping_zone->get_shipping_methods();
        $shipping_methods = $this->filterByEnabledShippingMethods($shipping_methods);
        $shipping_methods = $this->filterByShippingClass($shipping_methods, $payload);
        return $shipping_methods;
    }

    /**
    *   Calculates the shipping costs from the shipping zones provided
    */
    public function getCostPerShippingMethod(array $shipping_methods, Payload $payload)
    {
        $shipping_costs = array();
        $factory = new Factory;

        foreach ($shipping_methods as $shipping_method) {
            // Get CFPP instance of Shipping Method
            $shipping_method_instance = $factory->getInstance(get_class($shipping_method));

            // If we don't support this Shipping Method, it will return false.
            if ($shipping_method_instance !== false) {
                // Pass the Shipping Method class to the CFPP Shipping Method
                $shipping_method_instance->setup($shipping_method);

                // Go to specific shipping method class to calculate
                $response = $shipping_method_instance->calculate($payload);

                if (!$response instanceof Response) {
                    throw new \Exception("Invalid CFPP Response.", 1);
                }

                $shipping_costs[] = (array) $response;

            } else {
                $response = new Response;
                $shipping_costs[] = (array) $response->generateNotSupportedShippingMethodResponse();
            }
        }

        // Success first, error last
        $shipping_costs = $this->orderShippingCosts($shipping_costs);

        return $shipping_costs;
    }

    /**
     * Receives an array of Shipping Methods instances,
     */
    private function filterByEnabledShippingMethods(array $shipping_methods)
    {
        $enabled_shipping_methods = array();
        foreach ($shipping_methods as $shipping_method) {
            if (property_exists($shipping_method, 'enabled') && $shipping_method->enabled == 'yes') {
                $enabled_shipping_methods[] = $shipping_method;
            }
        }
        return $enabled_shipping_methods;
    }

    /**
     * Determines which shipping methods should show, according to shipping class
     * and requested product
     */
    private function filterByShippingClass(array $shipping_methods, Payload $payload)
    {
        foreach ($shipping_methods as $key => $shipping_method) {
            if (property_exists($shipping_method, 'shipping_class') && $shipping_method->shipping_class != '') {
                if ($payload->getProduct() != $shipping_method->shipping_class) {
                    unset($shipping_methods[$key]);
                }
            }
        }
        return $shipping_methods;
    }

    /**
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
