(function( $ ) {
	'use strict';

	$(function() {

		 /**
		 *	Roda quando clica para calcular o Frete
		 */
		 $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .calculo-de-frete div').on('click', function(e, l) {
		 	if ($(e.target).is('a#cfpp_credits')) {
		 		return;
		 	}
		 	var url = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_endpoint_url').val();
		 	var cep = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .calculo-de-frete input').val().replace(/\D+/g, '');
			var altura = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_altura').val();
			var largura = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_largura').val();
			var comprimento = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_comprimento').val();
			var peso = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_peso').val();
			var preco = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_preco').val();
			var id_produto = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #id_produto').val();
			var quantidade = $('input.qty').val();
			var cfpp_nonce = $('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #cfpp_nonce').val();
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
		 			'action' : 'cfpp_request_shipping_costs',
		 			'data' : {
			 			'destination_postcode': cep,
			 			'height': altura,
			 			'width': largura,
			 			'length': comprimento,
			 			'weight': peso,
			 			'price': preco,
			 			'id': id_produto,
			 			'quantity': quantidade,
			 			'cfpp_nonce': cfpp_nonce
		 			}
		 		},
		 		error:function(jqXHR, exception) {
			       var msg = '';
			        if (jqXHR.status === 0) {
			            msg = 'Not connect.\n Verify Network.';
			        } else if (jqXHR.status == 404) {
			            msg = 'Requested page not found. [404]';
			        } else if (jqXHR.status == 500) {
			            msg = 'Internal Server Error [500].';
			        } else if (exception === 'parsererror') {
			            msg = 'Requested JSON parse failed.';
			        } else if (exception === 'timeout') {
			            msg = 'Time out error.';
			        } else if (exception === 'abort') {
			            msg = 'Ajax request aborted.';
			        } else {
			            msg = 'Uncaught Error.\n' + jqXHR.responseText;
			        }
			        console.log(msg);
					esconderLoader();
					esconderTabela();
					resetarTabela();
					return false;
		 		},
		 		success:function(result) {
		 			// Teve erro?
		 			if (!result.success) {
		 				console.log('CFPP: '+result.data);
						esconderLoader();
						esconderTabela();
						resetarTabela();
		 			}
		 			var row = '';
		 			// Outros métodos de envio
		 			if (result.data) {
		 				console.log(result.data);
		 				$(result.data).each(function(i, v) {
		 					row += '<tr class="'+v.class+' cfpp-shipping-mode-'+v.status+'"">\
			                            <td>'+v.name+'</td>\
			                            <td>'+v.price+'</td>\
			                            <td>'+v.days+'</td>\
		                        	</tr>';
		 				});
		 			}

		 			if (row == '') {
		 				row = '<tr><td colspan="3">Desculpe, o cálculo de frete para este produto só está disponível no Carrinho, por favor, prossiga com a compra normalmente.</td></tr>';
		 			}

		 			$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete table tbody').append(row);
		 			esconderLoader();
		 			exibirTabela();
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
		 	$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto .resultado-frete table tbody').html('');
		 }

		// Altera o preço do produto caso uma nova variação seja selecionada
		$( ".single_variation_wrap" ).on( "show_variation", function ( event, variation ) {
			resetarTabela();
			esconderTabela();
			$('#woocommerce-correios-calculo-de-frete-na-pagina-do-produto #calculo_frete_produto_preco').val(variation.display_price.toFixed(2));
		} );

	});

	$(document).ready(function() {
		var input_cep = $(".calculo-de-frete input[type='text']");

		// Máscara de CEP
		VMasker(input_cep).maskPattern("99999-999");

		// Faz com que "Enter" calcule o frete
		input_cep.on('keydown', function (e) {
		    if (e.keyCode == 13) {
		 		$('#calcular-frete').click();
		    	e.preventDefault();
		        return false;
		    }
		});
	})

})( jQuery );
