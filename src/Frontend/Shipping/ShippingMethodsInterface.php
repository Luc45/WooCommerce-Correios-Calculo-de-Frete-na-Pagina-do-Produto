<?php

namespace CFPP\Frontend\Shipping;

interface ShippingMethods
{
    public function calculate();
    public function getDisplayName();
}
