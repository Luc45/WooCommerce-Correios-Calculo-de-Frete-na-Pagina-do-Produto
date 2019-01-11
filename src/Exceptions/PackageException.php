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
        return new self(__('Could not validate product dimensions. Check if product width, height, length and weight are valid.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'), 501);
    }
}