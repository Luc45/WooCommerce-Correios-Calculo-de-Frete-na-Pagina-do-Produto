<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract,
    CFPP\Frontend\Shipping\ShippingMethods\Traits\WC_Correios_Shipping_Method_Trait;

class WC_Correios_Shipping_PAC_Shipping_Method extends ShippingMethodsAbstract {

    use WC_Correios_Shipping_Method_Trait;

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName()
    {
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
