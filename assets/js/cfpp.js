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

		 	var url = getUrl();
		 	var cep = getCep();
			var id =  getId();
			var quantity = getQuantity();
			var variation = getSelectedVariation();

		 	if (cep.length !== 8) {
		 		alert('Por favor, verifique se o CEP informado é válido.');
		 		return false;
		 	}

		 	url += id;
		 	url += '/' + cep;
		 	url += '/' + quantity;
		 	url += '/' + variation;

             // CEP Válido. Vamos ver quanto fica...
             exibirLoader();
             esconderTabela();
             resetarTabela();

		 	$.ajax({
				url: url,
				type: "GET",
                dataType: "json",
                error:function(jqXHR, exception) {
                    console.log(jqXHR);
                    console.log(exception);
                    esconderLoader();
                    esconderTabela();
                    resetarTabela();
                    return false;
                },
                success:function(result) {

                    // Teve erro?
                    if ( ! result.success) {
                        //$('#cfpp .resultado-frete table tbody').append('<tr><td colspan="3">' + result.data + '</td></tr>');
                        //esconderLoader();
                        //exibirTabela();
						console.log(result.data);
                        esconderLoader();
                        esconderTabela();
                        resetarTabela();
                        return;
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
		});

		// Reseta a tabela caso clique no botão "Clear all" para limpar
		// as variações selecionadas
		$("*").on("reset_data", function () {
			resetarTabela();
			esconderTabela();
		});

		 // Gets selected variation, if any
		 function getSelectedVariation()
		 {
		 	let select = $('.variations_form select');
		 	if (select.length) {
		 		var select_json = [];
		 		$.each(select, function() {
		 			select_json.push(wpFeSanitizeTitle($(this).val()));
				})
		 		return select_json.join('-');
			} else {
		 		return '';
			}
		 }

		 // Get quantity or defaults to 1
        function getQuantity() {
		 	let qt = $('input.qty').val().replace(/\D+/g, '');
            if (qt.length === 0) {
            	return 1;
			} else {
            	return qt;
			}
        }

        // Return REST request endpoint URL
        function getUrl() {
            return $('#cfpp_endpoint_url').val();
        }

        // Return Destination Postcode
        function getCep() {
            return $('#cfpp .calculo-de-frete input').val().replace(/\D+/g, '');
        }

        // Return Product ID
        function getId() {
            return $('#cfpp_id').val().replace(/\D+/g, '');
        }

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
