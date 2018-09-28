<?php

namespace CFPP\Common;

class Helpers {

    /**
     * Normalize weight to kilos
     */
    public static function normalizeProductWeight($weight)
    {
        if (!is_numeric($weight))
            return $weight;

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
            default:
                throw new \Exception("Unable to recognize woocommerce_weight_unit: ".$measurement.'. Supported units are: kg, g, lbs and oz.', 1);
        }

        return number_format($weight / $factor, 2, '.', ',');
    }

}
