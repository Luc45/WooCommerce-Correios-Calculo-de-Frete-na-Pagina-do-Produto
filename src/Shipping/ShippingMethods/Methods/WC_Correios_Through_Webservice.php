<?php

namespace CFPP\Shipping\ShippingMethods\Methods;

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Correios_Through_Webservice extends ShippingMethodsAbstract
{
    /**
     *   Receives a Request and calculates the shipping
     */
    public function calculate(array $request)
    {
        $shipping_method_class = get_class($this->shipping_method);

        $package = $this->generatePackage($request);
        $reflection_get_rate = new \ReflectionMethod($shipping_method_class, 'get_rate');
        $reflection_get_rate->setAccessible(true);
        $response = $reflection_get_rate->invoke(new $shipping_method_class($this->shipping_method->instance_id), $package);
        $response = json_decode(json_encode((array) $response));

        if ($response !== null) {
            if ($response->Erro == "0") {
                return $this->response->success(
                    $response->Valor,
                    $response->PrazoEntrega,
                    $response
                );
            } else {
                return $this->response->error($response->MsgErro);
            }
        }
        return $this->response->error('Erro de Webservice.');
    }

    public function generatePackage(array $request)
    {
        $total_cost = $request['product']->get_price() * $request['quantity'];

        $package = array();
        $package['destination'] = array();
        $package['destination']['postcode'] = $request['destination_postcode'];
        $package['contents_cost'] = $total_cost;
        $package['contents'] = array(
            $request['id'] => array(
                'data' => $request['product'],
                'quantity' => $request['quantity']
            )
        );
        return $package;
    }
}
