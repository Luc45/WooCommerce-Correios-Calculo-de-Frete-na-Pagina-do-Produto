<?php
/**
 * Plugin Name:          WooCommerce Correios - Cálculo de Frete na Página do Produto (CFPP)
 * Plugin URI:           https://github.com/Luc45/WooCommerce-Correios-Calculo-de-Frete-na-Pagina-do-Produto
 * Description:          Habilita o cálculo de frete na página do produto.
 * Version:              3.0.5
 * Author:               Lucas Bustamante
 * Author URI:           https://www.lucasbustamante.com.br
 * Text Domain:          woo-correios-calculo-de-frete-na-pagina-do-produto
 * Domain Path:          /languages
 * License:              GPL 2.0
 * WC requires at least: 3.0.0
 * WC tested up to:      3.5.1
 */

namespace CFPP;

// If this file is called directly, abort.
defined('ABSPATH') || die();

/**
 * Bootstrap the plugin
 */
function run_cfpp_plugin()
{
    // Composer Autoloader
    require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

    // Constants we will use later on
    define('CFPP_BASE_PATH', __DIR__);
    define('CFPP_BASE_URL', plugin_dir_url(__FILE__));
    define('CFPP_BASE_PLUGIN_FILE', __FILE__);

    // i18n
    add_action('plugins_loaded', function() {
        load_plugin_textdomain('woo-correios-calculo-de-frete-na-pagina-do-produto', FALSE, basename(dirname(__FILE__)) . '/languages');
    }, 9);

    // Yahoooo!
    $cfpp = new Bootstrap();
    $cfpp->run();
}
run_cfpp_plugin();
