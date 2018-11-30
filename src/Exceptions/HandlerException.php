<?php

namespace CFPP\Exceptions;

/**
 * Class HandlerException
 * @package CFPP\Exceptions
 */
class HandlerException extends \Exception
{
    /**
     * Throws when try to reflect a class and fails
     *
     * @param $r_class_name
     * @return HandlerException
     */
    public static function unable_to_reflect_exception($r_class_name)
    {
        return new self(sprintf(
            /* translators: %s class name that tried reflect and failed */
            __('Unable to reflect %s', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
            $r_class_name
        ));
    }
    /**
     * Throws when Response from reflected class is unexpected
     *
     * @return HandlerException
     */
    public static function unexpected_reflection_response_exception()
    {
        return new self(__('Unexpected response from reflection method.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }
}