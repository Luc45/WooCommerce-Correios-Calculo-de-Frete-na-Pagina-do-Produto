<?php

namespace CFPP;

use CFPP\Common\Notifications;
use CFPP\Common\Requirements;
use CFPP\Common\MinimumRequirementNotMetException;
use CFPP\Common\Frontend;

class Bootstrap
{
    /**
     * Bootstraps the plugin
     */
    public function run()
    {
        // Register REST routes
        add_action('rest_api_init', [new Rest, 'registerRoutes']);

        // Hook plugin initialization at plugins_loaded, since we use
        // WooCommerce and WooCommerce Correios functions
        add_action('plugins_loaded', function() {
            try {
                // Check requirements
                $requirements = new Requirements;
                $requirements->checkMinimumRequirements();

                // Enqueue assets and show CFPP on product page
                $frontend = new Frontend;
                $frontend->run();
            } catch (MinimumRequirementNotMetException $e) {
                Notifications::getInstance()->fatal($e->getMessage());
            }
        });
    }
}
