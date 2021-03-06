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

	$(document).on("click", ".btn-login", function(){

		var email = $("#loginemail").val(),
			pass = $("#loginpassword").val();

		if(email == "") {

			alert("Please enter email id.");
		} else if(pass == "") {

			alert("Please enter your password.");
		} else {

			$.ajax({
	          type:'GET',
	          url:locurl+'/login',
	          data:{email:email, pass:pass},
	          success:function(result)
	          {

	          	if(result[0] != 0){

		            $(".signupmenu").hide();
		          	$(".loginmenu").text('Wecome '+result[0]);
		          	$("#userid").val(result[1]);

		          	$('#login-modal').modal('hide');
		        } else {

		        	$(".errormsg").text("Wrong username/password.");
		        }
	          }
	        });
		}
	});

	$(document).on("click", ".btn-signup", function(){

		var email = $("#signupemail").val(),
			pass = $("#signuppassword").val(),
			cpass = $("#confpassword").val(),
			name = $("#signupname").val();

		if(name == "") {

			alert("Please enter your name.");
		}
		else if(email == "") {

			alert("Please enter email id.");
		} else if(pass == "") {

			alert("Please enter your password.");
		} else if(cpass == "") {

			alert("Please confirm password.");
		} else if(pass != cpass) {

			alert("Password do not match.");
		} else {

			$.ajax({
	          type:'GET',
	          url:locurl+'/siteregister',
	          data:{email:email, pass:pass, cpass:cpass, name:name},
	          success:function(result)
	          {

	          	$(".signupmenu").hide();
	          	$(".loginmenu").text('Wecome '+result);


	          	$('#p-signup-modal').modal('hide');

	            console.log(result);
	          }
	        });
		}
	});

	$(document).on("click", ".logout-btn", function(){

		$.ajax({
	      type:'GET',
	      url:'/bonsoul/public/logout',
	      success:function(result)
	      {
	      	console.log(result);

	      	$("#userid").val(0);

	        $(".signupmenu").show();
	      	$(".loginmenu").text('<a href="#login-modal" data-toggle="modal">Login</a>');

	      }
	    });
	});


});