<?php
/**
 * Plugin Name: WooCommerce Correios - Cálculo de Frete na Página do Produto
 * Description: Habilita o cálculo de frete na página do produto.
 * Version:     2.3.3
 * Author:     Lucas Bustamante
 * Author URI: http://www.lucasbustamante.com.br
 * License: GPL 2.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Carrega o Bootstrap.php, que contém o autoloader e funções auxiliares
 */
require_once('Bootstrap.php');

/**
 * Inicia a execução do plugin
 */
function run_woocommerce_correios_calculo_de_frete_na_pagina_do_produto() {
    $plugin = new Woocommerce_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto();
    $plugin->run();
}
run_woocommerce_correios_calculo_de_frete_na_pagina_do_produto();
