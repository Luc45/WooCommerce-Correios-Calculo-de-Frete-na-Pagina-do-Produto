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

        $factory = new ShippingMethodsFactory;

        foreach ($shipping_methods as $shipping_method) {
            if ($shipping_method->enabled == 'yes') {
                // Gets the Shipping_Method Class
                $cfpp_shipping_method = $factory->getClass(get_class($shipping_method));

                // Makes sure CFPP have Method created for this
                if ($cfpp_shipping_method === false) {
                    $shipping_costs[] = array(
                        'name' => $cfpp_shipping_method->method_title,
                        'status' => 'show',
                        'price' => 'Prossiga com a compra normalmente para ver o preço deste método de entrega.',
                        'days' => '-',
                        'additional_class' => 'cfpp_shipping_method_not_available',
                        'priceColSpan' => 2
                    );
                    continue;
                }

                // Pass the Shipping Method class to the CFPP Shipping Method
                $cfpp_shipping_method->setup($shipping_method);

                // Go to specific shipping method class to calculate
                $response = $cfpp_shipping_method->calculate($request);

                // Normalize output
                if (empty($response['class']))
                    $response['class'] = '';

                if ($response['status'] != 'hide') {
                    $shipping_costs[] = $response;
                }
            }
        }

        return $shipping_costs;
    }

}
