<?php

namespace CFPP;

use CFPP\Exceptions\MinimumRequirementNotMetException;

class Requirements
{
    CONST MINIMUM_PHP_VERSION = '5.4.0';
    CONST MINIMUM_WOOCOMMERCE_VERSION = '3.2.0';
    CONST MINIMUM_WORDPRESS_VERSION = '4.4.0';

    /**
     * @throws MinimumRequirementNotMetException
     */
    public function checkMinimumRequirements()
    {
        if ($this->phpVersionNotSupported()) {
            throw MinimumRequirementNotMetException::php_version_not_supported(self::MINIMUM_PHP_VERSION);
        }

        if ($this->wooCommerceNotActive()) {
            throw MinimumRequirementNotMetException::woocommerce_not_active();
        }

        if ($this->wooCommerceVersionNotSupported()) {
            throw MinimumRequirementNotMetException::woocommerce_version_not_supported(self::MINIMUM_WOOCOMMERCE_VERSION);
        }

        if ($this->invalidOriginPostcode()) {
            throw MinimumRequirementNotMetException::invalid_origin_postcode();
        }

        if ($this->wordpressVersionNotSupported()) {
            throw MinimumRequirementNotMetException::wordpress_version_not_supported(self::MINIMUM_WORDPRESS_VERSION);
        }
    }

    /**
     * Returns true if PHP version is NOT supported
     *
     * @return mixed
     */
    private function phpVersionNotSupported()
    {
        return version_compare(phpversion(), self::MINIMUM_PHP_VERSION, '<');
    }

    /**
     * Returns true if WooCommerce plugin is NOT active
     *
     * @return bool
     */
    private function wooCommerceNotActive()
    {
        return ! function_exists('WC');
    }

    /**
     * Returns true if WooCommerce version is NOT supported
     *
     * @return bool
     */
    private function wooCommerceVersionNotSupported()
    {
        return version_compare(WC()->version, self::MINIMUM_WOOCOMMERCE_VERSION, "<") && defined('CFPP_CEP') === false;
    }

    /**
     * Returns true if an origin postcode is NOT valid
     *
     * @return bool
     */
    private function invalidOriginPostcode()
    {
        $cep = Helpers::getOriginCep();
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) != 8;
    }

    /**
     * Returns true if WordPress version is NOT supported
     *
     * @return bool
     */
    private function wordpressVersionNotSupported()
    {
        global $wp_version;
        return version_compare($wp_version, self::MINIMUM_WORDPRESS_VERSION, '<');
    }
}
