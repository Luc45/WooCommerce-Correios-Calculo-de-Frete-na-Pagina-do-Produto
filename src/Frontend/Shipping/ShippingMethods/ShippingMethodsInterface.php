<?php

namespace CFPP\Frontend\Shipping\ShippingMethods;

interface ShippingMethodsInterface
{
    public function getName();
    public function calculate(array $request);
}
