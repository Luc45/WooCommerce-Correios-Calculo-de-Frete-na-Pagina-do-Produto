<?php

namespace CFPP\Frontend;

use WC_Product;
use CFPP\Common\Helpers;
use CFPP\Common\Validate;
use CFPP\Frontend\Assets;
use CFPP\Frontend\Notifications;
use CFPP\Frontend\Template;

class Product
{

    /**
     *  Receives an instance of WC_Product
     *
     *  WC_Product is a WooCommerce class.
     */
    public function generateProductShippingInfo(WC_Product $product)
    {
        $productShippingInfo = array();

        $productShippingInfo['height'] = $product->get_height();
        $productShippingInfo['width'] = $product->get_width();
        $productShippingInfo['length'] = $product->get_length();
        $productShippingInfo['weight'] = Helpers::normalizeProductWeight($product->get_weight());
        $productShippingInfo['price'] = $product->get_price();
        $productShippingInfo['type'] = $product->get_type();
        $productShippingInfo['id'] = $product->get_id();

        return $productShippingInfo;
    }

    /**
    *   Displays the HTML for the plugin in the product page
    */
    public function displayCFPPInProductPage()
    {
        if (is_product()) {
            global $product;

            if (is_subclass_of($product, 'WC_Product')) {
                // Displays notification for admin if product is virtual
                if ($product->is_virtual()) {
                    Notifications::getInstance()->adminOnly('Este produto é do tipo "Virtual".');
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

                Template::include('product-page-cfpp', $data);
            }
        }
    }
}
