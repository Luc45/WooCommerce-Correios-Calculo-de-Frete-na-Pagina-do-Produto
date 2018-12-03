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

        $zone_obj->set_zone_locations([
            'type' => 'country',
            'code' => 'BR'
        ]);

        return $zone_obj;
    }
}
