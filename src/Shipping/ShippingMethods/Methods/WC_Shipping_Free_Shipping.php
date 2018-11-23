<?php

namespace CFPP\Shipping\ShippingMethods\Methods;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Free_Shipping extends ShippingMethodsAbstract
{

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(Payload $payload)
    {
        // Check if this product is entitled for free shipping
        $should_show = $this->meetsFreeShippingRequirements($payload) ? true : false;

        if ($should_show) {
            return $this->response->success('Grátis', apply_filters('cfpp_free_shipping_days', 'Consulte-nos'));
        } else {
            return $this->response->error('Não se encaixa nos requisitos de frete grátis.');
        }
    }

    /**
    *   Check if current request meets free shipping requirements
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
