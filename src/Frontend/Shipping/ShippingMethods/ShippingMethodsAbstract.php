<?php

namespace CFPP\Frontend\Shipping\ShippingMethods;

abstract class ShippingMethodsAbstract
{
    protected $shipping_method;

    public function setup($shipping_method) {
        // Stores a copy of the original shipping method class, so we can get costs, etc
        $this->shipping_method = $shipping_method;

        // Includes WooCommerce Math Class
        require_once(WP_PLUGIN_DIR.'/woocommerce/includes/libraries/class-wc-eval-math.php');
    }

    abstract public function getName();
    abstract public function calculate(array $request);
}
