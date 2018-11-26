<?php

namespace CFPP\Common;

class Frontend
{
    /**
    *   Runs when in Front-end and CFPP is active
    */
    public function run()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueueAssets'));

        // Gives a chance to change where the HTML should be displayed
        $hook = apply_filters('cfpp_hook_location', 'woocommerce_before_add_to_cart_button');

        // Displays the HTML for the plugin in the product page
        add_action($hook, array($this, 'showCFPPInProductPage'));
    }

    /**
     * Enqueue assets in product page only
     */
    public function enqueueAssets()
    {
        if (is_product()) {
            // CSS
            wp_enqueue_style('cfpp-css', CFPP_BASE_URL . 'assets/css/cfpp.css', array(), filemtime(CFPP_BASE_PATH.'/assets/css/cfpp.css'), 'all');

            // JS
            wp_enqueue_script('cfpp-sanitize-title', CFPP_BASE_URL . 'assets/js/wp-fe-sanitize-title.js', array(), filemtime(CFPP_BASE_PATH.'/assets/js/wp-fe-sanitize-title.js'), false);
            wp_enqueue_script('cfpp-vanilla-masker', CFPP_BASE_URL . 'assets/js/vanilla-masker.min.js', array(), filemtime(CFPP_BASE_PATH.'/assets/js/vanilla-masker.min.js'), false);
            wp_enqueue_script('cfpp-js', CFPP_BASE_URL . 'assets/js/cfpp.js', array('jquery', 'cfpp-vanilla-masker', 'cfpp-sanitize-title'), filemtime(CFPP_BASE_PATH.'/assets/js/cfpp.js'), false);
        }
    }

    /**
     * Returns a SVG content
     *
     * @param $svg
     * @return bool|string
     */
    public function getSvg($svg)
    {
        $file = CFPP_BASE_PATH . '/assets/img/'.$svg.'.svg';
        if (file_exists($file)) {
            return file_get_contents($file);
        }
    }

    /**
     *   Displays the HTML for the plugin in the product page
     */
    public function showCFPPInProductPage()
    {
        if (is_product()) {
            global $product;

            if (is_subclass_of($product, 'WC_Product')) {
                if ($product->is_virtual()) {
                    return;
                }

                $cfpp_data = array(
                    'cfpp_product_id' => $product->get_id(),
                    'cfpp_default_display' => $product->is_type('variable') ? 'none' : 'block',
                    'cfpp_options' => array(
                        'text' => '#FFF',
                        'button' => '#03A9F4'
                    ),
                    'cfpp_truck_svg' => $this->getSvg('truck')
                );

                $cfpp_data = apply_filters('cfpp_product_page_data', $cfpp_data);

                extract($cfpp_data);

                include_once(CFPP_BASE_PATH . '/views/product-page-cfpp.php');
            }
        }
    }
}
