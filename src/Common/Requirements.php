<?php

namespace CFPP\Common;

class Requirements
{
    CONST MINIMUM_PHP_VERSION = '5.4.0';
    CONST MINIMUM_WOOCOMMERCE_VERSION = '3.2.0';

    public function checkMinimumRequirements()
    {
        if (!$this->phpVersionSupported()) {
            throw new \Exception('Versão mínima do PHP necessária: ' . self::MINIMUM_PHP_VERSION);
        }

        if (!$this->wooCommerceInstalled()) {
            throw new \Exception('O plugin WooCommerce deve estar ativo para usar este plugin.');
        }

        if (!$this->wooCommerceVersionSupported()) {
            throw new \Exception('O plugin Cálculo de Frete na Página requer WooCommerce ' . self::MINIMUM_WOOCOMMERCE_VERSION . ' ou superior. Como você está usando uma versão inferior, é necessário adicionar este código no seu wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (coloque logo abaixo do WP_DEBUG)');
        }

        if (!$this->validOriginCep()) {
            if (defined('CFPP_CEP')) {
                throw new \Exception('A constante CFPP_CEP está num formato inválido, por favor preencha exatamente neste formato: XXXXX-XXX, substituindo os X pelo número do seu CEP.');
            } else {
                throw new \Exception('Antes de usar este plugin, configure o CEP da sua loja em WooCommerce -> Configurações. Verifique também que o cep informado tenha 8 dígitos numéricos: XXXXXXXX ou XXXXX-XXX');
            }
        }

        return true;
    }

    /**
     * Checks if the current PHP version is supported
     */
    private function phpVersionSupported()
    {
        return version_compare(phpversion(), self::MINIMUM_PHP_VERSION, '>=');
    }

    /**
     * Checks if WooCommerce is installed
     */
    private function wooCommerceInstalled()
    {
        return in_array('woocommerce/woocommerce.php', get_option('active_plugins'));
    }

    /**
     *  Checks if WooCommerce version is supported
     */
    private function wooCommerceVersionSupported()
    {
        global $woocommerce;
        return version_compare($woocommerce->version, self::MINIMUM_WOOCOMMERCE_VERSION, ">=") || defined('CFPP_CEP');
    }

    /**
     *  Checks if a valid origin CEP is present
     */
    private function validOriginCep()
    {
        $cep = Helpers::getOriginCep();
        $cep = preg_replace('/[^0-9]/', '', $cep);
        return strlen($cep) === 8;
    }
}
