<?php


class ProductPageCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    // tests
    public function should_show_cfpp(FunctionalTester $I)
    {
        $postId = $I->createProduct();
        $I->amOnPage('?p=' . $postId);
        $I->seeElement('#cfpp_credits');
    }
}
