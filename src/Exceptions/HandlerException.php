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

    /**
     * Throws when the webservice response returns an error
     *
     * @return HandlerException
     */
    public static function webservice_error($webservice_error)
    {
        return new self($webservice_error);
    }

    /**
     * Throws when the Handler gets a generic unexpected result
     *
     * @return HandlerException
     */
    public static function unexpected_result_exception($result)
    {
        return new self(sprintf(
            __('Shipping Method Handler got an unexpected result: %s', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
            $result
        ));
    }
}