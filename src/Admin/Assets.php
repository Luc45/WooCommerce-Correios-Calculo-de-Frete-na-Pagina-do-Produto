<?php

namespace CFPP\Admin;

class Assets {

    /**
    *   Enqueues CSS for the Administration area
    */
    public function enqueueCss()
    {
        wp_enqueue_style( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-css', CFPP_BASE_URL . '/assets/css/cfpp_admin.css', array(), filemtime(CFPP_BASE_PATH.'/assets/css/cfpp_admin.css'), 'all' );
    }

    /**
    *   Enqueues JavaScript for the Administration area
    */
    public function enqueueJavaScript()
    {
        wp_enqueue_script( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-js', CFPP_BASE_URL . '/assets/js/cfpp_admin.js', array('jquery'), filemtime(CFPP_BASE_PATH.'/assets/js/cfpp_admin.js'), false );
    }

}
