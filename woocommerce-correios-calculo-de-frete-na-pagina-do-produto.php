<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.lucasbustamante.com.br
 * @since             1.0.0
 * @package           Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Correios - Cálculo de Frete na Página do Produto
 * Plugin URI:        http://www.lucasbustamante.com.br
 * Description:       Habilita o cálculo de frete na página do produto.
 * Version:           1.0.0
 * Author:            Lucas Bustamante
 * Author URI:        http://www.lucasbustamante.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocommerce-correios-calculo-de-frete-na-pagina-do-produto
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-activator.php
 */
function activate_woocommerce_correios_calculo_de_frete_na_pagina_do_produto() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-activator.php';
	Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-deactivator.php
 */
function deactivate_woocommerce_correios_calculo_de_frete_na_pagina_do_produto() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-deactivator.php';
	Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woocommerce_correios_calculo_de_frete_na_pagina_do_produto' );
register_deactivation_hook( __FILE__, 'deactivate_woocommerce_correios_calculo_de_frete_na_pagina_do_produto' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocommerce_correios_calculo_de_frete_na_pagina_do_produto() {

	$plugin = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto();
	$plugin->run();

}
run_woocommerce_correios_calculo_de_frete_na_pagina_do_produto();
