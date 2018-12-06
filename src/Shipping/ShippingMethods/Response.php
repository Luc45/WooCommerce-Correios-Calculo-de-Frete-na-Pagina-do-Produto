<?php

namespace CFPP\Shipping\ShippingMethods;

use CFPP\Exceptions\ResponseException;

class Response
{
    /**
     * @var string $name
     * @var string $status
     * @var string $class
     * @var        $price
     * @var        $days
     * @var mixed  $debug
     */
    public $name, $status, $price, $class, $days, $debug, $should_display, $error_code;

    public function __construct(\WC_Shipping_Method $shipping_method)
    {
        $this->name = $shipping_method->method_title;
        $this->price = __('Undefined', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->days = __('Undefined', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->status = __('Undefined', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->debug = '';
    }

    /**
     * @param $days
     */
    public function setDays($days)
    {
        if (is_numeric($days)) {
            $days = (int) $days;
            $this->days = sprintf(
                /* translators: %d Estimated days for delivery */
                esc_html(_n('Up to a day', 'Up to %d days', $days, 'woo-correios-calculo-de-frete-na-pagina-do-produto')),
                $days
            );
        } else {
            $this->days = $days;
        }
    }

    /**
     * @param $price
     * @throws ResponseException
     */
    public function setPrice($price)
    {
        if ($price === 0) {
            $price = __('Free', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        } else {
            $price = wc_correios_normalize_price(esc_attr((string) $price));
            if (is_numeric($price)) {
                $price = wc_price($price);
            } else {
                throw ResponseException::invalid_price_exception();
            }
        }

        $this->price = $price;
    }

    /**
     * @param $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param $class
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
    *   Returns a succesful response
    */
    public function success() {
        $this->status = 'success';
        return (array) $this;
    }

    /**
    *   Returns an error response
    */
    public function error(\WP_Error $wp_error) {
        $this->status = 'error';
        $this->setClass('cfpp-has-error');
        $this->setDebug($wp_error->get_error_message());
        $this->error_code = $wp_error->get_error_code();

        return (array) $this;
    }
}
