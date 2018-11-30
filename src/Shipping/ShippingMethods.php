<?php

namespace CFPP\Shipping;

class ShippingMethods
{
    /**
     * Receives an array of shipping methods and returns a filtered array of shipping methods
     *
     * Filters Enabled Shipping Methods
     * Filters Shipping Method by Product Shipping Class
     *
     * @param \WC_Shipping_Zone $shipping_zone
     * @param Payload $payload
     * @return array
     */
    public function getShippingMethods(\WC_Shipping_Zone $shipping_zone, \WC_Product $product)
    {
        $shipping_methods = $shipping_zone->get_shipping_methods();
        $shipping_methods = $this->filterByEnabledShippingMethods($shipping_methods);
        $shipping_methods = $this->filterByShippingClass($shipping_methods, $product);
        return $shipping_methods;
    }

    /**
     * Returns only enabled shipping methods
     *
     * @param array $shipping_methods
     * @return array
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
     *
     * @param array $shipping_methods
     * @param \WC_Product $product
     * @return array
     */
    private function filterByShippingClass(array $shipping_methods, \WC_Product $product)
    {
        foreach ($shipping_methods as $key => $shipping_method) {
            if (property_exists($shipping_method, 'shipping_class') && $shipping_method->shipping_class != '') {
                if ($product != $shipping_method->shipping_class) {
                    unset($shipping_methods[$key]);
                }
            }
        }
        return $shipping_methods;
    }
}
