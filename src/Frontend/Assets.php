<?php

namespace CFPP\Frontend;

class Assets {

    /**
    *   Enqueues CSS for the front-end
    */
    public function enqueueCss()
    {
        wp_enqueue_style( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-css', $this->base_url . '/assets/css/cfpp.css', array(), filemtime($this->base_path.'/assets/css/cfpp.css'), 'all' );
    }

    /**
    *   Enqueues JavaScript for the front-end
    */
    public function enqueueJavaScript()
    {
        wp_enqueue_script( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-js', $this->base_url . '/assets/js/cfpp.js', array('jquery'), filemtime($this->base_path.'/assets/js/cfpp.js'), false );
    }

}
