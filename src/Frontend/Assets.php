<?php

namespace CFPP\Frontend;

class Assets {

    /**
    *   Enqueues CSS for the front-end
    */
    public function enqueueCss()
    {
        wp_enqueue_style( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-css', CFPP_BASE_URL . '/assets/css/cfpp.css', array(), filemtime(CFPP_BASE_PATH.'/assets/css/cfpp.css'), 'all' );
    }

    /**
    *   Enqueues JavaScript for the front-end
    */
    public function enqueueJavaScript()
    {
        wp_enqueue_script( 'woocommerce-correios-calculo-de-frete-na-pagina-do-produto-js', CFPP_BASE_URL . '/assets/js/cfpp.js', array('jquery'), filemtime(CFPP_BASE_PATH.'/assets/js/cfpp.js'), false );
    }

    /**
    *   Returns a SVG content
    */
    public static function getSvg($svg) {
        $file = CFPP_BASE_PATH.'/assets/img/'.$svg.'.svg';
        if (file_exists($file))
            return file_get_contents($file);
    }

}
