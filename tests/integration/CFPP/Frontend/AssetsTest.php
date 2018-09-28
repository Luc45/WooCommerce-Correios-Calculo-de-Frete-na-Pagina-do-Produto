<?php
namespace CFPP\Frontend;

use CFPP\Frontend\Assets;

class AssetsTest extends \Codeception\TestCase\WPTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function tearDown()
    {
        parent::tearDown();
    }

    public function test_get_svg_returns_file_if_exists()
    {
        $assets = new Assets;
        if (file_exists(CFPP_BASE_PATH.'/assets/img/caminhao.svg'))
            $this->assertNotEquals($assets->getSvg('caminhao'), null);
    }

    public function test_get_svg_returns_null_if_file_does_not_exists()
    {
        $assets = new Assets;
        $this->assertEquals($assets->getSvg('foobar123'), null);
    }

}
