<?php

namespace CFPP\Admin;

use CFPP\Admin\Notifications;
use CFPP\Common\Cep;

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
            $this->notifications->fatal(__('Versão mínima do PHP necessária: 5.3.0', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
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
            $this->notifications->fatal(__('O plugin WooCommerce deve estar ativo para usar este plugin.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
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
                    $this->notifications->fatal(__('O plugin Cálculo de Frete na Página requer WooCommerce 3.2.0 ou superior. Como você está usando uma versão inferior, é necessário adicionar este código no seu wp-config.php: <strong>define("CFPP_CEP", "XXXXX-XXX");</strong> (coloque logo abaixo do WP_DEBUG)', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
                    return false;
                }
            }
            return true;
        }
    }

    /**
     *  Checks if a valid origin CEP is present
     */
    public function validOriginCep()
    {
        $cep_class = new Cep;
        $cep_number = $cep_class->getOriginCep();

        if (!$cep_class->isValid($cep_number)) {
            if (defined('CFPP_CEP')) {
                $this->notifications->fatal(__('A constante CFPP_CEP está num formato inválido, por favor preencha exatamente neste formato: XXXXX-XXX, substituindo os X pelo número do seu CEP.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            } else {
                $this->notifications->fatal(__('Antes de usar este plugin, configure o CEP da sua loja em WooCommerce -> Configurações. Verifique também que o cep informado tenha 8 dígitos numéricos: XXXXXXXX ou XXXXX-XXX', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            }
            return false;
        }

        return true;
    }

}
