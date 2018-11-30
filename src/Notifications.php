<?php

namespace CFPP;

class Notifications
{
    private $fatal, $warning;

    // Singleton instance
    public static $instance;

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
        $this->fatal = $message;
        add_action('admin_notices', array($this, 'display_fatal'), 10);
    }

    /**
     * Hooks a warning notification display
     */
    public function warning($message)
    {
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
            <p style="font-weight: bold;"><?php echo __('CFPP - Cálculo de Frete na Página do Produto' , 'woo-correios-calculo-de-frete-na-pagina-do-produto'); ?></p>
            <p><?php echo __('CFPP plugin DEACTIVATED itself, because:' , 'woo-correios-calculo-de-frete-na-pagina-do-produto'); ?> <strong><?php echo $this->fatal ?></strong></p>
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
            <p style="font-weight: bold;"><?php echo __('CFPP - Cálculo de Frete na Página do Produto' , 'woo-correios-calculo-de-frete-na-pagina-do-produto'); ?></p>
            <p><?php echo $this->warning ?></p>
        </div>
        <?php
    }
}
