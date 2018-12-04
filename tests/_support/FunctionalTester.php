<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;

    /**
     * Prepares a Shipping Zone
     *
     * Usage:
     * $shipping_zone = $this->generateShippingZone();
     * $shipping_zone->add_shipping_method('correios-pac');
     */
    public function generateShippingZone()
    {
        // Create a new Shipping Zone for the test scenario
        $zone_obj = new \WC_Shipping_Zone();
        $zone_obj->zone_name = "Shipping Zone Test";
        $zone_obj->save();

        return $zone_obj;
    }

    /**
     * Prepares a Shipping Zone
     *
     * Usage:
     * $shipping_zone = $this->generateShippingZone();
     * $shipping_zone->add_shipping_method( 'correios-leve-internacional' );
     *
    public function generateShippingZone(array $shipping_zone_methods)
    {
        // Generate Shipping Zone
        $table_zones = $this->grabPrefixedTableNameFor('woocommerce_shipping_zones');
        $zone_id = $this->haveInDatabase($table_zones, [
            'zone_name' => 'Shipping Zone Test',
            'zone_order' => -1
        ]);

        // Generate Shipping Zone Locations
        $table_zone_locations = $this->grabPrefixedTableNameFor('woocommerce_shipping_zone_locations');
        $this->haveInDatabase($table_zone_locations, [
            'zone_id' => $zone_id,
            'location_code' => 'BR',
            'location_type' => 'country'
        ]);

        // Generate Shipping Zone Methods
        $table_zone_methods = $this->grabPrefixedTableNameFor('woocommerce_shipping_zone_methods');
        foreach ($shipping_zone_methods as $index => $method) {
            $this->haveInDatabase($table_zone_methods, [
                'zone_id' => $zone_id,
                'method_id' => $method,
                'method_order' => $index,
                'is_enabled' => 1
            ]);
        };
    }*/
}
