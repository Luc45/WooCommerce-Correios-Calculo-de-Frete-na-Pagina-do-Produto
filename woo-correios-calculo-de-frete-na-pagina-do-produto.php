<?php
/**
 * Plugin Name:          WooCommerce Correios - Cálculo de Frete na Página do Produto (CFPP)
 * Plugin URI:           https://github.com/Luc45/WooCommerce-Correios-Calculo-de-Frete-na-Pagina-do-Produto
 * Description:          Habilita o cálculo de frete na página do produto.
 * Version:              3.1.8
 * Author:               Lucas Bustamante
 * Author URI:           https://www.lucasbustamante.com.br
 * Text Domain:          woo-correios-calculo-de-frete-na-pagina-do-produto
 * Domain Path:          /languages
 * License:              GPL 2.0
 * Requires at least:    4.4
 * Tested up to:         5.3.2
 * Requires PHP:         5.4
 * WC requires at least: 3.2
 * WC tested up to:      3.9
 */

namespace CFPP;

use CFPP\Exceptions\MinimumRequirementNotMetException;

/** If this file is called directly, abort. */
defined('ABSPATH') || die();

/** Composer Autoloader */
require_once plugin_dir_path(__FILE__) . 'vendor/autoload.php';

/** Constants we will use later on */
define('CFPP_BASE_PATH', __DIR__);
define('CFPP_BASE_URL', plugin_dir_url(__FILE__));

/** Register REST routes */
add_action('rest_api_init', [new Rest, 'registerRoutes']);

/**
 * Hook plugin initialization at plugins_loaded, since we use
 * WooCommerce and WooCommerce Correios functions
 */
add_action('plugins_loaded', function() {
    try {
    	// i18n
	    load_plugin_textdomain('woo-correios-calculo-de-frete-na-pagina-do-produto', FALSE, basename(dirname(__FILE__)) . '/languages');

        // Check requirements
        $requirements = new Requirements;
        $requirements->checkMinimumRequirements();

        // Enqueue assets and show CFPP on product page
        $frontend = new Frontend;
        $frontend->run();
    } catch (MinimumRequirementNotMetException $e) {
        Notifications::getInstance()->fatal($e->getMessage());
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        deactivate_plugins( __FILE__ );
    }
}, 25);

