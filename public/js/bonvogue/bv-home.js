$(function () {

	var services = $('.prof-services ul li');
	var location = $('.curr-loc ul li');


	$('.prof-services').hide();
	
	$('.curr-loc').hide();

	$('.bv-search-prof-serv').click(function(){
		$('.prof-services').show();
	});

	$('.venue-search').hide();

	$('.bv-loc-input').click(function(){
		$('.curr-loc').show();
	});

	$('.bv-search-prof-serv').keypress(function(){		
		$('.prof-services').hide();
		var data = [
		{value : 'Ajay Krishna'},
		{value : 'Kiran Kumar'},
		{value : 'John Smith'},
		{value : 'A Raj'},
		{value : 'A Priya'},
		{value : 'A John'},
		{value : 'A Joe'},
		{value : 'A Rachel'},
		];

		$(this).autocomplete({
		    lookup: data,
		    onSelect: function (suggestion) {
		    	console.log(data);
		        alert('You selected: ' + suggestion.val );
		    }

		});	
	});

	$('.bv-search-bottom').click(function(){
		if($('.bv-search-bottom h3').text() == "Search by name"){
			$('.service-search').hide();
			$('.venue-search').show();
			$('.bv-search-bottom h3').text("Search by service");
		} else {
			$('.service-search').show();
			$('.venue-search').hide();
			$('.bv-search-bottom h3').text("Search by name");
		}
		
	});

	$(document).mouseup(function (e)
	{
	    var container = $(".prof-services");
	    var container2 = $(".curr-loc");
	    if (!container.is(e.target) // if the target of the click isn't the container...
	        && container.has(e.target).length === 0) // ... nor a descendant of the container
	    {
	        container.hide();
	    }

	    if (!container2.is(e.target) // if the target of the click isn't the container2...
	        && container2.has(e.target).length === 0) // ... nor a descendant of the container2
	    {
	        container2.hide();
	    }

	    services.click(function(){
			$('.bv-search-prof-serv').val($(this).text());			
		});

		location.click(function(){
			$('.bv-loc-input').val($(this).text());
		});

	});


});