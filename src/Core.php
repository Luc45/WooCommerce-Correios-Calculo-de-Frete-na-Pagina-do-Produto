<?php

namespace CFPP;

use CFPP\Admin\Requirements;
use CFPP\Admin\Admin;
use CFPP\Frontend\Frontend;

class Core
{
    /**
    *   Bootstraps the plugin
    */
    public function run()
    {
        add_action('plugins_loaded', array($this, 'checkRequirements'), 100);
    }

    /**
    *   Checks if we meet the minimum requirements to run the plugin
    */
    public function checkRequirements()
    {
        $requirements = new Requirements;
        $meetsRequirements = $requirements->phpVersionSupported() &&
                             $requirements->wooCommerceInstalled() &&
                             $requirements->wooCommerceVersionSupported() &&
                             $requirements->wooCommerceCorreiosInstalled() &&
                             $requirements->validOriginCep();

        $this->afterCheckRequirements($meetsRequirements);
    }

    /**
     * Runs after requirements have been checked
     */
    private function afterCheckRequirements(bool $meetsRequirements)
    {
        if ($meetsRequirements) {
            if (is_admin()) {
                $admin = new Admin;
                $admin->run();
            } else {
                add_action('rest_api_init', [new Rest, 'registerRoutes']);

                $frontend = new Frontend;
                $frontend->run();
            }
        }
        // If requirements fails, a message is shown in admin panel and nothing happens
    }
}
