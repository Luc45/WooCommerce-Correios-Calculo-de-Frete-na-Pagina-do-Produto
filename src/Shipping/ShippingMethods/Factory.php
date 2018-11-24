<?php

namespace CFPP\Shipping\ShippingMethods;

class Factory
{
    /**
    *   Returns a Shipping Method class
    */
    public static function create($shipping_method)
    {
        // Object type-hinting for PHP < 7.2
        if (!is_object($shipping_method)) {
            throw new \Exception('Shipping method must be an object.');
        }

        $shipping_method_name = get_class($shipping_method);

        /**
         * Here we map a shipping method name to a class that will handle it's request
         */
        $shipping_methods_handlers = array(
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
            // 'WC_Correios_Shipping_Impresso_Urgente' => 'WC_Correios_Shipping_Impresso_Urgente',
            // 'WC_Correios_Shipping_Impresso_Normal' => 'WC_Correios_Shipping_Impresso_Normal',
        );

        if (array_key_exists($shipping_method_name, $shipping_methods_handlers) &&
            file_exists(__DIR__ . '/Methods/' . $shipping_methods_handlers[$shipping_method_name] .'.php')
        ) {
            $class = "\\CFPP\\Shipping\\ShippingMethods\\Methods\\" . $shipping_methods_handlers[$shipping_method_name];
            return new $class;
        } else {
            throw new \Exception('Method not supported or handler not found.');
        }
    }
}
