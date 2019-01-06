<?php

namespace CFPP\Exceptions;

/**
 * Class CostsException
 * @package CFPP\Exceptions
 */
class CostsException extends \Exception
{

    public static function shipping_methods_not_found_exception()
    {
        return new self(__('Could not find any shipping method for this postcode and product.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}