<?php

namespace CFPP;

use CFPP\Common\Notifications;
use CFPP\Common\Requirements;
use CFPP\Common\MinimumRequirementNotMetException;
use CFPP\Frontend\Frontend;

class Bootstrap
{
    /**
    *   Bootstraps the plugin
    */
    public function run()
    {
        add_action('plugins_loaded', array($this, 'checkRequirements'), 100);
    }

    /**
    *   Checks if we meet the minimum requirements and run the plugin
    */
    public function checkRequirements()
    {
        try {
            $requirements = new Requirements;
            $requirements->checkMinimumRequirements();

            add_action('rest_api_init', [new Rest, 'registerRoutes']);

            $frontend = new Frontend;
            $frontend->run();
        } catch (MinimumRequirementNotMetException $e) {
            Notifications::getInstance()->fatal(__($e->getMessage(), 'woo-correios-calculo-de-frete-na-pagina-do-produto'));
        }
    }
}
