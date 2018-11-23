<?php

namespace CFPP\Frontend;

class Frontend
{
    /**
    *   Runs when in Front-end and CFPP is active
    */
    public function run()
    {
        $this->enqueueAssets();

        // Gives a chance to change where the HTML should be displayed
        $hook = apply_filters('cfpp_hook_location', 'woocommerce_before_add_to_cart_button');

        // Displays the HTML for the plugin in the product page
        add_action($hook, function() {
            Template::showCFPPInProductPage();
        });
    }

    /**
     * Enqueue assets in product page only
     */
    private function enqueueAssets()
    {
        add_action('wp_enqueue_scripts', function () {
            if (is_product()) {
                $frontEndAssets = new Assets;
                $frontEndAssets->enqueueCss();
                $frontEndAssets->enqueueJavaScript();
            }
        });
    }
}
