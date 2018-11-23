<?php

namespace CFPP\Admin;

use CFPP\Admin\Assets;

class Admin
{

    /**
    *   Runs in admin panel when CFPP is active
    */
    public function run()
    {
        $this->enqueueAssets();
    }

    /**
    *   Enqueues Admin CSS and Javascript
    */
    private function enqueueAssets()
    {
        add_action('admin_enqueue_scripts', function() {
            $adminAssets =  new Assets;
            $adminAssets->enqueueCss();
            $adminAssets->enqueueJavaScript();
        });
    }
}
