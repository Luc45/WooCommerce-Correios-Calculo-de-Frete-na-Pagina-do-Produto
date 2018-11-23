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
}
