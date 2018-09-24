<?php
/**
 * PHPUnit bootstrap file
 *
 * @package Woo_Correios_Calculo_De_Frete_Na_Pagina_Do_Produto
 */

$_tests_dir = getenv( 'WP_TESTS_DIR' );

if ( ! $_tests_dir ) {
	$_tests_dir = rtrim( sys_get_temp_dir(), '/\\' ) . '/wordpress-tests-lib';
}

if ( ! file_exists( $_tests_dir . '/includes/functions.php' ) ) {
	echo "Could not find $_tests_dir/includes/functions.php, have you run bin/install-wp-tests.sh ?" . PHP_EOL; // WPCS: XSS ok.
	exit( 1 );
}

// Give access to tests_add_filter() function.
require_once $_tests_dir . '/includes/functions.php';

/**
 * Manually load the plugin being tested.
 */
function _manually_load_plugin() {
    // Update array with plugins to include ...
    $plugins_to_active = [
        'woocommerce/woocommerce.php'
    ];
    update_option( 'active_plugins', $plugins_to_active );

	require dirname( dirname( __FILE__ ) ) . '/woo-correios-calculo-de-frete-na-pagina-do-produto.php';
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

// Start up the WP testing environment.
require $_tests_dir . '/includes/bootstrap.php';
