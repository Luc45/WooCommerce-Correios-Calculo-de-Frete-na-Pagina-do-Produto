(function( $ ) {
    'use strict';

    $(function() {



    });



})( jQuery );

/**
*   Simula a cor do botão no admin
*/
function simular_botao(t) {
    jQuery('.settings_page_cfpp-settings #calcular-frete').css('background-color', t.value);
}
function simular_texto(t) {
    jQuery('.settings_page_cfpp-settings #calcular-frete').css('color', t.value);
    jQuery('.settings_page_cfpp-settings #calcular-frete svg').css('fill', t.value);
}

function alterarParaText() {
    jQuery('#cor_do_botao').attr('type', 'text');
    jQuery('#cor_do_texto').attr('type', 'text');
    jQuery('#alterar_para_text').hide();
    jQuery('#alterar_para_seletor_cor').show();
}

function alterarParaSeletorCor() {
    jQuery('#cor_do_botao').attr('type', 'color');
    jQuery('#cor_do_texto').attr('type', 'color');
    jQuery('#alterar_para_text').show();
    jQuery('#alterar_para_seletor_cor').hide();
}
