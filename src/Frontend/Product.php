<?php

namespace CFPP\Frontend;

use WC_Product,
    CFPP\Common\Validate,
    CFPP\Frontend\Assets,
    CFPP\Frontend\Template;

class Product {

    private $productShippingInfo;

    /**
     *  Receives an instance of WC_Product
     *
     *  WC_Product is a WooCommerce class.
     */
    public function generateProductShippingInfo(WC_Product $product)
    {
        $this->productShippingInfo = array();

        $this->productShippingInfo['height'] = $product->get_height();
        $this->productShippingInfo['width'] = $product->get_width();
        $this->productShippingInfo['length'] = $product->get_length();
        $this->productShippingInfo['weight'] = $this->normalize_product_weight($product->get_weight());
        $this->productShippingInfo['price'] = $product->get_price();
        $this->productShippingInfo['id'] = $product->get_id();

        return $this->productShippingInfo;
    }

    /**
     * Normalize weight to kilos
     */
    private function normalize_product_weight($weight)
    {
        if (!is_numeric($weight)) return $weight;

        $measurement = get_option('woocommerce_weight_unit');

        switch ($measurement) {
            case 'g':
                $factor = 1000;
                break;
            case 'lbs':
                $factor = 2.20462;
                break;
            case 'oz':
                $factor = 35.274;
                break;
            case 'kg':
                $factor = 1;
                break;
        }

        return number_format($weight / $factor, 2, '.', ',');
    }

    /**
    *   Displays the HTML for the plugin in the product page
    */
    public function displayCFPPInProductPage()
    {
        if (is_product()) {

            global $product;

            if (is_subclass_of($product, 'WC_Product')) {
                $productShippingInfo = $this->generateProductShippingInfo($product);

                $validate_product = Validate::product($productShippingInfo);

                if ($validate_product['success'] !== true) {

                    if (current_user_can('manage_options'))
                        Template::include('invalid-product-shipping-info', array('error' => $validate_product['message']));

                } else {

                    Template::include('product-page-inline-javascript');

                    $data = array(
                        'product' => $productShippingInfo,
                        'options' => array(
                            'cor_do_texto' => '#FFF',
                            'cor_do_botao' => '#000'
                        ),
                        'caminhao_svg' => Assets::getSvg('caminhao')
                    );
                    Template::include('product-page-cfpp', $data);

                }
            }

        }
    }

}
