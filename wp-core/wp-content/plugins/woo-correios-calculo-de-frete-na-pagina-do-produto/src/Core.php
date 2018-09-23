<?php

namespace CFPP;

use CFPP\Requirements;

class Core {

    private $meetsRequirements;

    /**
    *
    */
    public function run() {
        add_action( 'admin_init', array($this, 'checkRequirements'), 10);

    }

    /**
    *   Checks if we meet the minimum requirements to run the plugin
    */
    public function checkRequirements() {
        $requirements = new Requirements;
        $this->meetsRequirements = $requirements->phpVersionSupported() &&
                                   $requirements->wooCommerceInstalled() &&
                                   $requirements->wooCommerceVersionSupported() &&
                                   $requirements->validCep();
    }

}
