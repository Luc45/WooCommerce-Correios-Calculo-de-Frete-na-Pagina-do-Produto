<?php

namespace CFPP\Admin;

class Notifications {

    private $fatal;
    private $warning;

    /**
     * Hooks a fatal error notification display
     */
    public function fatal(string $message)
    {
        $this->fatal = $message;
        add_action( 'admin_notices', array($this, 'display_fatal'), 10 );
    }

    /**
     * Hooks a warning notification display
     */
    public function warning(string $message)
    {
        $this->warning = $message;
        add_action( 'admin_notices', array($this, 'display_warning'), 10 );
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
                <p style="font-weight: bold;">Atenção!!</p>
                <p><?php echo $this->warning ?></p>
            </div>
        <?php
    }

}
