<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Local_Pickup_Shipping_Method extends ShippingMethodsAbstract {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName()
    {
        return 'Retirar no Local';
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
