<?php

namespace CFPP\Exceptions;

/**
 * Class CostsException
 * @package CFPP\Exceptions
 */
class CostsException extends \Exception
{
    /**
     * Throws when an invalid Shipping Zone object is encountered.
     *
     * @return CostsException
     */
    public static function invalid_shipping_zone_exception()
    {
        return new self(__('Could not find a matching shipping zone for this postcode.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }


    /**
     * Throws when a shipping method could not be found
     * for that combination of postcode and product choices.
     *
     * @return CostsException
     */
    public static function shipping_methods_not_found_exception()
    {
        return new self(__('Could not find any shipping method for this postcode and product.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}