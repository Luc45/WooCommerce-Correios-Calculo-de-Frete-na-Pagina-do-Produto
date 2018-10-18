<?php

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;
use CFPP\Shipping\ShippingMethods\Traits\ValidateDimensionsTrait;

class WC_Correios_Shipping_Carta_Registrada_Shipping_Method extends ShippingMethodsAbstract
{
    use ValidateDimensionsTrait;

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        $request = $this->setupQuantity($request);

        $errors = $this->validate(array(
            'maxWeight' => 0.5
        ), $request);

        $price = $this->getPriceFromWooCommerceCorreios($request);
        $days = $this->getEstimatedDeliveryDate();

        if (empty($errors) && is_numeric($price)) {
            return $this->response->success($price, $days);
        } else {
            return $this->response->error(implode(', ', $errors));
        }
    }

    public function setupQuantity(array $request) {
        $request['weight'] = $request['weight'] * $request['quantity'];
        return $request;
    }

    /**
     * Uses WooCommerce Correios Classes to get the cost
     */
    private function getPriceFromWooCommerceCorreios($request)
    {
        $carta = new WC_Correios_Shipping_Carta_Registrada($this->shipping_method->instance_id);

        $request = array(
            'destination' => array (
                'country' => 'BR',
                'postcode' => $request['destination_postcode']
            ),
            'contents' => array(
                array(
                    'data' => wc_get_product($request['id']),
                    'quantity' => $request['quantity']
                )
            )
        );

        try {
            // Protected method. Let's access it through ReflectionMethod
            $r = new ReflectionMethod('WC_Correios_Shipping_Carta_Registrada', 'get_shipping_cost');
            $r->setAccessible(true);
            $cost = $r->invoke(new WC_Correios_Shipping_Carta_Registrada($this->shipping_method->instance_id), $request);
        } catch (Exception $e) {
            $cost = 'Prossiga com a compra normalmente para ver o preço deste método de entrega.';
        }

        return $cost;
    }

    /**
     * Get the estimated delivery date for this shipping method
     */
    private function getEstimatedDeliveryDate()
    {
        $days = '-';
        if (
            property_exists($this->shipping_method, 'show_delivery_time') &&
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
