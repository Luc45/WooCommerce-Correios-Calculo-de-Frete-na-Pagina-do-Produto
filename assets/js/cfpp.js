(function( $ ) {
	'use strict';

	$(function() {

		 /**
		 *	Roda quando clica para calcular o Frete
		 */
		 $('#cfpp .calculo-de-frete div').on('click', function(e, l) {
		 	if ($(e.target).is('a#cfpp_credits')) {
		 		return;
		 	}

		 	var url =    $('#cfpp_endpoint_url').val();
		 	var cep =    $('#cfpp .calculo-de-frete input').val().replace(/\D+/g, '');
			var height = $('#cfpp_height').val();
			var width =  $('#cfpp_width').val();
			var length = $('#cfpp_length').val();
			var weight = $('#cfpp_weight').val();
			var price =  $('#cfpp_price').val();
			var id = $('#cfpp_id').val();
			var quantity = $('input.qty').val();
			var cfpp_nonce = $('#cfpp #cfpp_nonce').val();

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
			 			'height': height,
			 			'width': width,
			 			'length': length,
			 			'weight': weight,
			 			'price': price,
			 			'id': id,
			 			'quantity': quantity,
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
		 			var comErro = [];
		 			var row = '';
		 			// Outros métodos de envio
		 			if (result.data) {
		 				console.log(result.data);
		 				$(result.data).each(function(i, v) {
		 					if (v.status == 'error') {
		 					comErro.push(v);
		 					row += '<tr class="'+v.class+' cfpp-shipping-mode-'+v.status+'"">\
			                            <td>'+v.name+'</td>\
			                            <td colspan="2">'+v.debug+'</td>\
		                        	</tr>';
		 					} else {
			 					row += '<tr class="'+v.class+' cfpp-shipping-mode-'+v.status+'"">\
				                            <td>'+v.name+'</td>\
				                            <td>'+v.price+'</td>\
				                            <td>'+v.days+'</td>\
			                        	</tr>';
		 					}
		 				});
		 			}

		 			if (row == '') {
		 				row = '<tr><td colspan="3">Desculpe, o cálculo de frete para este produto só está disponível no Carrinho, por favor, prossiga com a compra normalmente.</td></tr>';
		 			}

		 			if (comErro.length) {
		 				let stringErro = '';
		 				$(comErro).each(function(i, v) {
		 					stringErro += '\n';
		 					stringErro += '• ';
		 					stringErro += v.name;
		 					stringErro += ': ';
		 					stringErro += v.debug;
		 				});
		 				console.error('CFPP: Métodos de entrega não exibidos: ' + stringErro);
		 				row += '<tr class="cfpp-has-error"><td colspan="3">Um ou mais métodos de entrega não foram exibidos aqui. Somente o administrador pode ver esta mensagem e os métodos não exibidos.</td></tr>';
		 			}

		 			$('#cfpp .resultado-frete table tbody').append(row);
		 			esconderLoader();
		 			exibirTabela();
		 		}
		 	});
		 })

		 // Exibe o loader
		 function exibirLoader() {
		 	$('#cfpp #calcular-frete').css('display', 'none');
		 	$('#cfpp #calcular-frete-loader').css('display', 'inline-block');
		 }

		 // Esconder o loader
		 function esconderLoader() {
		 	$('#cfpp #calcular-frete').css('display', 'inline-block');
		 	$('#cfpp #calcular-frete-loader').css('display', 'none');
		 }

		 // Exibe a tabela
		 function exibirTabela() {
		 	$('#cfpp .resultado-frete').show();
		 }

		 // Esconde a tabela
		 function esconderTabela() {
		 	$('#cfpp .resultado-frete').hide();
		 }

		 // Reseta a tabela
		 function resetarTabela() {
		 	$('#cfpp .resultado-frete table tbody').html('');
		 }

		// Altera o preço do produto caso uma nova variação seja selecionada
		$("*").on("show_variation", function (event, variation) {
			resetarTabela();
			esconderTabela();
			$('#cfpp').show();
			$('#cfpp_price').val(variation.display_price.toFixed(2));
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
