<?php

namespace CFPP\Exceptions;

/**
 * Class ShippingZoneException
 * @package CFPP\Exceptions
 */
class ShippingZoneException extends \Exception
{
    /**
     * @return ShippingZoneException
     */
    public static function invalid_shipping_zone_exception()
    {
        return new self(__('The provided Shipping Zone is invalid. It must be an instance of \WC_Shipping_Zone.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}