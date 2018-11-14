<?php

use Codeception\Example;

class CorreiosShippingCest
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

    /**
     * @example {"id": "correios-pac", "name": "PAC"}
     * @example {"id": "correios-sedex", "name": "SEDEX"}
     * @example {"id": "correios-sedex10-envelope", "name": "SEDEX 10 Envelope"}
     * @example {"id": "correios-sedex10-pacote", "name": "SEDEX 10 Pacote"}
     * @example {"id": "correios-sedex12", "name": "SEDEX 12"}
     * @example {"id": "correios-sedex-hoje", "name": "SEDEX Hoje"}
     */
    public function should_show_successful_shipping_method_only(FunctionalTester $I, Example $example)
    {
        $data = $this->valid_data;

        $I->generateShippingZone([$example['id']]);

        $I->sendPost('/wp-admin/admin-ajax.php', [
            'action' => 'cfpp_request_shipping_costs',
            'data' => $data
        ]);

        $response = json_decode($I->grabResponse(), true);

        $I->assertTrue($response['success']);
        $I->assertCount(1, $response['data']);
        $I->assertEquals($example['name'], $response['data'][0]['name']);
    }
}
