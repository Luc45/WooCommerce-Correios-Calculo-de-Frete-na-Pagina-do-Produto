<?php

namespace CFPP\Exceptions;

/**
 * Class ResponseException
 * @package CFPP\Exceptions
 */
class ResponseException extends \Exception
{

    public static function invalid_price_exception()
    {
        return new self(__('Price provided for response was invalid.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}