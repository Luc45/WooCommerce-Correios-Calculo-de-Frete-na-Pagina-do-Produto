<?php

define('WOO_CORREIOS_CALCULO_CEP_BASE_PATH', __DIR__);
define('WOO_CORREIOS_CALCULO_CEP_BASE_URL', plugin_dir_url( __FILE__ ));

/**
 * Autoloader de classes
 */
spl_autoload_register('CalculoFretePaginaProdutoAutoLoader');
function CalculoFretePaginaProdutoAutoLoader($className) {
    if (file_exists(__DIR__.'/src/'.$className.'.php')) {
        require_once __DIR__.'/src/'.$className.'.php';
    }
}