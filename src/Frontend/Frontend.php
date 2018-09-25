<?php

namespace CFPP\Frontend;

use CFPP\Frontend\Assets,
    CFPP\Frontend\Product;

class Frontend {

    /**
    *   Runs when in Front-end and CFPP is active
    */
    public function run()
    {
        add_action( 'wp_enqueue_scripts', array($this, 'enqueueAssets') );

        // Displays the HTML for the plugin in the product page
        $product = new Product;
        add_action( 'woocommerce_before_add_to_cart_button', array($product, 'displayCFPPInProductPage'));
    }

    /**
    *   Enqueues Frontend CSS and Javascript
    */
    public function enqueueAssets()
    {
        $frontEndAssets =  new Assets;
        $frontEndAssets->enqueueCss();
        $frontEndAssets->enqueueJavaScript();
    }

}
