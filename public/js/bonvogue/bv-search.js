$(function(){

	$('.mobile-filter-container').hide();

	$('.service_checkbox').click(function(){

		if(this.checked && $(this).val() =='All'){

			$("input[class='service_checkbox']").prop('checked',true);
			// $('#service-checkbox').attr('checked', true);
		} else if(!this.checked && $(this).val()=='All'){

			$("input[class='service_checkbox']").prop('checked',false);
		}

		var classcount = $(".service_checkbox").length;
		var thiscount =0;
		$("input[class='service_checkbox']").each(function(){

			if(this.checked) {

				thiscount = thiscount+1;
			}
		});

		if(!$("#allservice").prop("checked") && thiscount==(classcount-1)) {

			$("#allservice").prop("checked", true);
		} else if($("#allservice").prop("checked") && thiscount<classcount) {

			$("#allservice").prop("checked", false);

		}

	});

	$('body').click(function(){
		$( ".mobile-filter-container" ).hide();
	});

	$('.mobile-filter').click(function() {
	  $( ".mobile-filter-container" ).toggle( "slide", { direction: 'right'}, 500 );
	  event.stopPropagation();
	});
	

});

