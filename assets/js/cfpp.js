(function($) {
	'use strict';

    /** Holds the HTML to be displayed after AJAX runs */
    var rows;

    /** bool to determine if error header for faulty shipping methods has been outputted */
    var error_header_outputted = false;

    $(document).ready(function() {

    	/** DOM element that holds the postcode input */
        var input_postcode = $(".calculo-de-frete input[type='text']");

        /** Runs when user clicks to calculate shipping costs */
		 $('#cfpp .calculo-de-frete div').on('click', function(e) {
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
				dataType: "json",
                timeout: cfppData.rest.timeout,
                data: {
					'quantity' : getQuantity(),
				 	'selected_variation' : getSelectedVariation()
				}
		 	}).done(function(results) {

		 		if (results.length === 0) {
                    addResponse.notFound();
				} else {
                    $(results).each(function(index, result) {
                        if (result.status === 'success') {
                            addResponse.successfulShippingMethod(result);
                        } else {
                            addResponse.errorShippingMethod(result);
                        }
                    });
				}

                $('#cfpp .resultado-frete table tbody').append(rows);
                hideLoader();
                showTable();

			}).fail(function(xhr) {
				console.error('-= CFPP returned an error response: ' + xhr.responseText + ' =-');
				hideLoader();
				hideTable();
				resetTable();
			});
		 });

		 /** Display CFPP after variations are selected */
		 if ($(".variations_form").length) {
             $('.variations_form').on('show_variation', function() {
                 $("#cfpp").show();
             });
		 }

		// Reset the table when clicks on the "Clear all" button
		// to clear selected variations
		$("*").on("reset_data", function () {
			resetTable();
			hideTable();
		});

		// Postcode mask
		VMasker(input_postcode).maskPattern(cfppData.i18n.postcode_mask);

		// Makes "Enter" calculate shipping costs
		input_postcode.on('keydown', function (e) {
		    if (e.keyCode === 13) {
		 		$('#calcular-frete').click();
		    	e.preventDefault();
		        return false;
		    }
		});
    });

    /**
	 * Methods responsible for receiving the AJAX JSON response and adding HTML to the results table
     */
    var addResponse = {
        addToRow: function(content) {
            if (typeof(content.class) === 'undefined') {
                content.class = '';
            }

            rows += "<tr class='" + content.class + "'>";

            $(content.cols).each(function(index, column) {
                rows += "<td colspan='" + column.colspan + "'>" + column.text + "</td>";
            });

            rows += "</tr>";
        },
        notFound: function() {
            this.addToRow(
                {
                    "class" : "cfpp-error",
                    "cols" : [
                        {
                            "colspan" : 3,
                            "text" : cfppData.i18n.shipping_costs_not_available
                        }
                    ]
                }
            );
        },
        successfulShippingMethod: function(result) {
            this.addToRow(
                {
                    "cols" : [
                        {
                            "colspan" : 1,
                            "text" : result.name
                        },
                        {
                            "colspan" : 1,
                            "text" : result.price
                        },
                        {
                            "colspan" : 1,
                            "text" : result.days
                        }
                    ]
                }
            );
        },
        errorShippingMethod: function(result) {
            if (error_header_outputted === false) {
                this.addErrorHeaderOnce();
            }
            this.addToRow(
                {
                    "class" : "cfpp-has-error",
                    "cols" : [
                        {
                            "colspan" : 1,
                            "text" : result.name
                        },
                        {
                            "colspan" : 2,
                            "text" : result.debug
                        }
                    ]
                }
            );
        },
        addErrorHeaderOnce: function() {
            this.addToRow(
                {
                    "class" : "cfpp-has-error",
                    "cols" : [
                        {
                            "colspan" : 3,
                            "text" : cfppData.i18n.shipping_method_not_shown
                        }
                    ]
                }
            );
            error_header_outputted = true;
        }
    };

    /**
	 * Gets selected variation, if any
     * @returns {string}
     */
    function getSelectedVariation()
    {
        let select = $('.variations_form select');
        if (select.length) {
            var select_json = [];
            $.each(select, function() {
            	// Mimics sanitize_title() WordPress' function
                select_json.push(wpFeSanitizeTitle($(this).val()));
            })
            return select_json.join('-');
        } else {
            return '';
        }
    }

    /**
	 * Get quantity or defaults to 1
     * @returns {*}
     */
    function getQuantity() {
        let qt = $('input.qty').val().replace(/\D+/g, '');
        if (qt.length === 0) {
            return 1;
        } else {
            return qt;
        }
    }

    /**
	 * Return Destination Postcode
     * @returns {*}
     */
    function getDestinationPostcode() {
        return $('#cfpp .calculo-de-frete input').val().replace(/\D+/g, '');
    }

    function showLoader() {
        $('#cfpp #calcular-frete').css('display', 'none');
        $('#cfpp #calcular-frete-loader').css('display', 'inline-block');
    }

    function hideLoader() {
        $('#cfpp #calcular-frete').css('display', 'inline-block');
        $('#cfpp #calcular-frete-loader').css('display', 'none');
    }

    function showTable() {
        $('#cfpp .resultado-frete').show();
    }

    function hideTable() {
        $('#cfpp .resultado-frete').hide();
    }

    function resetTable() {
		rows = '';
        $('#cfpp .resultado-frete table tbody').html(rows);
    }

})(jQuery);
