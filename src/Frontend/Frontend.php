<?php

namespace CFPP\Frontend;

use CFPP\Frontend\Assets,
    CFPP\Frontend\Ajax;

class Frontend {

    /**
    *   Runs when in admin and CFPP is active
    */
    public function run()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueAssets') );

        // Listens for AJAX calls on the front-end
        $ajax = new Ajax;
        $ajax->listen();
    }

    /**
    *   Enqueues Frontend CSS and Javascript
    */
    public function enqueueAssets()
    {
        $frontEndAssets =  new Assets;
        $this->frontEndAssets->enqueueCss();
        $this->frontEndAssets->enqueueJavaScript();
    }

}
