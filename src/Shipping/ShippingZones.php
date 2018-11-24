<?php

namespace CFPP\Shipping;

use WC_Shipping_Zones;
use CFPP\Common\Helpers;

class ShippingZones
{
    /**
     * Returns first matching Shipping Zone for destination CEP.
     *
     * @param $destination_cep
     * @return bool|\WC_Shipping_Zone
     */
    public function getFirstMatchingShippingZone($destination_cep)
    {
        // Loops each Shipping Zone
        foreach (WC_Shipping_Zones::get_zones() as $shipping_zone) {
            // Each Shipping Zone may have multiple Shipping Locations
            foreach ($shipping_zone['zone_locations'] as $zone_location) {
                // Each Shipping Location can be of type Country, CEP, or State
                switch ($zone_location->type) {
                    case 'country':
                        if ($this->checkZoneLocationByCountry($zone_location)) {
                            return WC_Shipping_Zones::get_zone($shipping_zone['id']);
                        }
                        break;
                    case 'postcode':
                        if ($this->checkZoneLocationByPostCode($zone_location, $destination_cep)) {
                            return WC_Shipping_Zones::get_zone($shipping_zone['id']);
                        }
                        break;
                    case 'state':
                        if ($this->checkZoneLocationByState($zone_location, $destination_cep)) {
                            return WC_Shipping_Zones::get_zone($shipping_zone['id']);
                        }
                        break;
                }
            }
        }

        // If nothing is returned at this point, return "Locations not covered by your other zones"
        return WC_Shipping_Zones::get_zone(0);
    }

    /**
     * Receives a Zone Location array of type Country and checks if we should return true
     *
     * @param $zone_location
     * @return bool
     */
    private function checkZoneLocationByCountry($zone_location)
    {
        // We will be returning true if country is Brazil
        return $zone_location->code == 'BR';
    }

    /**
     * Receives a Zone Location array of type PostCode and checks if we should return true based on CEP
     *
     * @param $zone_location
     * @param $destination_cep
     * @return bool
     */
    private function checkZoneLocationByPostCode($zone_location, $destination_cep)
    {
        // Postcodes separated by line. Can contain wildcards or ranges.
        // We need to proccess each line separately.
        $ceps_zone = explode(PHP_EOL, $zone_location->code);
        foreach ($ceps_zone as $cep_zone) {
            // Is it a range?
            if (strpos($cep_zone, '...') !== false) {
                $ranges = explode('...', $cep_zone);
                if (count($ranges) == 2 && is_numeric($ranges[0]) && is_numeric($ranges[1])) {
                    if ($destination_cep >= (int) $ranges[0] && $destination_cep <= (int) $ranges[1]) {
                        return true;
                    }
                }
                continue;
            }
            // Is it a wildcard?
            if (strpos($cep_zone, '*') !== false) {
                $before_wildcard = str_replace('-', '', strtok($cep_zone, '*'));
                $tamanho_string = strlen($before_wildcard);
                if (substr($destination_cep, 0, $tamanho_string) == $before_wildcard) {
                    return true;
                }
            }
            // Is it a literal comparison?
            if ($destination_cep == Helpers::clearPostcode($cep_zone)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Receives a Zone Location array of type State and checks if we should return true based on CEP
     *
     * @param $zone_location
     * @param $destination_cep
     * @return bool
     */
    private function checkZoneLocationByState($zone_location, $destination_cep)
    {
        $country_and_state = explode(':', $zone_location->code);
        if ($country_and_state[0] == 'BR') {
            if (Helpers::isPostcodeFromState($destination_cep, $country_and_state[1])) {
                return true;
            }
        }
        return false;
    }
}
