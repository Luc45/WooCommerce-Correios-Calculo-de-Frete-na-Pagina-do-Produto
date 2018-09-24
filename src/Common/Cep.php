<?php

namespace CFPP\Common;

class Cep {

    /**
     * Returns Origin CEP
     */
    public function getOriginCep()
    {
        // Preference for the CEP defined in the constant
        return defined('CFPP_CEP') ? CFPP_CEP : get_option( 'woocommerce_store_postcode' );
    }

    /**
     * Checks if given CEP is valid
     *
     *  @param string $cep Cep to check if valid
     *  @return boolean
     */
    public function isValid(string $cep)
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) == 8;
    }

}
