<?php

namespace CFPP\Admin;

class Notifications
{

    // Singleton instance
    public static $instance;

    private $fatal;
    private $warning;

    // Implements Singleton pattern
    public function __construct()
    {
        self::$instance = $this;
    }

    // Implements Singleton pattern
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Hooks a fatal error notification display
     */
    public function fatal($message)
    {
        // String type-hinting for older versions of PHP
        if (gettype($message) != 'string') return;

        $this->fatal = $message;
        add_action('admin_notices', array($this, 'display_fatal'), 10);
    }

    /**
     * Hooks a warning notification display
     */
    public function warning($message)
    {
        // String type-hinting for older versions of PHP
        if (gettype($message) != 'string') return;

        $this->warning = $message;
        add_action('admin_notices', array($this, 'display_warning'), 10);
    }

    /**
     * Displays a fatal notification
     */
    public function display_fatal()
    {
        ?>
            <div class="error notice">
                <p style="font-weight: bold;">Cálculo de Frete na Página do Produto</p>
                <p>O plugin encontrou um problema: <strong><?php echo $this->fatal ?></strong></p>
            </div>
        <?php
    }

    /**
     * Displays a warning
     */
    public function display_warning()
    {
        ?>
            <div class="notice-warning notice">
                <p style="font-weight: bold;">Cálculo de Frete na Página do Produto</p>
                <p><?php echo $this->warning ?></p>
            </div>
        <?php
    }
}
