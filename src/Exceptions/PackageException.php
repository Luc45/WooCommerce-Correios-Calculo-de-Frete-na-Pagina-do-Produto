<?php

namespace CFPP\Exceptions;

/**
 * Class PackageException
 * @package CFPP\Exceptions
 */
class PackageException extends \Exception
{
    /**
     * @return PackageException
     */
    public static function invalid_package()
    {
        return new self(__('Could not generate a valid Package for Payload object.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}