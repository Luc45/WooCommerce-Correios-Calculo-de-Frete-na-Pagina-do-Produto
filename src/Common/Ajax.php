<?php

namespace CFPP\Common;

use CFPP\Frontend\Shipping\Shipping;

class Ajax
{

    /**
    *   Listens for Ajax calls on the front-end
    */
    public function listen()
    {
        $shipping = new Shipping;
        add_action('wp_ajax_cfpp_request_shipping_costs', array($shipping, 'calculateShippingCostsAjax'));
        add_action('wp_ajax_nopriv_cfpp_request_shipping_costs', array($shipping, 'calculateShippingCostsAjax'));
    }
}
