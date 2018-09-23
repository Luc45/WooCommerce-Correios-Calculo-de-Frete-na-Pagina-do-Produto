<?php

namespace CFPP;

use CFPP\Notifications;
use CFPP\Cep;

class Requirements {

    private $notifications;

    public function __construct()
    {
        $this->notifications = new Notifications;
    }

    /**
     * Checks if the current PHP version is supported
     */
    public function phpVersionSupported()
    {
        if (version_compare(phpversion(), '5.3.0', '<')){
            $this->notifications->fatal('Versão mínima do PHP necessária: 5.3.0');
            return false;
        }
        return true;
    }

    /**
     * Checks if WooCommerce is installed
     */
    public function wooCommerceInstalled()
    {
        if (!is_plugin_active(WP_PLUGIN_DIR.'/woocommerce/woocommerce.php')) {
            $this->notifications->fatal('O plugin WooCommerce deve estar ativo para usar este plugin.');
            return false;
        }
        return true;
    }

    /**
     *  Checks if WooCommerce version is supported
     */
    public function wooCommerceVersionSupported()
    {
        if ( class_exists( 'WooCommerce' ) ) {
            global $woocommerce;
            if ( !version_compare( $woocommerce->version, '3.2.0', ">=" ) ) {
                if (!defined('CFPP_CEP')) {
                    $this->notifications->fatal('O plugin Cálculo de Frete na Página requer WooCommerce 3.2.0 ou superior. Como você está usando uma versão inferior, é necessário adicionar este código no seu wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (coloque logo abaixo do WP_DEBUG)');
                    return false;
                }
            }
            return true;
        }
    }

    /**
     *  Checks if a valid CEP is present
     */
    public function validCep()
    {
        $cep_class = new Cep;
        $cep_number = $cep_class->getGep();

        if (!$cep_class->isValid($cep_number)) {
            if (defined('CFPP_CEP')) {
                $this->notifications->fatal('A constante CFPP_CEP está num formato inválido, por favor preencha exatamente neste formato: XXXXX-XXX, substituindo os X pelo número do seu CEP.');
            } else {
                $this->notifications->fatal('Antes de usar este plugin, configure o CEP da sua loja em WooCommerce -> Configurações. Verifique também que o cep informado tenha 8 dígitos numéricos: XXXXXXXX ou XXXXX-XXX');
            }
            return false;
        }

        return true;
    }

}
