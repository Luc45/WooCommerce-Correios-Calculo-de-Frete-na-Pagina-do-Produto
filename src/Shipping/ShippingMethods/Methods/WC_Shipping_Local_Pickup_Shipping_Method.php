<?php

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Local_Pickup_Shipping_Method extends ShippingMethodsAbstract
{

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        // Additional cost for local pickup?
        $cost = is_numeric($this->shipping_method->cost) ? $this->shipping_method->cost : 'Grátis';

        return $this->response->success($cost, apply_filters('cfpp_local_pickup_days', 'Consulte-nos'));
    }
}
