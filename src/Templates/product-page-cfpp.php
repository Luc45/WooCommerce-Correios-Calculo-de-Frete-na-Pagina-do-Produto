<div id="woocommerce-correios-calculo-de-frete-na-pagina-do-produto">
    <style>
        div#woocommerce-correios-calculo-de-frete-na-pagina-do-produto div.calculo-de-frete div#calcular-frete svg {fill:<?php echo $options['cor_do_texto']?>;}
        div#woocommerce-correios-calculo-de-frete-na-pagina-do-produto div.calculo-de-frete div#calcular-frete {color:<?php echo $options['cor_do_texto']?>;}
        div#woocommerce-correios-calculo-de-frete-na-pagina-do-produto div.calculo-de-frete div#calcular-frete {background-color:<?php echo $options['cor_do_botao']?>;}
    </style>

    <?php wp_nonce_field('solicita_calculo_frete', 'solicita_calculo_frete'); ?>

    <input type="hidden" id="calculo_frete_endpoint_url" value="<?php echo admin_url( 'admin-ajax.php' ); ?>">
    <input type="hidden" id="calculo_frete_produto_altura" value="<?php echo $product['height'];?>">
    <input type="hidden" id="calculo_frete_produto_largura" value="<?php echo $product['width'];?>">
    <input type="hidden" id="calculo_frete_produto_comprimento" value="<?php echo $product['length'];?>">
    <input type="hidden" id="calculo_frete_produto_peso" value="<?php echo $product['weight'];?>">
    <input type="hidden" id="calculo_frete_produto_preco" value="<?php echo $product['price'];?>">
    <input type="hidden" id="id_produto" value="<?php echo $product['id'];?>">

    <div class="calculo-de-frete">
        <input type="text" maxlength="9" onkeydown="return mascara(this, '#####-###');">
        <div id="calcular-frete">
            <?php echo $caminhao_svg;?> Calcular Frete
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
