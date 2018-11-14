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
    * Define custom actions here
    */
    public function createProduct(float $price = 30.00, int $weight = 5, int $length = 10, int $width = 20, int $height = 30, array $meta = [])
    {
        $default_meta = [
            '_regular_price' => $price,
            '_sale_price' => '',
            '_price' => $price,
            '_weight' => $weight,
            '_length' => $length,
            '_width' => $width,
            '_height' => $height,
            '_manage_stock' => 'no',
            '_backorders' => 'no',
            '_sold_individually' => 'no',
            '_virtual' => 'no',
            '_downloadable' => 'no',
            '_download_limit' => '-1',
            '_download_expiry' => '-1',
            '_stock' => 'NULL',
            '_stock_status' => 'instock ',
            '_product_version' => '3.4.5 '
        ];

        $meta = array_merge($default_meta, $meta);

        return $this->havePostInDatabase([
            'post_type' => 'product',
            'meta' => $meta
        ]);
    }

    /**
     * Prepares a Shipping Zone
     *
     * Usage:
     * $shipping_zone = $this->generateShippingZone();
     * $shipping_zone->add_shipping_method( 'correios-leve-internacional' );
     */
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
    }
}
