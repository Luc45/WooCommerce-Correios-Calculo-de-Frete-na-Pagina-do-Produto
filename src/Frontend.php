<?php

namespace CFPP;

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
            global $post;
            // CSS
            wp_enqueue_style('cfpp-css', CFPP_BASE_URL . 'assets/css/cfpp.css', array(), filemtime(CFPP_BASE_PATH.'/assets/css/cfpp.css'), 'all');

            // JS
            wp_enqueue_script('cfpp-sanitize-title', CFPP_BASE_URL . 'assets/js/wp-fe-sanitize-title.js', array(), filemtime(CFPP_BASE_PATH.'/assets/js/wp-fe-sanitize-title.js'));
            wp_enqueue_script('cfpp-vanilla-masker', CFPP_BASE_URL . 'assets/js/vanilla-masker.min.js', array(), filemtime(CFPP_BASE_PATH.'/assets/js/vanilla-masker.min.js'));

            wp_register_script('cfpp-js', CFPP_BASE_URL . 'assets/js/cfpp.js', array('jquery', 'cfpp-vanilla-masker', 'cfpp-sanitize-title'), filemtime(CFPP_BASE_PATH.'/assets/js/cfpp.js'));
            wp_localize_script('cfpp-js', 'cfppData', [
                'rest' => [
                    'endpoint' => esc_url_raw(rest_url('/cfpp/v1/calculate')),
                    'nonce' => wp_create_nonce('wp_rest'),
                    'timeout' => apply_filters('cfpp_rest_timeout', 10000),
                ],
                'product_id' => $post->ID,
                'i18n' => [
                    'invalid_postcode' => __('Please, check if postcode is valid.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    'shipping_method_not_shown' => __('One or more shipping methods were not shown. Only administrators can see this message.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    'shipping_costs_not_available' => __('Sorry, the shipping costs are only available in the cart right now. Please proceed with your purchase normally.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                    'postcode_mask' => __('99999-999', 'woo-correios-calculo-de-frete-na-pagina-do-produto'),
                ]
            ]);
            wp_enqueue_script('cfpp-js');
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
     * Displays the HTML for the plugin in the product page
     */
    public function showCFPPInProductPage()
    {
        global $product;
        if ($product instanceof \WC_Product && $product->is_virtual() === false) {
            $cfpp_data = array(
                'cfpp_default_display' => $product->is_type('variable') ? 'none' : 'block',
                'cfpp_options' => array(
                    'text' => '#FFF',
                    'button' => '#03A9F4'
                ),
                // This is not escaped on the frontend to allow color to be changed with "fill" CSS attribute.
                'cfpp_icon_svg' => '<svg enable-background="new 0 0 32 24.3" version="1.1" viewBox="0 0 32 24.3" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">    <path d="m31.6 19.2h-1v-5.6c0-0.7-0.2-1.3-0.6-1.8l-2.5-3.8c-0.6-0.9-1.6-1.4-2.7-1.4h-3.9c-0.5 0-0.8 0.4-0.8 0.8v11.8h-6.4c0.6 0.5 1 1.3 1.1 2.1h6.7c0.2-1.6 1.6-2.9 3.3-2.9s3.1 1.3 3.3 2.9h3.3c0.2 0 0.4-0.2 0.4-0.4v-1.3c0.2-0.3 0-0.4-0.2-0.4zm-4.1-6.7h-5.1c-0.2 0-0.4-0.2-0.4-0.4v-2.9c0-0.2 0.2-0.4 0.4-0.4h3.1c0.1 0 0.3 0.1 0.3 0.2l2 2.8c0.2 0.3 0 0.7-0.3 0.7zm-2.6 6.7c-1.4 0-2.6 1.1-2.6 2.6 0 1.4 1.1 2.6 2.6 2.6 1.4 0 2.6-1.1 2.6-2.6s-1.2-2.6-2.6-2.6zm0 3.8c-0.7 0-1.3-0.6-1.3-1.3s0.6-1.3 1.3-1.3 1.3 0.6 1.3 1.3-0.6 1.3-1.3 1.3zm-21.3-3.8c-0.2 0-0.4 0.2-0.4 0.4v1.3c0 0.2 0.2 0.4 0.4 0.4h4.6c0.1-0.8 0.5-1.6 1.1-2.1h-5.7zm7.9 0c-1.4 0-2.6 1.1-2.6 2.6 0 1.4 1.1 2.6 2.6 2.6 1.4 0 2.6-1.1 2.6-2.6s-1.2-2.6-2.6-2.6zm0 3.8c-0.7 0-1.3-0.6-1.3-1.3s0.6-1.3 1.3-1.3 1.3 0.6 1.3 1.3-0.6 1.3-1.3 1.3zm6.2-19h-4.8c0.2 0.7 0.4 1.4 0.4 2.2 0 3.9-3.2 7-7 7-0.7 0-1.4-0.1-2-0.3v4.5c0 0.2 0.2 0.4 0.4 0.4h13.9c0.2 0 0.4-0.2 0.4-0.4v-12.2c-0.1-0.6-0.6-1.2-1.3-1.2zm-11.5-4c-3.4 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2-2.7-6.2-6.2-6.2zm0 11c-2.7 0-4.8-2.2-4.8-4.8s2.2-4.8 4.8-4.8c2.7 0 4.8 2.2 4.8 4.8 0 2.7-2.1 4.8-4.8 4.8zm1.9-3.8h-0.2l-2-0.5c-0.3-0.1-0.5-0.3-0.5-0.6v-3.1c0-0.3 0.3-0.6 0.6-0.6s0.7 0.3 0.7 0.6v2.6l1.5 0.4c0.3 0.1 0.5 0.4 0.4 0.8 0 0.3-0.3 0.4-0.5 0.4z"/></svg>'
            );

            $cfpp_data = apply_filters('cfpp_product_page_data', $cfpp_data);

            extract($cfpp_data);

            include_once(CFPP_BASE_PATH . '/views/product-page-cfpp.php');
        }
    }
}
