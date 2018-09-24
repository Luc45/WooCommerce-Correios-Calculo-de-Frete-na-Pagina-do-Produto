<?php

namespace CFPP\Admin;

use CFPP\Admin\Assets;

class Admin {

    /**
    *   Runs when in admin and CFPP is active
    */
    public function run()
    {
        add_action( 'admin_enqueue_scripts', array($this, 'enqueueAssets') );
    }

    /**
    *   Enqueues Admin CSS and Javascript
    */
    public function enqueueAssets()
    {
        $adminAssets =  new Assets;
        $this->adminAssets->enqueueCss();
        $this->adminAssets->enqueueJavaScript();
    }

}
