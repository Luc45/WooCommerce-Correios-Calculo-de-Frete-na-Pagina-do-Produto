<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Package;
use CFPP\Shipping\ShippingMethods\Response;

use CFPP\Exceptions\FactoryException;
use CFPP\Exceptions\HandlerException;
use CFPP\Exceptions\PackageException;
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

        foreach ($shipping_methods as $shipping_method) {
            $shipping_method_slug = sanitize_title(get_class($shipping_method));
            $response = new Response($shipping_method);

            try {
                // Create Package based on product and quantities per Shipping Method
                $package = Package::makeFrom($payload->getProduct(), $payload->getQuantity(), $shipping_method);
                $payload->setPackage($package);

                // Create CFPP handler for this Shipping Method
                $cfpp_handler = Factory::createHandler($shipping_method);

                // Gives a chance to set rules, then validate Payload per Shipping Method
                $cfpp_handler->beforeValidate()->validate($payload);

                // Calculate Costs
                do_action('cfpp_before_calculate_cost', $payload, $shipping_method);
                $shipping_costs[] = apply_filters('cfpp_response_success_' . $shipping_method_slug, $cfpp_handler->calculate($payload));

            } catch(PackageException $e) {
                do_action('cfpp_response_package_exception', $shipping_method_slug);
                $shipping_costs[] = $response->error($e->getMessage(), $e->getCode());
            } catch (FactoryException $e) {
                do_action('cfpp_response_factory_exception', $shipping_method_slug);
                $shipping_costs[] = $response->error($e->getMessage(), $e->getCode());
            } catch (ValidationErrorException $e) {
                do_action('cfpp_response_validation_exception', $shipping_method_slug);
                $shipping_costs[] = $response->error($e->getMessage(), $e->getCode());
            } catch (HandlerException $e) {
                do_action('cfpp_response_handler_exception', $shipping_method_slug);
                $shipping_costs[] = $response->error($e->getMessage());
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
