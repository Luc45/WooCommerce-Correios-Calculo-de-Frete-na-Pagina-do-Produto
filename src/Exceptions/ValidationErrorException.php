<?php

namespace CFPP\Exceptions;

/**
 * Class ValidationErrorException
 * @package CFPP\Exceptions
 */
class ValidationErrorException extends \Exception
{
    /**
     * Throws when a Payload fails a Handler validation
     *
     * @param $message
     * @return ValidationErrorException
     */
    public static function validation_error($message)
    {
        /** Already i18n */
        return new self($message);
    }
}