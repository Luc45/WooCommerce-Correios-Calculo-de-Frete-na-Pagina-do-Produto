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
            $cfpp_shipping_method = $factory->getClass(get_class($shipping_method));

            if ($cfpp_shipping_method === false)
                wp_send_json_error('Não foi possível instanciar a classe do Shipping Method: '.get_class($shipping_method));

            $shipping_costs[$cfpp_shipping_method->getName()] = $cfpp_shipping_method->calculate($request);
        }

        return $shipping_costs;
    }

}
