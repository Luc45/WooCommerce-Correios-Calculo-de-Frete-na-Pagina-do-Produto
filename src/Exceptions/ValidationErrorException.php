<?php

namespace CFPP\Exceptions;

/**
 * Class ValidationErrorException
 * @package CFPP\Exceptions
 */
class ValidationErrorException extends CFPPException
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
        //return new self($message, self::generateCode(__CLASS__) + 1);
        return new self($message, 1001);
    }

    public static function invalid_response($message)
    {
        return new self($message, 1002);
    }
}