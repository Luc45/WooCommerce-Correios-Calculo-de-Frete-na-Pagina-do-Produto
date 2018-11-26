<?php

namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Handler;

class WC_Shipping_Free_Shipping extends Handler
{
    /**
     * Receives a Request and calculates the shipping
     *
     * @param Payload $payload
     * @return \CFPP\Shipping\ShippingMethods\Response|mixed
     */
    public function calculate(Payload $payload)
    {
        // Check if this product is entitled for free shipping
        $should_show = $this->meetsFreeShippingRequirements($payload) ? true : false;

        if ($should_show) {
            return $this->response->success(0, apply_filters('cfpp_free_shipping_days', 'Consulte-nos'));
        } else {
            return $this->response->error('Não se encaixa nos requisitos de frete grátis.');
        }
    }

    /**
     * Check if current request meets free shipping requirements
     *
     * @param Payload $payload
     * @return bool
     */
    private function meetsFreeShippingRequirements(Payload $payload)
    {
        if (empty($this->shipping_method->requires)) {
            return true;
        } elseif ($this->shipping_method->requires == 'min_amount' || $this->shipping_method->requires == 'either') {
            if (is_numeric($this->shipping_method->min_amount)) {
                if (($payload->getProduct()->get_price() * $payload->getQuantity()) >= $this->shipping_method->min_amount) {
                    return true;
                }
            }
        }
        return false;
    }
}
