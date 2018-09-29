<?php

namespace CFPP\Frontend\Shipping;

use CFPP\Common\Helpers;

class ShippingZones {

    /**
    *   Returns a list of Shipping Zones by CEP
    */
    public function getShippingZonesByCEP($destination_cep)
    {
        $available_shipping_zones = array();

        $shipping_zones = \WC_Shipping_Zones::get_zones();

        // Loops each Shipping Zone
        foreach ($shipping_zones as $shipping_zone) {
            // Each Shipping Zone as it's own Shipping Locations
            foreach ($shipping_zone['zone_locations'] as $zone_location) {
                // Each Shipping Location can be of type Country, CEP, or State
                switch ($zone_location->type) {

                    case 'country':
                            if ($this->checkZoneLocationByCountry($zone_location))
                                $available_shipping_zones[] = $shipping_zone;
                        break;

                    case 'postcode':
                            if ($this->checkZoneLocationByPostCode($zone_location, $destination_cep))
                                $available_shipping_zones[] = $shipping_zone;
                        break;

                    case 'state':
                            if ($this->checkZoneLocationByState($zone_location, $destination_cep))
                                $available_shipping_zones[] = $shipping_zone;
                        break;

                }
            }
        }

        return $available_shipping_zones;
    }

    /**
     * Receives a Zone Location array of type Country and checks if we should return true
     */
    private function checkZoneLocationByCountry($zone_location)
    {
        // We will be returning true if country is Brazil
        return $zone_location->code == 'BR';
    }

    /**
     * Receives a Zone Location array of type PostCode and checks if we should return true based on CEP
     */
    private function checkZoneLocationByPostCode($zone_location, $cep_destinatario)
    {
        // CEPs separated by line. Can contain wildcards or ranges.
        // We need to proccess each line separately.
        $ceps = explode(PHP_EOL, $zone_location->code);
        foreach ($ceps as $key => $value) {
            // Is it a range?
            if (strpos($zone_location->code, '...') !== false) {
                $ranges = explode('...', $value);
                if (count($ranges) == 2 && is_numeric($ranges[0]) && is_numeric($ranges[1])) {
                    if ($cep_destinatario > (int) $ranges[0] && $cep_destinatario < (int) $ranges[1]) {
                        return true;
                    }
                }
                continue;
            }
            // Is it a wildcard?
            if (strpos($zone_location->code, '*') !== false) {
                $before_wildcard = strtok($zone_location->code, '*');
                $tamanho_string = strlen($before_wildcard);
                if (substr($cep_destinatario, 0, $tamanho_string) == $before_wildcard) {
                    return true;
                }

            }
            // Is it a literal comparison?
            if ($cep_destinatario == $zone_location->code) {
                return true;
            }
        }
        return false;
    }

    /**
     * Receives a Zone Location array of type State and checks if we should return true based on CEP
     */
    private function checkZoneLocationByState($zone_location, $cep_destinatario)
    {
        $country_and_state = explode(':', $zone_location->code);
        if ($country_and_state[0] == 'BR') {
            if (Helpers::isCepFromState($cep_destinatario, $country_and_state[1])) {
                return true;
            }
        }
        return false;
    }

}
