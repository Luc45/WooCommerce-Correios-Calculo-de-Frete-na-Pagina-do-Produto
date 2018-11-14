<?php

use Codeception\Example;

class ValidationCest
{

    private $valid_data;
    protected $nonce;

    public function _before(FunctionalTester $I)
    {
        $postId = $I->createProduct();

        if (empty($this->nonce)) {
            $I->amOnPage('?p=' . $postId);
            $this->nonce = $I->grabValueFrom('#cfpp_nonce');
        }

        $this->valid_data = [
            'destination_postcode' => 31555060,
            'id' => $postId,
            'cfpp_nonce' => $this->nonce,
        ];
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
    public function should_fail_if_invalid_nonce(FunctionalTester $I, Example $example)
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
    public function should_fail_if_invalid_postcode(FunctionalTester $I, Example $example)
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
     * @example {"product_id": ""}
     * @example {"product_id": "abc"}
     * @example {"product_id": "1234567890"}
     */
    public function should_fail_if_invalid_product_id(FunctionalTester $I, Example $example)
    {
        $data = $this->valid_data;
        $data['id'] = $example['product_id'];
        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);
        $response = json_decode($I->grabResponse(), true);
        $I->assertFalse($response['success']);
        $I->assertContains('ID de produto', $response['data']);
    }
}
