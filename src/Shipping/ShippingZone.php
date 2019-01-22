<?php

namespace CFPP\Shipping;

use CFPP\Exceptions\ShippingZoneException;
use WC_Shipping_Zones;
use CFPP\Helpers;

class ShippingZone
{
    /**
     * Returns first matching Shipping Zone for destination postcode.
     *
     * @param string $destination_postcode
     */
    public static function getFirstMatchingShippingZone($destination_postcode)
    {
        $instance = new self;
        $match = null;

        // Loops each Shipping Zone
        foreach (WC_Shipping_Zones::get_zones() as $shipping_zone) {
            // Each Shipping Zone may have multiple Shipping Locations
            foreach ($shipping_zone['zone_locations'] as $zone_location) {
                // Each Shipping Location can be of type Country, Postcode, or State
                if (empty($match)) {
                    switch ($zone_location->type) {
                        case 'country':
                            if ($instance->checkZoneLocationByCountry($zone_location)) {
                                $match = WC_Shipping_Zones::get_zone($shipping_zone['id']);
                            }
                            break;
                        case 'postcode':
                            if ($instance->checkZoneLocationByPostCode($zone_location, $destination_postcode)) {
                                $match = WC_Shipping_Zones::get_zone($shipping_zone['id']);
                            }
                            break;
                        case 'state':
                            if ($instance->checkZoneLocationByState($zone_location, $destination_postcode)) {
                                $match = WC_Shipping_Zones::get_zone($shipping_zone['id']);
                            }
                            break;
                    }
                }
            }
        }

        // If nothing is returned at this point, defaults to "Locations not covered by your other zones"
        if (empty($match)) {
            $match = WC_Shipping_Zones::get_zone(0);
        }

        $match = apply_filters('cfpp_get_shipping_zone', $match, $destination_postcode);

        // The only way it returns invalid is with apply_filters interference
        if ($match instanceof \WC_Shipping_Zone === false) {
            throw ShippingZoneException::invalid_shipping_zone_exception();
        }

        return $match;
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
        $zone_postcodes = explode(PHP_EOL, $zone_location->code);
        foreach ($zone_postcodes as $zone_postcode) {
            // Is it a range?
            if (strpos($zone_postcode, '...') !== false) {
                $ranges = explode('...', $zone_postcode);
                if (count($ranges) == 2 && is_numeric($ranges[0]) && is_numeric($ranges[1])) {
                    if ($destination_cep >= (int) $ranges[0] && $destination_cep <= (int) $ranges[1]) {
                        return true;
                    }
                }
                continue;
            }
            // Is it a wildcard?
            if (strpos($zone_postcode, '*') !== false) {
                $before_wildcard = str_replace('-', '', strtok($zone_postcode, '*'));
                $tamanho_string = strlen($before_wildcard);
                if (substr($destination_cep, 0, $tamanho_string) == $before_wildcard) {
                    return true;
                }
            }
            // Is it a literal comparison?
            if ($destination_cep == Helpers::clearPostcode($zone_postcode)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Receives a Zone Location array of type State and checks if we should return true based on CEP
     *
     * @param $zone_location
     * @param $destination_postcode
     * @return bool
     */
    private function checkZoneLocationByState($zone_location, $destination_postcode)
    {
        $country_and_state = explode(':', $zone_location->code);
        if ($country_and_state[0] == 'BR') {
            return Helpers::isPostcodeFromState($destination_postcode, $country_and_state[1]);
        }
        return false;
    }
}
