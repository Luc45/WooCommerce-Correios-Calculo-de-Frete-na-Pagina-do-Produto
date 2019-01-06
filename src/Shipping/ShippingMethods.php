<?php

namespace CFPP\Shipping;

use CFPP\Exceptions\ShippingMethodsException;

class ShippingMethods
{
    /**
     * Receives an array of shipping methods and returns a
     * filtered array of shipping methods
     *
     * Filters by Enabled Shipping Methods
     * Filters by Product Shipping Class
     *
     * @param $shipping_methods
     * @param \WC_Product $product
     * @return array
     * @throws ShippingMethodsException
     */
    public static function filterShippingMethods($shipping_methods, \WC_Product $product)
    {
        $instance = new self;

        $shipping_methods = apply_filters('cfpp_get_shipping_methods', $shipping_methods, $product);

        // Validation and error handling
        if (empty($shipping_methods)) {
            throw ShippingMethodsException::empty_shipping_methods_exception();
        } else {
            foreach ($shipping_methods as $shipping_method) {
                if ($shipping_method instanceof \WC_Shipping_Method === false) {
                    throw ShippingMethodsException::invalid_shipping_method_exception();
                }
            }
        }

        $shipping_methods = $instance->filterByShippingClass($shipping_methods, $product);

        return $shipping_methods;
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
