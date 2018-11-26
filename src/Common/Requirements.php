<?php

namespace CFPP\Common;

class MinimumRequirementNotMetException extends \Exception {}

class Requirements
{
    CONST MINIMUM_PHP_VERSION = '5.4.0';
    CONST MINIMUM_WOOCOMMERCE_VERSION = '3.2.0';

    /**
     * @throws MinimumRequirementNotMetException
     */
    public function checkMinimumRequirements()
    {
        if (!$this->phpVersionSupported()) {
            throw new MinimumRequirementNotMetException(sprintf(
                /* translators: %s: Minimum PHP version number */
                __('Minimum PHP version required: %s', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                self::MINIMUM_PHP_VERSION
            ));
        }

        if (!$this->wooCommerceInstalled()) {
            throw new MinimumRequirementNotMetException(__('WooCommerce plugin must be active to use this plugin.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        if (!$this->wooCommerceVersionSupported()) {
            throw new MinimumRequirementNotMetException(sprintf(
                /* translators: %s: Minimum WooCommerce version number */
                __('CFPP requires WooCommerce %s or higher. Optionally, you can add this code to your wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (add it right under WP_DEBUG)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                self::MINIMUM_WOOCOMMERCE_VERSION
            ));
        }

        if (!$this->validOriginCep()) {
            if (defined('CFPP_CEP')) {
                throw new MinimumRequirementNotMetException(__('Constant CFPP_CEP is in an invalid format, please fill it in this exact format: XXXXX-XXX, replacing X by the number of your postcode.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            } else {
                throw new MinimumRequirementNotMetException(__('Before using this plugin, please configure your store postcode in WooCommerce -> Settings. Also make sure the postcode has 8 numeric digits: XXXXXXXX or XXXXX-XXX', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            }
        }
    }

    /**
     * Checks if the current PHP version is supported
     *
     * @return mixed
     */
    private function phpVersionSupported()
    {
        return version_compare(phpversion(), self::MINIMUM_PHP_VERSION, '>=');
    }

    /**
     * Checks if WooCommerce is installed
     *
     * @return bool
     */
    private function wooCommerceInstalled()
    {
        return in_array('woocommerce/woocommerce.php', get_option('active_plugins'));
    }

    /**
     * Checks if WooCommerce version is supported
     *
     * @return bool
     */
    private function wooCommerceVersionSupported()
    {
        global $woocommerce;
        return version_compare($woocommerce->version, self::MINIMUM_WOOCOMMERCE_VERSION, ">=") || defined('CFPP_CEP');
    }

    /**
     * Checks if a valid origin CEP is present
     *
     * @return bool
     */
    private function validOriginCep()
    {
        $cep = Helpers::getOriginCep();
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) === 8;
    }
}
