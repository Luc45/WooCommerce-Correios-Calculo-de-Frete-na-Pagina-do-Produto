<?php
/**
 * Plugin Name: WooCommerce Correios - Cálculo de Frete na Página do Produto (CFPP)
 * Description: Habilita o cálculo de frete na página do produto.
 * Version:     3.0.0
 * Author:     Lucas Bustamante
 * Author URI: http://www.lucasbustamante.com.br
 * License: GPL 2.0
 */

namespace CFPP;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

// Composer Autoloader
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// Helper Constants
define('CFPP_BASE_PATH', __DIR__);
define('CFPP_BASE_URL', plugin_dir_url( __FILE__ ));

/**
 * Bootstrap the plugin
 */
function run_cfpp_plugin() {
    $cfpp = new Core();
    $cfpp->run();
}
run_cfpp_plugin();
