<?php

namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Handler;

class WC_Shipping_Local_Pickup extends Handler
{
    /**
     * Receives a Request and calculates the shipping
     *
     * @param Payload $payload
     * @return \CFPP\Shipping\ShippingMethods\Response|mixed
     */
    public function calculate(Payload $payload)
    {
        // Additional cost for local pickup?
        $cost = is_numeric($this->shipping_method->cost) ? $this->shipping_method->cost : 0;

        return $this->response->success($cost, apply_filters('cfpp_local_pickup_days', 'Consulte-nos'));
    }
}
