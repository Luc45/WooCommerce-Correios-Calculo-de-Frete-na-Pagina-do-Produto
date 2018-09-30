<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsFactory;

class ShippingMethods {

    /**
    *   Calculates the shipping costs from the shipping zones provided
    *
    *   @todo Provide feedback if $cfpp_shipping_method === false
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
                if ($cfpp_shipping_method === false)
                    continue;
                    //wp_send_json_error('Não foi possível instanciar a classe do Shipping Method: '.get_class($shipping_method));

                // Pass the Shipping Method class to the CFPP Shipping Method
                $cfpp_shipping_method->setup($shipping_method);

                $shipping_costs[$cfpp_shipping_method->getName()] = $cfpp_shipping_method->calculate($request);
            }
        }

        return $shipping_costs;
    }

}
