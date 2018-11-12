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
     * $shipping_zone = $this->clearAndCreateShippingZone();
     * $shipping_zone->add_shipping_method( 'correios-leve-internacional' );
     */
    public function prepareShippingZone()
    {
        // Deletes all Shipping Zones
        $WC_Shipping_Zones = \WC_Shipping_Zones::get_zones();
        foreach ($WC_Shipping_Zones as $shipping_zone) {
            \WC_Shipping_Zones::delete_zone($shipping_zone->id);
        }

        // Create a new Shipping Zone for the test scenario
        $WC_Shipping_Zone = new \WC_Shipping_Zone( null );
        $WC_Shipping_Zone->set_zone_name('Shipping Methods Test');
        $WC_Shipping_Zone->set_zone_order(1);

        $locations = [];
        $locations[] = [
            'type' => 'country',
            'code' => 'BR'
        ];

        $WC_Shipping_Zone->set_locations($locations);
        $WC_Shipping_Zone->save();

        return $WC_Shipping_Zone;
    }
}
