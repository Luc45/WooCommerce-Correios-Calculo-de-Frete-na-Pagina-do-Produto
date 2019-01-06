<?php

namespace CFPP\Shipping\ShippingMethods;

interface PackageInterface
{
    /**
     * Generates the package array
     *
     * @param \WC_Product $product
     * @param $quantity
     * @return array
     */
    public function generatePackage(\WC_Product $product, $quantity);
}