<?php

namespace CFPP\Shipping;

use CFPP\Shipping\ShippingMethods\ShippingMethodsFactory;

class ShippingMethods {

    /**
    *   Calculates the shipping costs from the shipping zones provided
    */
    public function calculateShippingOptions($shipping_methods, $request)
    {
        $shipping_costs = array();

        // Takes into account how many items we are requesting shipping for
        // $request = $this->multiplyMeasurementsByQuantity($request);

        // Get only enabled shipping methods
        $shipping_methods = $this->filterByEnabledShippingMethods($shipping_methods);

        // Get only shipping classes that matches the one from the product
        $shipping_methods = $this->filterByShippingClass($shipping_methods, $request);

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

                if (empty($response['status']) || $response['status'] != 'hide') {
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

    /**
     * Determines which shipping methods should show, according to shipping class
     * and requested product
     */
    private function filterByShippingClass($shipping_methods, $request)
    {
        foreach ($shipping_methods as $key => $shipping_method) {
            if (property_exists($shipping_method, 'shipping_class') && $shipping_method->shipping_class != '') {
                $product = wc_get_product($request['id']);
                if ($product->get_shipping_class() != $shipping_method->shipping_class) {
                    unset($shipping_methods[$key]);
                }
            }
        }
        return $shipping_methods;
    }

    /**
     * Multiplies the product measurements by the quantity requested
     */
    private function multiplyMeasurementsByQuantity($request)
    {
        foreach ($request as $medida => &$valor) {
            if (in_array($medida, array('height', 'width', 'length', 'weight', 'price'))) {
                $valor = $valor * $request['quantidade'];
            }
        }
        return $request;
    }
}
