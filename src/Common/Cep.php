<?php

namespace CFPP\Common;

class Cep
{

    /**
     * Returns Origin CEP
     */
    public static function getOriginCep()
    {
        // Preference for the CEP defined in the constant
        return defined('CFPP_CEP') ? CFPP_CEP : get_option('woocommerce_store_postcode');
    }
}
