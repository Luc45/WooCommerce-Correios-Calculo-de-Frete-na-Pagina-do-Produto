<?php

namespace CFPP;

use WC_Correios_Autofill_Addresses;

class Helpers
{
    /**
     * Normalize weight to kilos
     */
    public static function normalizeProductWeight($weight)
    {
        if (!is_numeric($weight)) {
            return $weight;
        }

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

        return round($weight / $factor, 2);
    }

    /**
     * Asserts a CEP belongs to a certain state
     *
     * @param $cep
     * @param $estado
     *
     * @return bool
     */
    public static function isPostcodeFromState($postcode, $state)
    {
        $p = substr($postcode, 0, 5); // 5 first digits of postcode
        $p = (int) $p;

        switch ($state) {
            // phpcs:disable
            case ('AC'): if ($p >= 69900 && $p <= 69999) return true; break;
            case ('AL'): if ($p >= 57000 && $p <= 57999) return true; break;
            case ('AP'): if ($p >= 68900 && $p <= 68999) return true; break;
            case ('AM'): if ($p >= 69400 && $p <= 69899) return true; break;
            case ('BA'): if ($p >= 40000 && $p <= 48999) return true; break;
            case ('CE'): if ($p >= 60000 && $p <= 63999) return true; break;
            case ('DF'): if ($p >= 70000 && $p <= 73699) return true; break;
            case ('ES'): if ($p >= 29000 && $p <= 29999) return true; break;
            case ('GO'): if ($p >= 72800 && $p <= 76799) return true; break;
            case ('MA'): if ($p >= 65000 && $p <= 65999) return true; break;
            case ('MT'): if ($p >= 78000 && $p <= 78899) return true; break;
            case ('MS'): if ($p >= 79000 && $p <= 79999) return true; break;
            case ('MG'): if ($p >= 30000 && $p <= 39999) return true; break;
            case ('PA'): if ($p >= 66000 && $p <= 68899) return true; break;
            case ('PB'): if ($p >= 58000 && $p <= 58999) return true; break;
            case ('PR'): if ($p >= 80000 && $p <= 87999) return true; break;
            case ('PE'): if ($p >= 50000 && $p <= 56999) return true; break;
            case ('PI'): if ($p >= 64000 && $p <= 64999) return true; break;
            case ('RJ'): if ($p >= 20000 && $p <= 28999) return true; break;
            case ('RN'): if ($p >= 59000 && $p <= 59999) return true; break;
            case ('RS'): if ($p >= 90000 && $p <= 99999) return true; break;
            case ('RO'): if ($p >= 78900 && $p <= 78999) return true; break;
            case ('RR'): if ($p >= 69300 && $p <= 69389) return true; break;
            case ('SC'): if ($p >= 88000 && $p <= 89999) return true; break;
            case ('SP'): if ($p >= 01000 && $p <= 19999) return true; break;
            case ('SE'): if ($p >= 49000 && $p <= 49999) return true; break;
            case ('TO'): if ($p >= 77000 && $p <= 77995) return true; break;
            // phpcs:enable
        }

        // If we got here it means the postcode didn't match the array above,
        // so let's try to get it directly from Correios.
        if (class_exists('WC_Correios_Autofill_Addresses')) {
            $result = WC_Correios_Autofill_Addresses::get_address($postcode);
            if ( ! empty($result)) {
                return $result->state == $state;
            }
        }

        return false;
    }

    /**
     *   Receives a CEP string and returns it with numbers only
     */
    public static function clearPostcode($cep)
    {
        // String type-hinting for older versions of PHP
        if (gettype($cep) != 'string') {
            throw new \InvalidArgumentException("CEP deve ser string.", 1);
        }

        return preg_replace('/[^0-9]/', '', $cep);
    }

    /**
     * Returns Origin CEP
     */
    public static function getOriginCep()
    {
        // Preference for the CEP defined in the constant
        return defined('CFPP_CEP') ? CFPP_CEP : get_option('woocommerce_store_postcode');
    }
}
