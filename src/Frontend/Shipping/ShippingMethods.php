<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsFactory;

class ShippingMethods {

    /**
    *   Calculates the shipping costs from the shipping zones provided
    */
    public function calculateShippingOptions($shipping_methods, $request)
    {
        $shipping_costs = array();

        $shipping_methods = $this->filterByEnabledShippingMethods($shipping_methods);

        $factory = new ShippingMethodsFactory;

        foreach ($shipping_methods as $shipping_method) {

                // Get CFPP instance of Shipping Method
                $shipping_method_instance = $factory->getInstance(get_class($shipping_method));

                // If we don't support this Shipping Method, it will return false.
                if ($shipping_method_instance === false) {
                    $shipping_costs[] = array(
                        'name' => $shipping_method->method_title,
                        'status' => 'show',
                        'price' => 'Prossiga com a compra normalmente para ver o preço deste método de entrega.',
                        'days' => '-',
                        'additional_class' => 'cfpp_shipping_method_not_available',
                        'priceColSpan' => 2
                    );
                    continue;
                }

                // Pass the Shipping Method class to the CFPP Shipping Method
                $shipping_method_instance->setup($shipping_method);

                // Go to specific shipping method class to calculate
                $response = $shipping_method_instance->calculate($request);

                // Normalize output
                if (empty($response['class'])) {
                    $response['class'] = '';
                }

                if ($response['status'] != 'hide') {
                    $shipping_costs[] = $response;
                }
        }

        return $shipping_costs;
    }

    /**
     * Receives an array of Shipping Methods instances,
     */
    private function filterByEnabledShippingMethods($shipping_methods)
    {
        $enabled_shipping_methods = array();
        foreach ($shipping_methods as $shipping_method) {
            if (property_exists($shipping_method, 'enabled') && $shipping_method->enabled == 'yes') {
                $enabled_shipping_methods[] = $shipping_method;
            }
        }
        return $enabled_shipping_methods;
    }
}
