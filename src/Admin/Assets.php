<?php

namespace CFPP\Admin;

class Assets {

    /**
    *   Enqueues CSS for the Administration area
    */
    public function enqueueCss()
    {
        wp_enqueue_style( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-css', $this->base_url . '/assets/css/cfpp_admin.css', array(), filemtime($this->base_path.'/assets/css/cfpp_admin.css'), 'all' );
    }

    /**
    *   Enqueues JavaScript for the Administration area
    */
    public function enqueueJavaScript()
    {
        wp_enqueue_script( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-js', $this->base_url . '/assets/js/cfpp_admin.js', array('jquery'), filemtime($this->base_path.'/assets/js/cfpp_admin.js'), false );
    }

}
