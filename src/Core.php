<?php

namespace CFPP;

use CFPP\Admin\Requirements,
    CFPP\Admin\Admin,
    CFPP\Common\Ajax,
    CFPP\Frontend\Frontend;

class Core {

    /**
     * True if WordPress installation meets minimum requirements. False otherwise.
     */
    private $meetsRequirements = false;

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
        $this->meetsRequirements = $requirements->phpVersionSupported() &&
                                   $requirements->wooCommerceInstalled() &&
                                   $requirements->wooCommerceVersionSupported() &&
                                   $requirements->wooCommerceCorreiosInstalled() &&
                                   $requirements->validOriginCep();

        $this->afterCheckRequirements();
    }

    /**
     * Runs after requirements have been checked
     */
    private function afterCheckRequirements()
    {
        if ($this->meetsRequirements) {

            // Ajax specific actions
            $ajax = new Ajax;
            $ajax->listen();

            if (is_admin())
            {
                // Admin specific actions
                $admin = new Admin;
                $admin->run();
            } else
            {
                // Front-end specific actions
                $frontend = new Frontend;
                $frontend->run();
            }
        }
    }

}
