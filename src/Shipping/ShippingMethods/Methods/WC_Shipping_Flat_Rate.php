<?php

namespace CFPP\Shipping\ShippingMethods\Methods;

use CFPP\Shipping\Payload;
use CFPP\Shipping\ShippingMethods\ShippingMethodsAbstract;

class WC_Shipping_Flat_Rate extends ShippingMethodsAbstract
{
    /**
    *   Receives a Request and calculates the shipping
    */
    public function calculate(Payload $payload)
    {
        // Includes WooCommerce Math Class
        $wc_eval_math_file = WP_PLUGIN_DIR.'/woocommerce/includes/libraries/class-wc-eval-math.php';
        if (file_exists($wc_eval_math_file)) {
            include_once($wc_eval_math_file);
        }

        // Get the cost
        $cost = $this->shipping_method->cost;

        // WooCommerce stuff
        $locale = localeconv();
        $decimals = array( wc_get_price_decimal_separator(), $locale['decimal_point'], $locale['mon_decimal_point'], ',' );

        // Costs per quantity
        $sum = str_replace('[qty]', $payload->getQuantity(), $cost);

        // Remove whitespace from string.
        $sum = preg_replace('/\s+/', '', $sum);

        // Remove locale from string.
        $sum = str_replace($decimals, '.', $sum);

        // Trim invalid start/end characters.
        $sum = rtrim(ltrim($sum, "\t\n\r\0\x0B+*/"), "\t\n\r\0\x0B+-*/");

        // Do the math.
        if (class_exists('\WC_Eval_Math')) {
            $sum = $sum ? \WC_Eval_Math::evaluate($sum) : false;
        } else {
            // Let's try one last thing before failing
            $sum =  is_numeric($sum) ? $sum : false;
        }

        if (is_numeric($sum)) {
            return $this->response->success($sum, apply_filters('cfpp_flat_rate_days', 'Consulte-nos'));
        } else {
            return $this->response->error($sum);
        }
    }
}
