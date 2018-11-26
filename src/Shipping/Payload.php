<?php

namespace CFPP\Shipping;

class Payload
{
    /** @var \WC_Product */
    public $product;

    /** @var int $postcode */
    public $postcode;

    /** @var int $quantity */
    public $quantity;

    /** @var array $package */
    protected $package;

    /**
     * Generate a Payload object based on input or throws Exception
     *
     * @param \WC_Product $product
     * @param int $destination_postcode
     * @param int $quantity
     * @param mixed $selected_variation
     * @throws \Exception
     * @return $this
     */
    public function makeFrom(\WC_Product $product, $destination_postcode, $quantity, $selected_variation)
    {
        // Get real product from variation
        if (empty($selected_variation)) {
            $this->product = $product;
        } else {
            if ($product instanceof \WC_Product_Variable) {
                $this->product = $this->getRealVariationProduct($product, $selected_variation);
            } else {
                throw new \Exception(__('Could not calculate shipping with variation data for product that is not variable.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
            }
        }
        $this->postcode = $destination_postcode;
        $this->quantity = $quantity;

        // Create package according to quantity of products chosen
        $package = new Package($this);
        $this->package = $package->getData();

        if ( ! $this->validatePackage()) {
            throw new \Exception(__('Could not create a Package for Payload object in CFPP.', 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }

        return $this;
    }

    /**
     * Validates a Payload's package
     *
     * @return bool
     */
    private function validatePackage()
    {
        $is_valid = true;
        $required_properties = ['height', 'width', 'length', 'weight'];

        foreach ($required_properties as $required_property) {
            if ( ! array_key_exists($required_property, $this->package)) {
                $is_valid = false;
            } else {
                if ( ! is_numeric($this->package[$required_property])) {
                    $is_valid = false;
                }
            }
        }

        return $is_valid;
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
             * functions and libraries
             */
            if ($attributes == $selected_variation) {
                $product = $possible_product;
                break;
            }
        }

        return $product;
    }

    /**
     * Returns a package array
     *
     * @return array
     */
    public function getPackage()
    {
        return $this->package;
    }

    public function getPostcode()
    {
        return $this->postcode;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }
}
