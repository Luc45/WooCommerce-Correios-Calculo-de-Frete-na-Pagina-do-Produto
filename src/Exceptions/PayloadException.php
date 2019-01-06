<?php

namespace CFPP\Exceptions;

/**
 * Class PayloadException
 * @package CFPP\Exceptions
 */
class PayloadException extends \Exception
{
    /**
     * Thrown when trying to generate Payload object with
     * variation information for product that is not variable.
     *
     * @param \WC_Product $product
     * @return PayloadException
     */
    public static function product_is_not_variable(\WC_Product $product)
    {
        return new self(sprintf(
                /* translators: %s: Product name */
                __('Could not calculate shipping with variation data for product that is not variable. (%s)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                $product->get_name()
            ));
    }

    /**
     * Thrown when couldn't generate a Package object
     * for the Payload
     *
     * @param string $error
     * @return PayloadException
     */
    public static function invalid_package_exception($error)
    {
        return new self($error);
    }
}
