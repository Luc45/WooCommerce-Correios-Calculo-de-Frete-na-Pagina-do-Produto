<?php

namespace CFPP\Shipping;

class Payload
{
    public $product;
    public $postcode;
    public $quantity;

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
        $this->postcode = $destination_postcode;
        $this->quantity = $quantity;

        if (empty($selected_variation)) {
            $this->product = $product;
        } else {
            if ($product instanceof \WC_Product_Variable) {
                $this->product = $this->getRealVariationProduct($product, $selected_variation);
            } else {
                throw new \Exception('Não foi possível calcular frete com variações para produto que não é variável.');
            }
        }

        return $this;
    }


    /**
     * Returns WC_Product based on selected variation on frontend
     *
     * @param \WC_Product $product
     * @param $selected_variation
     * @return false|null|\WC_Product
     */
    private function getRealVariationProduct(\WC_Product $product, $selected_variation)
    {
        $variations = $product->get_children();

        foreach ($variations as $variation_id) {
            $possible_product = wc_get_product($variation_id);
            $attributes = $possible_product->get_attributes();

            $attributes = implode('-', $attributes);
            $attributes = sanitize_title($attributes);

            if ($attributes == $selected_variation) {
                $product = $possible_product;
            }
        }

        return $product;
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
