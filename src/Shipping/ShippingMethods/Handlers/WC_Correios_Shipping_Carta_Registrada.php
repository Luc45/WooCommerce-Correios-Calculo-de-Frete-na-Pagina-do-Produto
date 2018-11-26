<?php

namespace CFPP\Shipping\ShippingMethods\Handlers;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\Handler;
use CFPP\Shipping\ShippingMethods\Traits\ValidateDimensionsTrait;

class WC_Correios_Shipping_Carta_Registrada extends Handler
{
    use ValidateDimensionsTrait;

    /**
     * Receives a Request and calculates the shipping
     *
     * @param Payload $payload
     * @return \CFPP\Shipping\ShippingMethods\Response|mixed
     */
    public function calculate(Payload $payload)
    {
        $errors = $this->validate(array(
                      'maxWeight' => 0.5
                  ), $payload->getProduct());

        $price = $this->getPriceFromWooCommerceCorreios($payload);
        $days = $this->getEstimatedDeliveryDate();

        if (empty($errors) && is_numeric($price)) {
            return $this->response->success($price, $days);
        } else {
            return $this->response->error(implode(', ', $errors));
        }
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
        } catch (\Exception $e) {
            $cost = 'Prossiga com a compra normalmente para ver o preço deste método de entrega.';
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
}
