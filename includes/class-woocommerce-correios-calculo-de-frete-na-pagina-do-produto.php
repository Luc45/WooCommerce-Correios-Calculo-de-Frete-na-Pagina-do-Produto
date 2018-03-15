<?php
function d2($a) {
	var_dump($a);exit;
}
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://www.lucasbustamante.com.br
 * @since      1.0.0
 *
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 * @subpackage Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto/includes
 * @author     Lucas Bustamante <wordpress@lucasbustamante.com.br>
 */
class Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	// True se for página de produto
	protected $is_product;

	// Variáveis que são preenchidas com o valor do $_GET ao solicitar o cálculo do frete
	protected $cep_destino;
	protected $produto_altura_final;
	protected $produto_largura_final;
	protected $produto_comprimento_final;
	protected $produto_peso_final;

	// Variáveis que são preenchidas temporariamente na memória durante a visita à página do produto
	protected $height;
	protected $width;
	protected $length;
	protected $weight;

	protected $caminhao_svg = '<?xml version="1.0" encoding="utf-8"?>
		<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 32 24.3" style="enable-background:new 0 0 32 24.3;" xml:space="preserve">
		<g>
			<path d="M31.6,19.2h-1v-5.6c0-0.7-0.2-1.3-0.6-1.8L27.5,8c-0.6-0.9-1.6-1.4-2.7-1.4h-3.9c-0.5,0-0.8,0.4-0.8,0.8v11.8h-6.4
				c0.6,0.5,1,1.3,1.1,2.1h6.7c0.2-1.6,1.6-2.9,3.3-2.9c1.7,0,3.1,1.3,3.3,2.9h3.3c0.2,0,0.4-0.2,0.4-0.4v-1.3
				C32,19.3,31.8,19.2,31.6,19.2z M27.5,12.5h-5.1c-0.2,0-0.4-0.2-0.4-0.4V9.2c0-0.2,0.2-0.4,0.4-0.4h3.1c0.1,0,0.3,0.1,0.3,0.2l2,2.8
				C28,12.1,27.8,12.5,27.5,12.5z M24.9,19.2c-1.4,0-2.6,1.1-2.6,2.6c0,1.4,1.1,2.6,2.6,2.6c1.4,0,2.6-1.1,2.6-2.6
				C27.5,20.3,26.3,19.2,24.9,19.2z M24.9,23c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3
				C26.2,22.4,25.6,23,24.9,23z M3.6,19.2c-0.2,0-0.4,0.2-0.4,0.4v1.3c0,0.2,0.2,0.4,0.4,0.4h4.6c0.1-0.8,0.5-1.6,1.1-2.1L3.6,19.2
				L3.6,19.2z M11.5,19.2c-1.4,0-2.6,1.1-2.6,2.6c0,1.4,1.1,2.6,2.6,2.6c1.4,0,2.6-1.1,2.6-2.6C14.1,20.3,12.9,19.2,11.5,19.2z
				 M11.5,23c-0.7,0-1.3-0.6-1.3-1.3c0-0.7,0.6-1.3,1.3-1.3c0.7,0,1.3,0.6,1.3,1.3C12.8,22.4,12.2,23,11.5,23z M17.7,4h-4.8
				c0.2,0.7,0.4,1.4,0.4,2.2c0,3.9-3.2,7-7,7c-0.7,0-1.4-0.1-2-0.3v4.5c0,0.2,0.2,0.4,0.4,0.4h13.9c0.2,0,0.4-0.2,0.4-0.4V5.2
				C18.9,4.6,18.4,4,17.7,4z M6.2,0C2.8,0,0,2.8,0,6.2s2.8,6.2,6.2,6.2s6.2-2.8,6.2-6.2S9.7,0,6.2,0z M6.2,11c-2.7,0-4.8-2.2-4.8-4.8
				s2.2-4.8,4.8-4.8c2.7,0,4.8,2.2,4.8,4.8C11,8.9,8.9,11,6.2,11z M8.1,7.2c-0.1,0-0.1,0-0.2,0l-2-0.5C5.6,6.6,5.4,6.4,5.4,6.1V3
				c0-0.3,0.3-0.6,0.6-0.6S6.7,2.7,6.7,3v2.6L8.2,6c0.3,0.1,0.5,0.4,0.4,0.8C8.6,7.1,8.3,7.2,8.1,7.2z"/>
		</g>
		</svg>';

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
			$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto';

		$this->check_woocommerce();

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		add_action( 'plugins_loaded', array($this, 'escutar_solicitacoes_de_frete') );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader. Orchestrates the hooks of the plugin.
	 * - Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_i18n. Defines internationalization functionality.
	 * - Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Admin. Defines all hooks for the admin area.
	 * - Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocommerce-correios-calculo-de-frete-na-pagina-do-produto-public.php';

		$this->loader = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {


		$plugin_public = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Verifica se o WooCommerce está devidamente instalado.
	 */
	private function check_woocommerce() {
        // Verifica se o WooCommerce está ativado
        if (!is_plugin_active('woocommerce/woocommerce.php') && is_admin()) {
            wp_die("O plugin WooCommerce deve estar ativo para usar este plugin.");
        }
        // Verifica se o WooCommerce Correios está ativado
        if (!is_plugin_active('woocommerce-correios/woocommerce-correios.php') && is_admin()) {
            wp_die("O plugin WooCommerce Correios deve estar ativo para usar este plugin.");
        }
        $cep_origem = get_option( 'woocommerce_store_postcode' );
		$cep_origem = preg_replace('/[^0-9]/', '', $cep_origem);
		if (strlen($cep_origem) !== 8) {
			wp_die("Antes de usar este plugin, configure o CEP da sua loja em WooCommerce -> Configurações.");
		}
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		add_action( 'woocommerce_before_add_to_cart_button', array($this, 'is_produto_single'));
	}

	/**
	*	Verifica se estamos na página de produto
	*/
	public function is_produto_single() {
		global $product;
		if (is_product()) {
			$this->prepara_produto($product);
			if ($this->verifica_produto()) {
				add_action('woocommerce_before_add_to_cart_button', array($this, 'add_calculo_de_frete'), 11);
				$this->loader->run();
			}
		}
	}

	/**
	 * Listener de $_POSTs para ver se estamos solicitando um cálculo de frete...
	 */
	public function escutar_solicitacoes_de_frete() {
		// Verifica se estamos solicitando um cálculo de frete...
		if (
			isset($_POST['cep_origem']) && !empty($_POST['cep_origem'])
			&&
			isset($_POST['produto_altura']) && !empty($_POST['produto_altura'])
			&&
			isset($_POST['produto_largura']) && !empty($_POST['produto_largura'])
			&&
			isset($_POST['produto_comprimento']) && !empty($_POST['produto_comprimento'])
			&&
			isset($_POST['produto_peso']) && !empty($_POST['produto_peso'])
			&&
			isset($_POST['solicita_calculo_frete']) && wp_verify_nonce($_POST['solicita_calculo_frete'], 'solicita_calculo_frete')
		) {
			$this->prepara_calculo_de_frete($_POST['cep_origem'], $_POST['produto_altura'], $_POST['produto_largura'], $_POST['produto_comprimento'], $_POST['produto_peso']);
		}
	}

	/**
	 * Salva os dados do produto na memória
	 */
	public function prepara_produto($product) {
	    $this->product = $product;
	    $this->height = $product->get_height();
	    $this->width = $product->get_width();
	    $this->length = $product->get_length();
	    $this->weight = $product->get_weight();
	    $this->id = $product->get_id();
	}

	/**
	 * Verifica se o produto têm os dados necessários para cálculo de frete
	 */
	public function verifica_produto() {
	    return is_numeric($this->height) && is_numeric($this->width) && is_numeric($this->length) && is_numeric($this->weight);
	}

	/**
	* Adiciona o HTML do cálculo de frete na página do produto
	*/
	public function add_calculo_de_frete() {
		?>
			<div id="woocommerce-correios-calculo-de-frete-na-pagina-do-produto">
				<?php wp_nonce_field('solicita_calculo_frete', 'solicita_calculo_frete'); ?>
				<input type="hidden" id="calculo_frete_endpoint_url" value="<?php echo get_site_url();?>">
				<input type="hidden" id="calculo_frete_produto_altura" value="<?php echo $this->height;?>">
				<input type="hidden" id="calculo_frete_produto_largura" value="<?php echo $this->width;?>">
				<input type="hidden" id="calculo_frete_produto_comprimento" value="<?php echo $this->length;?>">
				<input type="hidden" id="calculo_frete_produto_peso" value="<?php echo $this->weight;?>">
				<input type="hidden" id="id_produto" value="<?php echo $this->id;?>">
				<div class="calculo-de-frete">
					<input type="text" maxlength="9" onkeyup="return mascara(this, '#####-###');">
					<div id="calcular-frete"><?php echo $this->caminhao_svg;?> Calcular Frete</div>
					<div id="calcular-frete-loader"></div>
				</div>
				<div class="resultado-frete">
					<table>
						<thead>
							<tr>
								<td>Forma de envio</td>
								<td>Custo estimado</td>
								<td>Entrega estimada</td>
							</tr>
						</thead>
						<tbody>
							<tr data-formaenvio="pac">
								<td>PAC</td>
								<td>R$ <span data-custo></span></td>
								<td>Em até <span data-entrega></span> dias</td>
							</tr>
							<tr data-formaenvio="sedex">
								<td>SEDEX</td>
								<td>R$ <span data-custo></span></td>
								<td>Em até <span data-entrega></span> dias</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		<?php
	}

	/**
	 * Retorna um JSON com os preços do frete
	 */
	public function prepara_calculo_de_frete($cep_destino, $altura, $largura, $comprimento, $peso) {
		$erro = false;
		$cep = preg_replace('/[^0-9]/', '', $cep_destino);
		if (strlen($cep) !== 8) {
			$erro = true;
			$result['status'] = 'erro';
			$result['mensagem'] = 'Por favor, informe um CEP válido.';
			$this->retornar_json($result);
		}
		if (!is_numeric($altura) || !is_numeric($largura) || !is_numeric($comprimento) || !is_numeric($peso)) {
			$erro = true;
			$result['status'] = 'erro';
			$result['mensagem'] = 'Por favor, informe dimensões válidas.';
			$this->retornar_json($result);
		}
		if (!$erro) {
			// Temos dados válidos
			$this->cep_destino = $cep_destino;
			$this->produto_altura_final = $altura;
			$this->produto_largura_final = $largura;
			$this->produto_comprimento_final = $comprimento;
			$this->produto_peso_final = $peso;
			$this->id_produto = $id_produto;
			add_action('plugins_loaded', array($this, 'calcula_frete'), 15);
		}
	}

	/**
	 * Retorna o JSON
	 */
	protected function retornar_json(array $output) {
		header("Content-type: application/json");
		die(json_encode($output, JSON_UNESCAPED_UNICODE));
	}

	/**
	 * Envia os dados para a API do WC_Correios e retorna o JSON
	 */
	public function calcula_frete() {
		$output = array();
		if ( class_exists('WC_Correios') ) {
			// Carrega o WC_Correios
			$correios = new WC_Correios;
			$correios->init();

			// Pega os valores propriamente dito
			$pac = (array) $this->get_valor_frete_wc_correios('04510'); // PAC
			$sedex = (array) $this->get_valor_frete_wc_correios('04014'); // SEDEX

			// Faz algumas verificações de segurança pra garantir que está tudo certo
			$pac = $this->verifica_retorno_wc_correios($pac);
			$sedex = $this->verifica_retorno_wc_correios($sedex);

			// Preenche o Output
			$output['pac'] = $pac;
			$output['sedex'] = $sedex;
		}
		$this->retornar_json($output);
	}


	/**
	 * Envia os dados para a API do WC_Correios e retorna o valor do frete
	 */
	protected function get_valor_frete_wc_correios($code) {
		$correiosWebService = new WC_Correios_Webservice;

		$correiosWebService->set_height($this->produto_altura_final);
		$correiosWebService->set_width($this->produto_largura_final);
		$correiosWebService->set_length($this->produto_comprimento_final);
		$correiosWebService->set_weight($this->produto_peso_final);
		$correiosWebService->set_destination_postcode($this->cep_destino);
		$correiosWebService->set_origin_postcode(get_option( 'woocommerce_store_postcode' ));
		$correiosWebService->set_service($code);
		return $correiosWebService->get_shipping();
	}
	/**
	 * Verifica se o retorno do WC_Correios é válido
	 */
	public function verifica_retorno_wc_correios($array) {
	    if (!is_array($array)) {
	    	return array('status' => 'erro', 'mensagem' => 'Erro desconhecido');
	    }
	    if (!array_key_exists('Valor', $array) || !array_key_exists('PrazoEntrega', $array)) {
	    	return array('status' => 'erro', 'mensagem' => 'Erro desconhecido.');
	    }
	    return $array;
	}

}
