<?php
namespace Helper;

/**
 * Define custom actions here
 */
/**
 *   Prepares a Shipping Zone for our tests
 */
function clearAndCreateShippingZone()
{
    // Deletes all Shipping Zones
    $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
    foreach ($WC_Shipping_Zones as $shipping_zone) {
        \WC_Shipping_Zones::delete_zone($shipping_zone['id']);
    }

    // Create a new Shipping Zone for the test scenario
    $zone_obj = new \WC_Shipping_Zone(0);
    $zone_obj->zone_name = "Shipping Zone Test";
    $zone_obj->save();

    $zone_obj->set_zone_locations([
        'type' => 'country',
        'code' => 'BR'
    ]);

    return $zone_obj;
}

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Integration extends \Codeception\Module
{

}
