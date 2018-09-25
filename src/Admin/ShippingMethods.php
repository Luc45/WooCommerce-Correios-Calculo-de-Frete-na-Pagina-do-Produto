<?php

namespace CFPP\Admin;

class ShippingMethods {

    /**
    *   Returns an array of available Shipping Methods
    */
    public function getShippingMethods()
    {
        return array(
            'WC_Correios_Shipping_PAC' => 'PAC',
            'WC_Correios_Shipping_SEDEX' => 'SEDEX',
        );
    }

}
