<?php

namespace CFPP;

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
    *   Returns true if a CEP belongs to a certain state
    */
    public static function isPostcodeFromState($cep, $estado)
    {
        $cep = substr($cep, 0, 5); // 5 primeiros dígitos
        $cep = (int) $cep;

        switch ($estado) {
            // phpcs:disable
            case ('AC'): if ($cep >= 69900 && $cep <= 69999) return true; break;
            case ('AL'): if ($cep >= 57000 && $cep <= 57999) return true; break;
            case ('AP'): if ($cep >= 68900 && $cep <= 68999) return true; break;
            case ('AM'): if ($cep >= 69400 && $cep <= 69899) return true; break;
            case ('BA'): if ($cep >= 40000 && $cep <= 48999) return true; break;
            case ('CE'): if ($cep >= 60000 && $cep <= 63999) return true; break;
            case ('DF'): if ($cep >= 70000 && $cep <= 73699) return true; break;
            case ('ES'): if ($cep >= 29000 && $cep <= 29999) return true; break;
            case ('GO'): if ($cep >= 72800 && $cep <= 76799) return true; break;
            case ('MA'): if ($cep >= 65000 && $cep <= 65999) return true; break;
            case ('MT'): if ($cep >= 78000 && $cep <= 78899) return true; break;
            case ('MS'): if ($cep >= 79000 && $cep <= 79999) return true; break;
            case ('MG'): if ($cep >= 30000 && $cep <= 39999) return true; break;
            case ('PA'): if ($cep >= 66000 && $cep <= 68899) return true; break;
            case ('PB'): if ($cep >= 58000 && $cep <= 58999) return true; break;
            case ('PR'): if ($cep >= 80000 && $cep <= 87999) return true; break;
            case ('PE'): if ($cep >= 50000 && $cep <= 56999) return true; break;
            case ('PI'): if ($cep >= 64000 && $cep <= 64999) return true; break;
            case ('RJ'): if ($cep >= 20000 && $cep <= 28999) return true; break;
            case ('RN'): if ($cep >= 59000 && $cep <= 59999) return true; break;
            case ('RS'): if ($cep >= 90000 && $cep <= 99999) return true; break;
            case ('RO'): if ($cep >= 78900 && $cep <= 78999) return true; break;
            case ('RR'): if ($cep >= 69300 && $cep <= 69389) return true; break;
            case ('SC'): if ($cep >= 88000 && $cep <= 89999) return true; break;
            case ('SP'): if ($cep >= 01000 && $cep <= 19999) return true; break;
            case ('SE'): if ($cep >= 49000 && $cep <= 49999) return true; break;
            case ('TO'): if ($cep >= 77000 && $cep <= 77995) return true; break;
            // phpcs:enable
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
