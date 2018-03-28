(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$(function() {

		 /**
		 *	Roda quando clica para calcular o Frete
		 */
		 $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .calculo-de-frete div').on('click', function() {
		 	var url = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_endpoint_url').val();
		 	var cep = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .calculo-de-frete input').val().replace(/\D+/g, '');
			var altura = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_altura').val();
			var largura = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_largura').val();
			var comprimento = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_comprimento').val();
			var peso = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_peso').val();
			var preco = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_preco').val();
			var id_produto = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #id_produto').val();
			var solicita_calculo_frete = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #solicita_calculo_frete').val();
		 	if (cep.length != 8) {
		 		alert('Por favor, verifique se o CEP informado é válido.');
		 		return false;
		 	}
		 	// CEP Válido. Vamos ver quanto fica...
		 	exibirLoader();
		 	esconderTabela();
		 	resetarTabela();
		 	$.ajax({
		 		url: url,
		 		type:"POST",
		 		data: {
		 			'action': 'escutar_solicitacoes_de_frete',
		 			'cep_origem': cep,
		 			'produto_altura': altura,
		 			'produto_largura': largura,
		 			'produto_comprimento': comprimento,
		 			'produto_peso': peso,
		 			'produto_preco': preco,
		 			'id_produto': id_produto,
		 			'solicita_calculo_frete': solicita_calculo_frete
		 		},
		 		success:function(result) {
		 			if (result.status == 'erro') {
		 				alert(result.status.mensagem);
		 				return false;
		 			}
		 			var tabela = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete table');
		 			var pac = tabela.find('[data-formaenvio="pac"]');
		 			pac.find('[data-custo]').text(result.pac.Valor);
		 			pac.find('[data-entrega]').text(result.pac.PrazoEntrega);

		 			var sedex = tabela.find('[data-formaenvio="sedex"]');
		 			sedex.find('[data-custo]').text(result.sedex.Valor);
		 			sedex.find('[data-entrega]').text(result.sedex.PrazoEntrega);
		 			esconderLoader();
		 			exibirTabela();
		 			console.log(result);
		 		}
		 	});
		 })

		 // Exibe o loader
		 function exibirLoader() {
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calcular-frete').css('display', 'none');
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calcular-frete-loader').css('display', 'inline-block');
		 }

		 // Esconder o loader
		 function esconderLoader() {
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calcular-frete').css('display', 'inline-block');
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calcular-frete-loader').css('display', 'none');
		 }

		 // Exibe a tabela
		 function exibirTabela() {
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete').show();
		 }

		 // Esconde a tabela
		 function esconderTabela() {
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete').hide();
		 }

		 // Reseta a tabela
		 function resetarTabela() {
 			var tabela = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete table');
 			var pac = tabela.find('[data-formaenvio="pac"]');
 			pac.find('[data-custo]').text('XX');
 			pac.find('[data-entrega]').text('XX');

 			var sedex = tabela.find('[data-formaenvio="sedex"]');
 			sedex.find('[data-custo]').text('XX');
 			sedex.find('[data-entrega]').text('XX');
		 }

	});



})( jQuery );


/**
*	Função auxiliar para verificar se algo é um número
*/
function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
        return true;
    }
};

/**
*	Função de Máscara em Javascript
*/
function mascara(t, mask) {
	var digitou_agora = t.value.substr(t.value.length - 1);
	if (!isNaN(digitou_agora)) {
		var i = t.value.length;
		var saida = mask.substring(1,0);
		var texto = mask.substring(i);
		if (texto.substring(0,1) != saida){
			t.value += texto.substring(0,1);
		}
	} else {
		t.value = t.value.slice(0, -1);
	}
}
