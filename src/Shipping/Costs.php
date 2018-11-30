<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Response;
use CFPP\Exceptions\HandlerException;
use CFPP\Exceptions\FactoryException;
use CFPP\Exceptions\ValidationErrorException;

class Costs
{
    /**
     * Calculates shipping costs for an array of shipping methods
     *
     * @param array $shipping_methods
     * @param Payload $payload
     * @return array
     */
    public static function getCostPerShippingMethod(array $shipping_methods, Payload $payload)
    {
        $instance = new self;
        $shipping_costs = array();
        $original_payload = $payload;

        foreach ($shipping_methods as $shipping_method) {
            $shipping_method_slug = sanitize_title(get_class($shipping_method));
            $response = new Response($shipping_method);

            /** Fix for Correios Shipping Methods bug */
            if ($shipping_method instanceof \WC_Correios_Shipping) {
                $payload = $payload->adjustPackageForCorreios();
            } else {
                $payload = $original_payload;
            }

            try {
                // Create CFPP handler for this Shipping Method
                $cfpp_handler = Factory::createHandler($shipping_method);

                // Validate Payload per Shipping Method
                // Gives a chance to modify validation behavior
                $cfpp_handler->beforeValidate();
                $cfpp_handler->validate($payload);

                // Calculate Costs
                do_action('cfpp_before_calculate_cost', $payload, $shipping_method);
                $response = $cfpp_handler->calculate($payload);
                $shipping_costs[] = apply_filters('cfpp_response_success_' . $shipping_method_slug, $response);

            } catch (FactoryException $e) {
                $shipping_costs[] = apply_filters('cfpp_response_factory_exception_' . $shipping_method_slug, $response->error($e->getMessage()));
            } catch (ValidationErrorException $e) {
                $shipping_costs[] = apply_filters('cfpp_response_validation_exception_' . $shipping_method_slug, $response->error($e->getMessage()));
            } catch (HandlerException $e) {
                $shipping_costs[] = apply_filters('cfpp_response_handler_exception_' . $shipping_method_slug, $response->error($e->getMessage()));
            }
        }

        // Successes first, errors last
        $shipping_costs = $instance->orderShippingCosts($shipping_costs);

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
