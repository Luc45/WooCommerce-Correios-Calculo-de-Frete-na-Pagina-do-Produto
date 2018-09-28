<?php

namespace CFPP\Frontend\Shipping\ShippingMethods;

use CFPP\Frontend\Shipping\ShippingMethodsInterface;

class WC_Correios_Shipping_PAC implements ShippingMethodsInterface {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getDisplayName() {
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
