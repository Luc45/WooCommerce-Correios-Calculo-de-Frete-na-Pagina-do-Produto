<?php

namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Exceptions\HandlerException;
use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Handler;
use CFPP\Shipping\ShippingMethods\Traits\ValidationRules;

class WC_Correios_Shipping_Carta_Registrada extends Handler
{
    /**
     * Receives a Request and calculates the shipping
     *
     * @param Payload $payload
     * @return mixed
     * @throws \CFPP\Exceptions\ResponseException
     */
    public function calculate(Payload $payload)
    {
        // Calculate costs
        $price = $this->getPriceFromWooCommerceCorreios($payload);
        $days = $this->getEstimatedDeliveryDate();

        $this->response->setDays($days);
        $this->response->setPrice($price);
    }

    /**
     * Uses WooCommerce Correios Classes to get the cost
     *
     * @param Payload $payload
     * @return mixed|string
     */
    private function getPriceFromWooCommerceCorreios(Payload $payload)
    {
        $request = array(
            'destination' => array (
                'country' => 'BR',
                'postcode' => $payload->getPostcode()
            ),
            'contents' => array(
                array(
                    'data' => $payload->getProduct(),
                    'quantity' => $payload->getQuantity()
                )
            )
        );

        try {
            // Protected method. Let's access it through ReflectionMethod
            $r = new \ReflectionMethod('WC_Correios_Shipping_Carta_Registrada', 'get_shipping_cost');
            $r->setAccessible(true);
            $cost = $r->invoke(new \WC_Correios_Shipping_Carta_Registrada($this->shipping_method->instance_id), $request);
        } catch (\ReflectionException $e) {
            return false;
        }

        return $cost;
    }

    /**
     * Get the estimated delivery date for this shipping method
     *
     * @return string
     */
    private function getEstimatedDeliveryDate()
    {
        $days = '-';
        if (property_exists($this->shipping_method, 'show_delivery_time') &&
            $this->shipping_method->show_delivery_time == 'yes' &&
            property_exists($this->shipping_method, 'additional_time') &&
            is_numeric($this->shipping_method->additional_time)
        ) {
            $day_or_days = $this->shipping_method->additional_time > 1 ? 'dias' : 'dia';
            $days = $this->shipping_method->additional_time . ' ' . $day_or_days;
        }
        return $days;
    }

    /**
     * Set default validation rules, if not set
     *
     * @return $this
     */
    public function beforeValidateRequest()
    {
        add_filter('cfpp_handler_rules_wc_shipping_carta_registrada', function(ValidationRules $rules) {
            $rules->setDefault('weight', null, 0.5);
            return $rules;
        });
        return $this;
    }
}
