<?php

namespace CFPP\Frontend;

use CFPP\Frontend\Template;

class Notifications {

    // Singleton instance
    public static $instance;

    // Implements Singleton pattern
    public function __construct() {
        self::$instance = $this;
    }

    // Implements Singleton pattern
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
    *   Hooks a notification in product page for admins only
    */
    public function adminOnly($message)
    {
        if (current_user_can('manage_options')) {
            Template::include('cfpp-not-showing', array('error' => $message));
        }
    }

}
