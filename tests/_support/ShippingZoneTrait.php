<?php

trait ShippingZoneTrait
{
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
        $zone_obj->set_zone_locations([
            'type' => 'country',
            'code' => 'BR'
        ]);

        return $zone_obj;
    }

    /**
     * Registers Origin Postcode
     *
     * @param $postcode
     */
    public function setOriginPostcode($postcode)
    {
        add_filter('woocommerce_countries_base_postcode', function() use ($postcode) {
            return $postcode;
        });
    }

    /**
     * Add a shipping method to the default shipping zone
     * and return an array of shipping methods
     *
     * @param $shipping_method
     * @return array
     */
    public function addShippingMethod($shipping_method)
    {
        if (empty($this->default_shippingzone)) {
            $this->default_shippingzone = $this->generateShippingZone();
        }
        $this->default_shippingzone->add_shipping_method($shipping_method);
        return $this->default_shippingzone->get_shipping_methods();
    }
}