<?php

namespace CFPP\Frontend;

use CFPP\Frontend\Assets;
use CFPP\Frontend\Product;

class Frontend
{

    /**
    *   Runs when in Front-end and CFPP is active
    */
    public function run()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueueAssets'));

        // Let's give the user the chance where the HTML should be displayed
        $where = apply_filters('cfpp_hook_location', 'woocommerce_before_add_to_cart_button');

        // Displays the HTML for the plugin in the product page
        $product = new Product;
        add_action($where, array($product, 'displayCFPPInProductPage'));
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
