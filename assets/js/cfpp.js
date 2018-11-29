(function( $ ) {
	'use strict';

    $(function() {
        /**
		 * Runs when user clicks to calculate shipping costs
         */
		 $('#cfpp .calculo-de-frete div').on('click', function(e, l) {
		 	if ($(e.target).is('a#cfpp_credits')) {
		 		return;
		 	}

		 	var destination_postcode = getDestinationPostcode();
		 	if (destination_postcode.length !== 8) {
		 		alert(cfppData.i18n.invalid_postcode);
		 		return false;
		 	}

             showLoader();
             hideTable();
             resetTable();

		 	$.ajax({
				url: cfppData.rest.endpoint + `/${cfppData.product_id}/${destination_postcode}`,
				type: "GET",
                data: {
					'quantity' : getQuantity(),
				 	'variation' : getSelectedVariation()
				},
                beforeSend: function (xhr) {
                    xhr.setRequestHeader('X-WP-Nonce', cfppData.rest.nonce);
                }
		 	}).done(function(result) {
                if ( ! result.success) {
                    console.log(result.data);
                    hideLoader();
                    hideTable();
                    resetTable();
                    return;
                }

                var comErro = [];
                var row = '';

                if (result.data) {
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
                hideLoader();
                showTable();
			}).fail(function(jqXHR, exception) {
				console.log(jqXHR);
				console.log(exception);
				hideLoader();
				hideTable();
				resetTable();
			});
		 })

		 // Exibe o loader
		 function showLoader() {
		 	$('#cfpp #calcular-frete').css('display', 'none');
		 	$('#cfpp #calcular-frete-loader').css('display', 'inline-block');
		 }

		 // Esconder o loader
		 function hideLoader() {
		 	$('#cfpp #calcular-frete').css('display', 'inline-block');
		 	$('#cfpp #calcular-frete-loader').css('display', 'none');
		 }

		 // Exibe a tabela
		 function showTable() {
		 	$('#cfpp .resultado-frete').show();
		 }

		 // Esconde a tabela
		 function hideTable() {
		 	$('#cfpp .resultado-frete').hide();
		 }

		 // Reseta a tabela
		 function resetTable() {
		 	$('#cfpp .resultado-frete table tbody').html('');
		 }

		// Altera o preço do produto caso uma nova variação seja selecionada
		$("*").on("show_variation", function (event, variation) {
			resetTable();
			hideTable();
			$('#cfpp').show();
			$('#cfpp_price').val(variation.display_price.toFixed(2));
		});

		// Reseta a tabela caso clique no botão "Clear all" para limpar
		// as variações selecionadas
		$("*").on("reset_data", function () {
			resetTable();
			hideTable();
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

        // Return Destination Postcode
        function getDestinationPostcode() {
            return $('#cfpp .calculo-de-frete input').val().replace(/\D+/g, '');
        }
	});

	$(document).ready(function() {
		var input_postcode = $(".calculo-de-frete input[type='text']");

		// Postcode mask
		VMasker(input_postcode).maskPattern("99999-999");

		// Faz com que "Enter" calcule o frete
		input_postcode.on('keydown', function (e) {
		    if (e.keyCode === 13) {
		 		$('#calcular-frete').click();
		    	e.preventDefault();
		        return false;
		    }
		});
	})

})( jQuery );
