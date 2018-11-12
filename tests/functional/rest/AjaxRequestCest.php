<?php


class AjaxRequestCest
{

    private $valid_data;

    public function _before(FunctionalTester $I)
    {
        if (empty($this->valid_data)) {
            $I->amOnPage('/?p=29');
            $nonce = $I->grabValueFrom('#cfpp_nonce');
            $this->valid_data = [
                'destination_postcode' => 31555060,
                'height' => 15,
                'width' => 15,
                'length' => 15,
                'weight' => 15,
                'price' => 15.00,
                'id' => 29,
                'quantity' => 1,
                'cfpp_nonce' => $nonce,
            ];
        }
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function should_fail_if_empty_data(FunctionalTester $I)
    {
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Error at', $response['data']);
    }

    /**
     * @example {"nonce": ""}
     * @example {"nonce": "abc"}
     * @example {"nonce": "123"}
     */
    public function should_fail_if_invalid_nonce(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['cfpp_nonce'] = $example['nonce'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Unable to verify WP Nonce', $response['data']);
    }

    /**
     * @example {"postcode": ""}
     * @example {"postcode": "abc"}
     * @example {"postcode": "303602301"}
     */
    public function should_fail_if_invalid_postcode(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['destination_postcode'] = $example['postcode'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('CEP', $response['data']);
    }

    /**
     * @example {"height": ""}
     * @example {"height": "abc"}
     */
    public function should_fail_if_invalid_height(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['height'] = $example['height'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Altura', $response['data']);
    }

    /**
     * @example {"width": ""}
     * @example {"width": "abc"}
     */
    public function should_fail_if_invalid_width(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['width'] = $example['width'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Largura', $response['data']);
    }

    /**
     * @example {"length": ""}
     * @example {"length": "abc"}
     */
    public function should_fail_if_invalid_length(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['length'] = $example['length'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Comprimento', $response['data']);
    }

    /**
     * @example {"price": ""}
     * @example {"price": "abc"}
     */
    public function should_fail_if_invalid_price(FunctionalTester $I, \Codeception\Example $example)
    {
        $data = $this->valid_data;
        $data['price'] = $example['price'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('Preço', $response['data']);
    }

    public function should_succeed_with_valid_data(FunctionalTester $I)
    {
        $data = $this->valid_data;
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertTrue($response['success']);
    }
}
