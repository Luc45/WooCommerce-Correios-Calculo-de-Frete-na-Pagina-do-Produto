<?php

namespace CFPP\Shipping\ShippingMethods;

class ShippingMethodsFactory
{
    /**
    *   Returns a Shipping Method class
    */
    public function getInstance($shipping_method)
    {
        // String type-hinting for older versions of PHP
        if (gettype($shipping_method) != 'string') {
            return false;
        }

        $classes_map = array(
            'WC_Correios_Shipping_SEDEX_Hoje' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_12' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_10_Pacote' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_10_Envelope' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_PAC' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Mercadoria_Expressa' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Mercadoria_Economica' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Leve_Internacional' => 'WC_Correios_Through_Webservice',

            'WC_Correios_Shipping_Carta_Registrada' => 'WC_Correios_Shipping_Carta_Registrada',
            'WC_Shipping_Flat_Rate' => 'WC_Shipping_Flat_Rate',
            'WC_Shipping_Free_Shipping' => 'WC_Shipping_Free_Shipping',
            'WC_Shipping_Local_Pickup' => 'WC_Shipping_Local_Pickup',

            // todo
            'WC_Correios_Shipping_Impresso_Urgente' => 'WC_Correios_Shipping_Impresso_Urgente',
            'WC_Correios_Shipping_Impresso_Normal' => 'WC_Correios_Shipping_Impresso_Normal',
        );

        if (
            array_key_exists($shipping_method, $classes_map) &&
            file_exists(__DIR__ . '/Methods/' . $classes_map[$shipping_method] .'.php')
        ) {
            $class = "\\CFPP\\Shipping\\ShippingMethods\\Methods\\" . $classes_map[$shipping_method];
            return new $class;
        } else {
            return false;
        }
    }
}
