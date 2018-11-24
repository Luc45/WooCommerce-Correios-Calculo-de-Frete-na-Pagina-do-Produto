<?php

namespace CFPP\Shipping\ShippingMethods\Methods;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Correios_Through_Webservice extends ShippingMethodsAbstract
{
    /**
     * Calculates shipping costs for a Payload object using reflection class on
     * WooCommerce Correios plugin
     *
     * @param Payload $payload
     * @return mixed
     * @throws \Exception
     */
    public function calculate(Payload $payload)
    {
        $package = $this->generatePackage($payload);

        try {
            $reflection_response = $this->getReflectionResponse($this->shipping_method, $package);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        if ($reflection_response['Erro'] == "0") {
            return $this->response->success(
                $reflection_response['Valor'],
                $reflection_response['PrazoEntrega'],
                $reflection_response
            );
        } else {
            return $this->response->error($reflection_response['MsgErro']);
        }
    }

    /**
     * Generate an package array, needed by WooCommerce Correios classes
     *
     * @param Payload $payload
     * @return array
     */
    public function generatePackage(Payload $payload)
    {
        $total_cost = $payload->getProduct()->get_price() * $payload->getQuantity();

        $package = array();
        $package['destination'] = array();
        $package['destination']['postcode'] = $payload->getPostcode();
        $package['contents_cost'] = $total_cost;
        $package['contents'] = array(
            $payload->getProduct()->get_id() => array(
                'data' => $payload->getProduct(),
                'quantity' => $payload->getQuantity()
            )
        );
        return $package;
    }

    /**
     * @param $shipping_method_class
     * @param $package
     * @return array|mixed|object
     * @throws \Exception
     */
    private function getReflectionResponse(\WC_Correios_Shipping $shipping_method, $package)
    {
        $r_class_name = get_class($shipping_method);
        try {
            $r_get_rate = new \ReflectionMethod($r_class_name, 'get_rate');
        } catch (\ReflectionException $e) {
            throw new \Exception('Unable to reflect ' . $r_class_name);
        }

        $r_get_rate->setAccessible(true);
        $r_response = $r_get_rate->invoke(new $r_class_name($this->shipping_method->instance_id), $package);

        if ($r_response instanceof \SimpleXMLElement === false) {
            throw new \Exception('Unexpected response from reflection method.');

        }
        return (array) $r_response;
    }
}
