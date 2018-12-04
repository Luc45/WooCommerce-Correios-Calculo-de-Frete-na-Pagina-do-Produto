<?php

namespace CFPP\Exceptions;

/**
 * Class FactoryException
 * @package CFPP\Exceptions
 */
class FactoryException extends CFPPException
{
    /**
     * Thrown when a custom handler is provided with add_filter,
     * but it is not an instance of abstract class
     * CFPP\Shipping\ShippingMethods\Handler
     *
     * @param $shipping_method_name
     * @return FactoryException
     */
    public static function invalid_custom_handler_exception($shipping_method_name)
    {
        return new self(sprintf(
        /* translators: %s class name for shipping method */
            __('Custom Handler provided for shipping method "%s" is invalid. The handler must extend CFPP\Shipping\ShippingMethods\Handler', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
            $shipping_method_name
        ), 201);
    }

    /**
     * Thrown when requested a handler for a shipping method,
     * and the handler was not found
     *
     * @param $shipping_method_name
     * @return FactoryException
     */
    public static function handler_not_found_exception($shipping_method_name)
    {
        return new self(sprintf(
        /* translators: %s class name for shipping method */
            __('Shipping method not currently supported by CFPP. Handler not found. (%s)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
            $shipping_method_name
        ), 202);
    }
}