<?php

namespace CFPP\Frontend;

class Template
{
    public function include($template, array $data = array())
    {
        // String type-hinting for older versions of PHP
        if (gettype($template) != 'string') {
            return;
        }

        extract($data);
        include_once(CFPP_BASE_PATH.'/src/Templates/'.$template.'.php');
    }

    /**
     *   Displays the HTML for the plugin in the product page
     */
    public function showCFPPInProductPage()
    {
        if (is_product()) {
            global $product;

            if (is_subclass_of($product, 'WC_Product')) {
                // Displays notification for admin if product is virtual
                if ($product->is_virtual()) {
                    Notifications::getInstance()->productPageNotice('Este produto é do tipo "Virtual".');
                    return;
                }

                $default_display = apply_filters('cfpp_default_display', 'block', $product);
                $default_colors = apply_filters('cfpp_default_colors', array(
                    'text' => '#FFF',
                    'button' => '#03A9F4'
                ));

                $data = array(
                    'cfpp_product_id' => $product->get_id(),
                    'cfpp_default_display' => $default_display,
                    'cfpp_options' => $default_colors,
                    'cfpp_truck_svg' => Assets::getSvg('caminhao')
                );

                $this->include('product-page-cfpp', $data);
            }
        }
    }
}
