<?php

namespace Cfpp\Frontend;

class Ajax {

    /**
    *   Listens for Ajax calls on the front-end
    */
    public function listen() {
        add_action( 'wp_ajax_listen_cfpp_ajax', array($this, 'listen_cfpp_ajax') );
        add_action( 'wp_ajax_nopriv_listen_cfpp_ajax', array($this, 'listen_cfpp_ajax') );
    }

}
