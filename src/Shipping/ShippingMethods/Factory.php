<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Exceptions\FactoryException;

/**
 * Class Factory
 *
 * Creates CFPP Handler classes for given Shipping Methods
 *
 * @package CFPP\Shipping\ShippingMethods
 */
class Factory
{
    /**
     * Here we map a shipping method name to a class
     * that will handle it's request
     *
     * @return array
     */
    protected function getFactoryMap()
    {
        return [
            /** WooCommerce Correios */
            'WC_Correios_Shipping_SEDEX_Hoje'           => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_12'             => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_10_Pacote'      => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX_10_Envelope'    => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_SEDEX'                => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_PAC'                  => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Mercadoria_Expressa'  => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Mercadoria_Economica' => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Leve_Internacional'   => 'WC_Correios_Through_Webservice',
            'WC_Correios_Shipping_Carta_Registrada'     => 'WC_Correios_Shipping_Carta_Registrada',
            // @todo implement following methods
            // 'WC_Correios_Shipping_Impresso_Urgente'  => 'WC_Correios_Shipping_Impresso_Urgente',
            // 'WC_Correios_Shipping_Impresso_Normal'   => 'WC_Correios_Shipping_Impresso_Normal',

            /** WooCommerce */
            'WC_Shipping_Flat_Rate'                     => 'WC_Shipping_Flat_Rate',
            'WC_Shipping_Free_Shipping'                 => 'WC_Shipping_Free_Shipping',
            'WC_Shipping_Local_Pickup'                  => 'WC_Shipping_Local_Pickup',
        ];
    }

    /**
     * Returns Handler concrete class for Shipping Method
     *
     * @param \WC_Shipping_Method $shipping_method
     * @return Handler
     * @throws FactoryException
     */
    public static function createHandler(\WC_Shipping_Method $shipping_method)
    {
        $instance = new self;
        $shipping_method_name = get_class($shipping_method);
        $shipping_method_slug = sanitize_title(get_class($shipping_method));

        /** Give the user a chance to override shipping method handler */
        $custom_handler = apply_filters('cfpp_custom_handler_' . $shipping_method_slug, null);

        if ( ! empty($custom_handler)) {
            if ($custom_handler instanceof Handler) {
                return new $custom_handler($shipping_method);
            } else {
                do_action('cfpp_exception_invalid_custom_handler', $shipping_method);
                throw FactoryException::invalid_custom_handler_exception($shipping_method_name);
            }
        }

        /** @todo remove cfpp_custom_handler_* */
        /** @todo add method to add a factory handler */
        $shipping_methods_handlers = apply_filters('cfpp_factory_map', $instance->getFactoryMap());

        if (array_key_exists($shipping_method_name, $shipping_methods_handlers) &&
            file_exists(__DIR__ . '/Handlers/' . $shipping_methods_handlers[$shipping_method_name] .'.php')
        ) {
            $class = "\\CFPP\\Shipping\\ShippingMethods\\Handlers\\" . $shipping_methods_handlers[$shipping_method_name];
            return new $class($shipping_method);
        } else {
            throw FactoryException::handler_not_found_exception($shipping_method_name);
        }
    }
}
