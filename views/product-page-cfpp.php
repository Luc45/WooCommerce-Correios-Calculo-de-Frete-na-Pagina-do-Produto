<div id="cfpp" style="display: <?php echo esc_html($cfpp_default_display); ?>;">
    <style>
        div#cfpp div.calculo-de-frete div#calcular-frete svg {fill:<?php echo esc_html($cfpp_options['text']); ?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {color:<?php echo esc_html($cfpp_options['text']); ?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {background-color:<?php echo esc_html($cfpp_options['button']); ?>;}
    </style>

    <div class="calculo-de-frete">

        <input type="text" maxlength="9">

        <div id="calcular-frete">
            <?php /** purposely not escaped */ echo $cfpp_icon_svg; ?> <?php echo __('Calculate Shipping', 'woo-correios-calculo-de-frete-na-pagina-do-produto') ?>
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
