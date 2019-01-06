<?php

namespace CFPP\Exceptions;

/**
 * Class ShippingMethodsException
 * @package CFPP\Exceptions
 */
class ShippingMethodsException extends \Exception
{
    /**
     * Throws when trying to filter a shipping method that
     * is not an instance of \WC_Shipping_Method class
     *
     * @return ShippingMethodsException
     */
    public static function invalid_shipping_method_exception()
    {
        return new self(__('The provided Shipping Method is invalid. It must be an instance of \WC_Shipping_Method.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }

    /**
     * Throws when a shipping method could not be found
     * for that combination of postcode and product choices.
     *
     * @return ShippingMethodsException
     */
    public static function empty_shipping_methods_exception()
    {
        return new self(__('Could not find any shipping method for this postcode and product.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}