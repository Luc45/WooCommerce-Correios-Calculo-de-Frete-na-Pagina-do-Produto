<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.lucasbustamante.com.br
 * @since      1.0.0
 *
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/includes
 * @author     Lucas Bustamante <wordpress@lucasbustamante.com.br>
 */
class Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'woocommerce-correios-calculo-de-frete-na-pagina-do-produto',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
