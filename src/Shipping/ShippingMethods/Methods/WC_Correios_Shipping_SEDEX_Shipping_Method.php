<?php

use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;
use CFPP\Shipping\ShippingMethods\Traits\ValidateDimensionsTrait;
use CFPP\Shipping\ShippingMethods\Traits\WC_Correios_Webservice_Trait;

class WC_Correios_Shipping_SEDEX_Shipping_Method extends ShippingMethodsAbstract
{
    use ValidateDimensionsTrait;
    use WC_Correios_Webservice_Trait;

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {
        $request = $this->setupQuantity($request);

        $errors = $this->validate(array(
            'height' => array(
                'max' => 105,
                'min' => $this->shipping_method->minimum_height
            ),
            'width' => array(
                'max' => 105,
                'min' => $this->shipping_method->minimum_width
            ),
            'length' => array(
                'max' => 105,
                'min' => $this->shipping_method->minimum_length
            ),
            'maxWeight' => 30,
            'maxPrice' => 10000,
            'checkSumHeightWidthLength' => 200
        ), $request);

        // Quick bail if validation fails
        if (empty($errors)) {
            $correiosWebServiceResponse = $this->correiosWebService($request);

            // If error after Webservice request
            if ($correiosWebServiceResponse['status'] == 'error') {
                return $this->response->error($correiosWebServiceResponse['debug']);
            }

            return $this->response->success(
                $correiosWebServiceResponse['price'],
                $correiosWebServiceResponse['days'],
                $correiosWebServiceResponse['debug']
            );
        } else {
            return $this->response->error(implode(', ', $errors));
        }
    }

    public function setupQuantity(array $request) {
        return $request;
    }
}
