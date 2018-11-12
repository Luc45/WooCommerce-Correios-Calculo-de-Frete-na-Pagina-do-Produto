<div id="cfpp" style="display: <?php echo $cfpp_default_display; ?>;">
    <style>
        div#cfpp div.calculo-de-frete div#calcular-frete svg {fill:<?php echo $cfpp_options['cor_do_texto']?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {color:<?php echo $cfpp_options['cor_do_texto']?>;}
        div#cfpp div.calculo-de-frete div#calcular-frete {background-color:<?php echo $cfpp_options['cor_do_botao']?>;}
        <?php
        if (! current_user_can('manage_options')) {
            echo '.cfpp-has-error {display:none !important;}';
        }
        ?>
    </style>

    <?php wp_nonce_field('cfpp_nonce', 'cfpp_nonce'); ?>

    <input type="hidden" id="cfpp_endpoint_url" value="<?php echo admin_url('admin-ajax.php'); ?>">
    <input type="hidden" id="cfpp_height" value="<?php echo $cfpp_product['height'];?>">
    <input type="hidden" id="cfpp_width" value="<?php echo $cfpp_product['width'];?>">
    <input type="hidden" id="cfpp_length" value="<?php echo $cfpp_product['length'];?>">
    <input type="hidden" id="cfpp_weight" value="<?php echo $cfpp_product['weight'];?>">
    <input type="hidden" id="cfpp_price" value="<?php echo $cfpp_product['price'];?>">
    <input type="hidden" id="cfpp_id" value="<?php echo $cfpp_product['id'];?>">

    <div class="calculo-de-frete">

        <input type="text" maxlength="9">

        <div id="calcular-frete">
            <?php echo $cfpp_caminhao_svg;?> Calcular Frete
            <a href="https://www.lucasbustamante.com.br" title="Cálculo de Frete na Página do Produto, por Lucas Bustamante" target="_blank" id="cfpp_credits">CFPP</a>
        </div>

        <div id="calcular-frete-loader"></div>
    </div>

    <div class="resultado-frete">
        <table>
            <thead>
                <tr>
                    <td>Forma de envio</td>
                    <td>Custo estimado</td>
                    <td>Entrega estimada</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
