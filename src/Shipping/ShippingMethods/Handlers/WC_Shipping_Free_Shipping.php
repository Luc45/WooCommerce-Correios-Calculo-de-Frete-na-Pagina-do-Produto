<?php

namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Exceptions\HandlerException;
use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Handler;

class WC_Shipping_Free_Shipping extends Handler
{
    /**
     * Receives a Request and calculates the shipping
     *
     * @param Payload $payload
     * @return mixed
     * @throws HandlerException
     * @throws \CFPP\Exceptions\ResponseException
     */
    public function calculate(Payload $payload)
    {
        // Check if this product is entitled for free shipping
        $should_show = $this->meetsFreeShippingRequirements($payload);

        if ($should_show) {
            $this->response->setDays(__('Contact us', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            $this->response->setPrice(0);
        } else {
            throw HandlerException::unexpected_result_exception(__('Does not meet free shipping requirements.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
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
