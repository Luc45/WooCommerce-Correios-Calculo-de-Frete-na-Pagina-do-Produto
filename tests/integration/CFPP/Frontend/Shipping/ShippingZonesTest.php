<?php
namespace CFPP\Frontend\Shipping;

class ShippingZonesTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        // before
        parent::setUp();

        // your set up methods here
    }

    public function tearDown()
    {
        // your tear down methods here

        // then
        parent::tearDown();
    }

    /**
     * Test scenario where there is no Shipping Zone for requested Postcode
     */
    public function test_empty_zones()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Now, we should have only "Locations not covered by your other zones"

        $ShippingZones = new ShippingZones;
        $response = $ShippingZones->getFirstMatchingShippingZone('30360-230');

        $this->assertEquals('Locations not covered by your other zones', $response->get_zone_name());
    }

    /**
     * Test scenario for a literal postcode comparison
     */
    public function test_literal_postcode()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Literal Postcode Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'postcode',
            'code' => '30360-230'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        /*
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            var_dump($shipping_zone['zone_locations']);exit;
        }
        */

        $ShippingZones = new ShippingZones;
        $response = $ShippingZones->getFirstMatchingShippingZone('30360-230');

        $this->assertEquals('Literal Postcode Test', $response->get_zone_name());
    }

    /**
     * Test scenario for a wildcard postcode comparison
     */
    public function test_wildcard_postcode()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Wildcard Postcode Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'postcode',
            'code' => '30360*'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        $ShippingZones = new ShippingZones;

        $ceps_must_succeed = ['30360-230', '30360-231', '30360-000', '30360-999'];
        $ceps_must_fail = ['30361-230', '12345-231', '30361-000', '30361-999'];

        foreach ($ceps_must_succeed as $cep) {
            $response = $ShippingZones->getFirstMatchingShippingZone($cep);
            $this->assertEquals('Wildcard Postcode Test', $response->get_zone_name());
        }

        foreach ($ceps_must_fail as $cep) {
            $response = $ShippingZones->getFirstMatchingShippingZone($cep);
            $this->assertNotEquals('Wildcard Postcode Test', $response->get_zone_name());
        }
    }

    /**
     * Test scenario for a range postcode comparison
     */
    public function test_range_postcode()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Range Postcode Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'postcode',
            'code' => '30360000...99999999'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        $ShippingZones = new ShippingZones;

        $ceps_must_succeed = ['30360-001', '30360-000', '30360-231', '30360-000', '30360-999', '55555-555', '92383-823', '99999999'];
        $ceps_must_fail = ['30359-999', '12345-231'];

        foreach ($ceps_must_succeed as $cep) {
            $response = $ShippingZones->getFirstMatchingShippingZone($cep);
            $this->assertEquals('Range Postcode Test', $response->get_zone_name());
        }

        foreach ($ceps_must_fail as $cep) {
            $response = $ShippingZones->getFirstMatchingShippingZone($cep);
            $this->assertNotEquals('Range Postcode Test', $response->get_zone_name());
        }
    }

    /**
     * Test scenario for a country comparison
     */
    public function test_country_brazil()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Country Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'country',
            'code' => 'BR'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        $ShippingZones = new ShippingZones;

        $response = $ShippingZones->getFirstMatchingShippingZone('30360-230');
        $this->assertEquals('Country Test', $response->get_zone_name());
    }

    /**
     * Test scenario for a country comparison that should not match
     */
    public function test_country_not_brazil()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Country Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'country',
            'code' => 'US'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        $ShippingZones = new ShippingZones;

        $response = $ShippingZones->getFirstMatchingShippingZone('30360-230');
        $this->assertNotEquals('Country Test', $response->get_zone_name());
    }

}
