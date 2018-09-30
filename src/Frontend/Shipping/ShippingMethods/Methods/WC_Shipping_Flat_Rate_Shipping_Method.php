<?php

use CFPP\Frontend\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Flat_Rate_Shipping_Method extends ShippingMethodsAbstract {

    /**
    *   Returns the Display name for this Shipping Method
    */
    public function getName()
    {
        return 'Frete Único';
    }

    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(array $request)
    {

        // Get the cost
        $cost = $this->shipping_method->cost;

        // WooCommerce stuff
        $locale         = localeconv();
        $decimals       = array( wc_get_price_decimal_separator(), $locale['decimal_point'], $locale['mon_decimal_point'], ',' );

        // Costs per quantity
        $sum = str_replace('[qty]', $request['quantidade'], $cost);

        // Remove whitespace from string.
        $sum = preg_replace( '/\s+/', '', $sum );

        // Remove locale from string.
        $sum = str_replace( $decimals, '.', $sum );

        // Trim invalid start/end characters.
        $sum = rtrim( ltrim( $sum, "\t\n\r\0\x0B+*/" ), "\t\n\r\0\x0B+-*/" );

        // Do the math.
        return $sum ? \WC_Eval_Math::evaluate( $sum ) : false;
    }



}
