<?php

namespace CFPP;

use CFPP\Admin\Requirements,
    CFPP\Admin\Admin,
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
        add_action( 'wp', array($this, 'checkRequirements'), 50);
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
                                   $requirements->validOriginCep();

        $this->afterCheckRequirements();
    }

    /**
     * Runs after requirements have been checked
     */
    private function afterCheckRequirements()
    {
        if ($this->meetsRequirements) {
            if (is_admin()) {
                $admin = new Admin;
                $admin->run();
            } else {
                $frontend = new Frontend;
                $frontend->run();
            }
        }
    }

}
