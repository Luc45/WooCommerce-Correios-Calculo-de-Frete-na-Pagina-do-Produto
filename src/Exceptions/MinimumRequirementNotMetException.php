<?php

namespace CFPP\Exceptions;

/**
 * Class MinimumRequirementNotMetException
 * @package CFPP\Exceptions
 */
class MinimumRequirementNotMetException extends \Exception
{
    /**
     * Called when PHP version is bellow minimum required
     *
     * @param $minimum_php_version
     * @return MinimumRequirementNotMetException
     */
    public static function php_version_not_supported($minimum_php_version)
    {
        return new self(sprintf(
                /* translators: %s: Minimum PHP version number */
                __('Minimum PHP version required: %s', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                $minimum_php_version
            ));
    }

    /**
     * Called when WooCommerce plugin is not active
     *
     * @return MinimumRequirementNotMetException
     */
    public static function woocommerce_not_active()
    {
        return new self(__('WooCommerce plugin must be active to use this plugin.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
    }

    /**
     * Called when WooCommerce version is not supported without CFPP_CEP constant
     *
     * @param $minimum_woocommerce_version
     * @return MinimumRequirementNotMetException
     */
    public static function woocommerce_version_not_supported($minimum_woocommerce_version)
    {
        return new self(sprintf(
                /* translators: %s: Minimum WooCommerce version number */
                __('CFPP requires WooCommerce %s or higher. Optionally, you can add this code to your wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (add it right under WP_DEBUG)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                $minimum_woocommerce_version
            ));
    }

    /**
     * Called when origin postcode is invalid
     *
     * @return MinimumRequirementNotMetException
     */
    public static function invalid_origin_postcode()
    {
        if (defined('CFPP_CEP')) {
            $string = __('Constant CFPP_CEP is in an invalid format, please fill it in this exact format: XXXXX-XXX, replacing X by the number of your postcode.', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        } else {
            $string = __('Before using this plugin, please configure your store postcode in WooCommerce -> Settings. Also make sure the postcode has 8 numeric digits: XXXXXXXX or XXXXX-XXX', 'woo-correios-calculo-de-frete-na-pagina-do-produto');
        }
        return new self($string);
    }

    /**
     * Called when WordPress version is bellow minimum required
     *
     * @param $minimum_wordpress_version
     * @return MinimumRequirementNotMetException
     */
    public static function wordpress_version_not_supported($minimum_wordpress_version)
    {
        return new self(sprintf(
        /* translators: %s: Minimum WooCommerce version number */
            __('CFPP requires WordPress %s or higher.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
            $minimum_wordpress_version
        ));
    }
}