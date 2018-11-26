<div id="cfpp" style="display: <?php echo esc_html($cfpp_default_display); ?>;">
    <style>
        div#cfpp div.calculo-de-frete div#calcular-frete svg {fill:<?php echo esc_html($cfpp_options['text']); ?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {color:<?php echo esc_html($cfpp_options['text']); ?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {background-color:<?php echo esc_html($cfpp_options['button']); ?>;}
        <?php
        if ( ! current_user_can('manage_options')) {
            // No big deal, just public debug info
            echo '.cfpp-has-error {display:none !important;}';
        }
        ?>
    </style>

    <input type="hidden" id="cfpp_endpoint_url" value="<?php echo esc_url(get_rest_url(null, '/cfpp/v1/calculate/')); ?>">
    <input type="hidden" id="cfpp_id" value="<?php echo absint($cfpp_product_id);?>">

    <div class="calculo-de-frete">

        <input type="text" maxlength="9">

        <div id="calcular-frete">
            <?php /** purposely not escaped */ echo $cfpp_truck_svg; ?> <?php echo __('Calculate Shipping', 'woo-correios-calculo-de-frete-na-pagina-do-produto') ?>
            <a href="https://www.lucasbustamante.com.br" title="Cálculo de Frete na Página do Produto, por Lucas Bustamante" target="_blank" id="cfpp_credits">CFPP</a>
        </div>

        <div id="calcular-frete-loader"></div>
    </div>

    <div class="resultado-frete">
        <table>
            <thead>
                <tr>
                    <td><?php echo __('Shipping Method', 'woo-correios-calculo-de-frete-na-pagina-do-produto') ?></td>
                    <td><?php echo __('Estimated Price', 'woo-correios-calculo-de-frete-na-pagina-do-produto') ?></td>
                    <td><?php echo __('Estimated Delivery', 'woo-correios-calculo-de-frete-na-pagina-do-produto') ?></td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
