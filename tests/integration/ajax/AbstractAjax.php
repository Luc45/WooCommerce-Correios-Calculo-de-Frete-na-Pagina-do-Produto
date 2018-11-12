<?php

class AbstractAjax extends \Codeception\TestCase\WPAjaxTestCase
{
    protected $original_post;

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();

        $shipping = new \CFPP\Shipping\Shipping;
        add_action('wp_ajax_cfpp_request_shipping_costs', array($shipping, 'calculateShippingCostsAjax'));
        add_action('wp_ajax_nopriv_cfpp_request_shipping_costs', array($shipping, 'calculateShippingCostsAjax'));
    }

    public function setUp()
    {
        // before
        parent::setUp();

        // Stores first $_POST as the "original"
        if (empty($this->original_post)) {
            $this->original_post = $_POST;
        }

        // Stores a default data for ease of use
        if (empty($_POST['data'])) {
            $_POST['data'] = [
                'destination_postcode' => 31555060,
                'height' => 20,
                'width' => 20,
                'length' => 20,
                'weight' => 20,
                'price' => 15.00,
                'id' => 29,
                'quantity' => 1,
                'cfpp_nonce' => wp_create_nonce('cfpp_nonce') // Might need to re-create it in method if setting user
            ];
        } else {
            $this->markTestSkipped('$_POST["data"] should be empty to run these tests.');
        }
    }

    public function tearDown()
    {
        // Reset $_POST to "original"
        $_POST = $this->original_post;

        // then
        parent::tearDown();
    }

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
     * @return array
     */
    public function provider_invalid_nonces()
    {
        return [
            'null' => ["nonce" => NULL],
            'letters' => ["nonce" => "abc"],
            'numbers' => ["nonce" => "123"],
        ];
    }

    /**
     * @return array
     */
    public function provider_invalid_postcodes()
    {
        return [
            'null' => [NULL],
            'letters' => ["abc"],
            'large number as string' => ["303602301"],
            'short number as string' => ["3036023"],
            'large number as int' => [303602301],
            'short number as int' => [3036023],
        ];
    }

    /**
     * @return array
     */
    public function provider_invalid_dimensions()
    {
        return [
            'null' => [NULL],
            'letters' => ["abc"],
            'negative number as string' => ["-1"],
            'negative number as int' => [-1],
            'negative number as float' => [-1.0],
        ];
    }
}