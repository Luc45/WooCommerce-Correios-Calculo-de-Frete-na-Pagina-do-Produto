<?php

namespace CFPP\Shipping;

use CFPP\Performance_Profiler;
use WP_Error;
use CFPP\Shipping\ShippingMethods\Factory;
use CFPP\Shipping\ShippingMethods\Package;

use CFPP\Exceptions\FactoryException;
use CFPP\Exceptions\HandlerException;
use CFPP\Exceptions\PackageException;
use CFPP\Exceptions\ResponseException;
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
            try {
	            Performance_Profiler::instance()->log(__METHOD__ . $shipping_method_slug . __LINE__);

                // Create CFPP handler for this Shipping Method
                $cfpp_handler = Factory::createHandler($shipping_method);

	            Performance_Profiler::instance()->log(__METHOD__ . $shipping_method_slug . __LINE__);

                // Create Package based on product and quantities per Shipping Method
                $package = Package::makeFrom($payload->getProduct(), $payload->getQuantity(), $shipping_method);
                $payload->setPackage($package);

	            Performance_Profiler::instance()->log(__METHOD__ . $shipping_method_slug . __LINE__);

                // Gives a chance to set rules, then validate Payload per Shipping Method
                $cfpp_handler->beforeValidateRequest()->validateRequest($payload);

	            Performance_Profiler::instance()->log(__METHOD__ . $shipping_method_slug . __LINE__);

                // Calculate Costs
                do_action('cfpp_before_calculate_cost', $payload, $shipping_method);
                $cfpp_handler->calculate($payload);

	            Performance_Profiler::instance()->log(__METHOD__ . $shipping_method_slug . __LINE__);

                $shipping_costs[] = $cfpp_handler->response->success();

            } catch(PackageException $e) {
                do_action('cfpp_response_package_exception', $shipping_method_slug);
                $shipping_costs[] = $cfpp_handler->response->error(new WP_Error($e->getCode(), $e->getMessage()));
            } catch (FactoryException $e) {
                do_action('cfpp_response_factory_exception', $shipping_method_slug);
                $shipping_costs[] = $cfpp_handler->response->error(new WP_Error($e->getCode(), $e->getMessage()));
            } catch (ValidationErrorException $e) {
                do_action('cfpp_response_validation_exception', $shipping_method_slug);
                $shipping_costs[] = $cfpp_handler->response->error(new WP_Error($e->getCode(), $e->getMessage()));
            } catch (HandlerException $e) {
                do_action('cfpp_response_handler_exception', $shipping_method_slug);
                $shipping_costs[] = $cfpp_handler->response->error(new WP_Error($e->getCode(), $e->getMessage()));
            } catch (ResponseException $e) {
                do_action('cfpp_response_exception', $shipping_method_slug);
                $shipping_costs[] = $cfpp_handler->response->error(new WP_Error($e->getCode(), $e->getMessage()));
            }
        }

        $shipping_costs = $instance->orderShippingCosts($shipping_costs);
        $shipping_costs = $instance->removeErrorsForUnauthorizedUsers($shipping_costs);

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

    /**
     * Removes shipping methods with errors for users that doesn't have
     * manage_woocommerce capability
     *
     * @param array $shipping_costs
     * @return array
     */
    private function removeErrorsForUnauthorizedUsers(array $shipping_costs)
    {
        foreach ($shipping_costs as $index => $shipping_cost) {
            if ( ! current_user_can('manage_woocommerce') && $shipping_cost['status'] == 'error') {
                unset($shipping_costs[$index]);
            }
        }
        return $shipping_costs;
    }
}
