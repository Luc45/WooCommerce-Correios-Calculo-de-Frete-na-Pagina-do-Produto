<?php

namespace CFPP\Shipping;

use CFPP\Exceptions\PayloadException;
use CFPP\Shipping\ShippingMethods\Package;

class Payload
{
    /** @var \WC_Product */
    protected $product;

    /** @var int $postcode */
    protected $postcode;

    /** @var int $quantity */
    protected $quantity;

    /** @var array $package */
    protected $package;

    /**
     * @return array
     */
    public function getPackage()
    {
        return $this->package;
    }

    /**
     * @return int
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return \WC_Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param array $package
     */
    public function setPackage(array $package)
    {
        $this->package = $package;
    }

    /**
     * Generate a Payload object based on input or throws Exception
     *
     * @param \WC_Product $product
     * @param $destination_postcode
     * @param $quantity
     * @param $selected_variation
     * @throws PayloadException
     */
    public static function makeFrom(\WC_Product $product, $destination_postcode, $quantity, $selected_variation)
    {
        $instance = new self;
        $instance->postcode = $destination_postcode;
        $instance->quantity = $quantity;

        // Get real product from variation
        if (empty($selected_variation)) {
            $instance->product = $product;
        } else {
            if ($product instanceof \WC_Product_Variable) {
                $instance->product = $instance->getRealVariationProduct($product, $selected_variation);
            } else {
                throw PayloadException::product_is_not_variable($product);
            }
        }

        /**
        // Create package according to quantity of products chosen
        try {
            // We'll be using Correios Package calculation as default
            $instance->package = CorreiosPackage::generate($instance->getProduct(), $instance->getQuantity());
        } catch(PackageException $e) {
            throw PayloadException::invalid_package_exception($e->getMessage());
        }
         */

        return $instance;
    }

    /**
     * Returns WC_Product based on selected variation on frontend
     *
     * @param \WC_Product_Variable $product
     * @param $selected_variation
     * @return false|null|\WC_Product
     */
    private function getRealVariationProduct(\WC_Product_Variable $product, $selected_variation)
    {
        $variations = $product->get_children();

        foreach ($variations as $variation_id) {
            $possible_product = wc_get_product($variation_id);

            /** @example $attributes = ['color' => 'Black', 'size' => 'Large'] */
            $attributes = $possible_product->get_attributes();

            /** @example $attributes = 'Black-Large' */
            $attributes = implode('-', $attributes);

            /** @example $attributes = 'black-large' */
            $attributes = sanitize_title($attributes);

            /**
             * $selected_variation comes from the front-end, where we
             * replicate implode('-') and sanitize_title() with JavaScript
             */
            if ($attributes == $selected_variation) {
                $product = $possible_product;
                break;
            }
        }

        return $product;
    }
}
