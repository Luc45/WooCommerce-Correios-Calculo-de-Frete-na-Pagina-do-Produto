<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Response;
use CFPP\Shipping\ShippingMethods\Handler;

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

        $shipping_zone = apply_filters('cfpp_get_shipping_zone', $shipping_zone, $payload);

        if ( ! $shipping_zone instanceof \WC_Shipping_Zone) {
            throw new \Exception(__('Couldn\'t find a matching shipping zone for this postcode.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        // Get available shipping methods within this shipping zone
        $cfpp_shipping_methods = new ShippingMethods;
        $shipping_methods = $cfpp_shipping_methods->getShippingMethods($shipping_zone, $payload);

        $shipping_methods = apply_filters('cfpp_get_shipping_methods', $shipping_methods, $shipping_zone, $payload);

        if ( ! empty($shipping_methods)) {
            // Get shipping cost for each shipping method
            return $this->getCostPerShippingMethod($shipping_methods, $payload);
        } else {
            throw new \Exception(__('Couldn\'t find any shipping method for this postcode and product.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }


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
            $shipping_method_slug = sanitize_title(get_class($shipping_method));
            $response = new Response($shipping_method);

            // Create CFPP handler for this Shipping Method
            try {
                $cfpp_handler = Factory::create($shipping_method);

                if ( ! $cfpp_handler instanceof Handler) {
                    throw new \Exception(sprintf(
                        /* translators: %s class name for shipping method */
                        __('Could not create a CFPP Handler class for this Shipping Method. (%s)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                        get_class($shipping_method)
                    ));
                }

            } catch (\Exception $e) {
                do_action('cfpp_not_supported_shipping_method', $shipping_method);
                $shipping_costs[] = $response->generateNotSupportedShippingMethodResponse();
                continue;
            }

            // Validate Payload before Calculation
            try {
                // Gives a chance to modify validation behavior
                $cfpp_handler->beforeValidate();
                $cfpp_handler->validate($payload);
            } catch (\Exception $e) {
                do_action('cfpp_payload_validation_error', $payload, $shipping_method);
                $shipping_costs[] = apply_filters('cfpp_response_validation_error_' . $shipping_method_slug, $response->error($e->getMessage()));
                continue;
            }

            // Calculate Costs
            try {
                do_action('cfpp_before_calculate_cost', $payload, $shipping_method);
                $response = $cfpp_handler->calculate($payload);
                $shipping_costs[] = apply_filters('cfpp_response_success_' . $shipping_method_slug, $response);
            } catch (\Exception $e) {
                $shipping_costs[] = $response->generateUnknownErrorResponse();
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
