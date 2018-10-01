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

                // Extract shipping data from the product
                $productShippingInfo = $this->generateProductShippingInfo($product);

                // Validate that data
                $validate_product = Validate::product($productShippingInfo);

                if ($validate_product['success'] !== true) {
                    // Invalid product data. Show warning to administrator.
                    Notifications::getInstance()->adminOnly($validate_product['message']);
                } else {
                    $data = array(
                        'product' => $productShippingInfo,
                        'options' => array(
                            'cor_do_texto' => '#FFF',
                            'cor_do_botao' => '#03A9F4'
                        ),
                        'caminhao_svg' => Assets::getSvg('caminhao')
                    );

                    Template::include('product-page-cfpp', $data);
                }
            }
        }
    }
}
