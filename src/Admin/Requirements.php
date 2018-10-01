<?php

namespace CFPP\Admin;

use CFPP\Admin\Notifications;
use CFPP\Common\Cep;
use CFPP\Common\Validate;

class Requirements
{

    /**
     * Checks if the current PHP version is supported
     */
    public function phpVersionSupported()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            Notifications::getInstance()->fatal(__('Versão mínima do PHP necessária: 5.4.0', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            return false;
        }
        return true;
    }

    /**
     * Checks if WooCommerce is installed
     */
    public function wooCommerceInstalled()
    {
        if (in_array('woocommerce/woocommerce.php', get_option('active_plugins'))) {
            return true;
        } else {
            Notifications::getInstance()->fatal(__('O plugin WooCommerce deve estar ativo para usar este plugin.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            return false;
        }
    }

    /**
     *  Checks if WooCommerce version is supported
     */
    public function wooCommerceVersionSupported()
    {
        global $woocommerce;
        if (version_compare($woocommerce->version, '3.2.0', ">=") || defined('CFPP_CEP')) {
            return true;
        } else {
            Notifications::getInstance()->fatal(__('O plugin Cálculo de Frete na Página requer WooCommerce 3.2.0 ou superior. Como você está usando uma versão inferior, é necessário adicionar este código no seu wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (coloque logo abaixo do WP_DEBUG)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            return false;
        }
    }

    /**
     * Checks if WooCommerce Correios is installed
     */
    public function wooCommerceCorreiosInstalled()
    {
        if (in_array('woocommerce-correios/woocommerce-correios.php', get_option('active_plugins'))) {
            return true;
        } else {
            Notifications::getInstance()->fatal(__('O plugin WooCommerce Correios deve estar ativo para usar este plugin.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            return false;
        }
    }

    /**
     *  Checks if a valid origin CEP is present
     */
    public function validOriginCep()
    {
        if (!Validate::cep(Cep::getOriginCep())) {
            if (defined('CFPP_CEP')) {
                Notifications::getInstance()->fatal(__('A constante CFPP_CEP está num formato inválido, por favor preencha exatamente neste formato: XXXXX-XXX, substituindo os X pelo número do seu CEP.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            } else {
                Notifications::getInstance()->fatal(__('Antes de usar este plugin, configure o CEP da sua loja em WooCommerce -> Configurações. Verifique também que o cep informado tenha 8 dígitos numéricos: XXXXXXXX ou XXXXX-XXX', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            }
            return false;
        }

        return true;
    }
}
