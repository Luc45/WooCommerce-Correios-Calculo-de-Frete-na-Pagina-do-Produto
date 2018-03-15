<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.lucasbustamante.com.br
 * @since      1.0.0
 *
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/public
 * @author     Lucas Bustamante <wordpress@lucasbustamante.com.br>
 */
class Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Carrega CSS e Javascript do tema
		$this->enqueue_styles();
		$this->enqueue_scripts();

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocommerce-correios-calculo-de-frete-na-pagina-do-produto-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocommerce-correios-calculo-de-frete-na-pagina-do-produto-public.js', array( 'jquery' ), $this->version, false );

	}

}
