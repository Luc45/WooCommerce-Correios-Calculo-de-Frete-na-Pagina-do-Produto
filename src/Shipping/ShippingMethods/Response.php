<?php

namespace CFPP\Shipping\ShippingMethods;

class Response
{
    /**
     * @var string $name
     * @var string $status
     * @var string $class
     * @var        $price
     * @var        $days
     * @var mixed  $debug
     * @var bool   $should_display
     */
    public $name, $status, $class, $price, $days, $debug, $should_display;

    public function __construct(\WC_Shipping_Method $shipping_method)
    {
        $this->name = $shipping_method->method_title;
        $this->price = 'Undefined';
        $this->days = 'Undefined';
        $this->status = 'Undefined';
        $this->debug = '';
    }

    /**
    *   Returns a succesful response
    */
    public function success(
        $price,
        $days,
        $debug = '',
        $class = ''
    ) {
        try {
            $price = $this->formatPrice($price);
        } catch (\Exception $e) {
            $this->error(sprintf(
                /* translators: %s Invalid price */
                __('Tried to send a succesful response, but price was invalid: %s', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                $price
            ));
        }

        $days = $this->formatDays($days);

        $this->status = 'success';
        $this->price = $price;
        $this->days = $days;
        $this->debug = $debug;
        $this->class = $class;
        $this->should_display = true;
        return (array) $this;
    }

    /**
    *   Returns an error response
    */
    public function error(
        $debug = ''
    ) {
        $this->status = 'error';
        $this->debug = $debug;
        $this->class = 'cfpp-has-error';
        // Only show errors to logged in users
        $this->should_display = current_user_can('manage_options');

        return (array) $this;
    }

    /**
     * Formats a price to be returned
     */
    private function formatPrice($price)
    {
        if ($price === 0) {
            $price = __('Free', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        } else {
            $price = wc_correios_normalize_price(esc_attr((string) $price));
            if (is_numeric($price)) {
                $price = wc_price($price);
            } else {
                throw new \Exception();
            }
        }

        return $price;
    }

    /**
     * Formats a price to be returned
     */
    private function formatDays($days)
    {
        if (is_numeric($days)) {
            $days = (int) $days;
            return sprintf(
                /* translators: %d Estimated days for delivery */
                esc_html(_n('Up to a day', 'Up to %d days', $days, 'woo-correios-calculo-de-frete-na-pagina-do-produto')),
                $days
            );
        } else {
            return $days;
        }
    }

    /**
     * Generates a Response object for Not Supported Shipping Method notice
     *
     * @return $this
     */
    public function generateNotSupportedShippingMethodResponse()
    {
        $this->status = 'error';
        $this->debug = __('Shipping Method not supported by CFPP.', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->price = __('Please, proceed with the purchase normally.', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->days = '-';
        $this->class = 'cfpp_shipping_method_not_available';
        $this->should_display = false;

        return (array) $this;
    }

    /**
     * Generates a Response object for an Unknown Error in the Response of the handler
     *
     * @return $this
     */
    public function generateUnknownErrorResponse()
    {
        $this->status = 'error';
        $this->debug = __('Unknown response from the webservice request', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->price = __('Please, proceed with the purchase normally.', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        $this->days = '-';
        $this->class = 'cfpp_shipping_method_unknown_error';
        $this->should_display = false;

        return (array) $this;
    }


}
