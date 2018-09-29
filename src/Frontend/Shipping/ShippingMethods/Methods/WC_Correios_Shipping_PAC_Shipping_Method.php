<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsInterface;
    CFPP\Frontend\Shipping\ShippingMethods\Validations\WC_Correios_Shipping_Methods_Abstract;

class WC_Correios_Shipping_PAC_Shipping_Method extends WC_Correios_Shipping_Methods_Abstract implements ShippingMethodsInterface {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName() {
        return 'PAC';
    }

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request) {
        $request['produto_altura'];
        $request['produto_largura'];
        $request['produto_comprimento'];
        $request['produto_peso'];
        $request['produto_preco'];
    }

}
