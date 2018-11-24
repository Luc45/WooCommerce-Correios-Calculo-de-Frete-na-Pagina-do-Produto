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

    public function __construct($shipping_method)
    {
        $this->name = $shipping_method->method_title;
        $this->price = 'Indefinido';
        $this->days = 'Indefinido';
        $this->status = 'Indefinido';
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
        $price = $this->formatPrice($price);

        if ($price === false) {
            return $this->error('Tentou enviar uma resposta, porém preço foi inválido: ' . $price);
        }

        $days = $this->formatDays($days);

        $this->status = 'success';
        $this->price = $price;
        $this->days = $days;
        $this->debug = $debug;
        $this->class = $class;
        $this->should_display = true;
        return $this;
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

        return $this;
    }

    /**
     * Formats a price to be returned
     */
    private function formatPrice($price)
    {
        $price = str_replace('.', ',', $price);
        $price = wc_correios_normalize_price(esc_attr((string) $price));
        if (is_numeric($price)) {
            return wc_price($price);
        } elseif ($price === 'Grátis') {
            return $price;
        } else {
            return false;
        }
    }

    /**
     * Formats a price to be returned
     */
    private function formatDays($days)
    {
        if (is_numeric($days)) {
            $after_days = (int) $days > 1 ? ' dias' : ' dia';
            $before_days = apply_filters('cfpp_days_nomenclature', 'Em até ');
            return $before_days . $days . $after_days;
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
        $this->debug = 'Método não suportado pelo CFPP.';
        $this->price = 'Prossiga com a compra normalmente para ver o preço deste método de entrega.';
        $this->days = '-';
        $this->class = 'cfpp_shipping_method_not_available';
        $this->should_display = false;

        return $this;
    }

    /**
     * Generates a Response object for an Unknown Error in the Response of the handler
     *
     * @return $this
     */
    public function generateUnknownErrorResponse()
    {
        $this->status = 'error';
        $this->debug = 'Erro desconhecido na resposta da requisição.';
        $this->price = 'Prossiga com a compra normalmente para ver o preço deste método de entrega.';
        $this->days = '-';
        $this->class = 'cfpp_shipping_method_unknown_error';
        $this->should_display = false;

        return $this;
    }


}
