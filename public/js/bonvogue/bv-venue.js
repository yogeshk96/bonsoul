$(function () {
	var total = 0;
	var timeSelected;

	//Hide Appointment	
	$('.reservation').hide();
	$('.available-timings').hide();

	$('.confirmed-appt').hide();

	var fullDate = new Date();
	console.log(fullDate + 'and month is' + fullDate.getMonth());

	var twoDigitMonth = fullDate.getMonth()+ 1;	
	if(twoDigitMonth.length==1)  twoDigitMonth="0" +twoDigitMonth;
	var twoDigitDate = fullDate.getDate()+"";if(twoDigitDate.length==1) twoDigitDate="0" +twoDigitDate;
	var currentDate = fullDate.getFullYear() + "-" +twoDigitMonth + "-" + twoDigitDate;console.log(currentDate);

	//Favorite click

	$('.fav').click(function(){
		$(this).toggleClass("fa-heart-o fa-heart");		
	});
	

	// Date Picker 
    $('#datetimepicker1').datetimepicker({                  
      stepping: 15,
      minDate: currentDate,
      format: 'YYYY-MM-DD'
    }).on('dp.change', function(ev){
    		$('.available-timings').empty();
    		var time = ['11:30 AM','02:30 PM', '05:30 PM', '06:00 PM' ];
           	$('.available-timings').show();
           	$.each(time, function(i, val){
           		$('.available-timings').append('<div class="time unselect"><p>'+val+'</div>');
           	});
     });

    $(document).on("click", ".time" , function() {
    	$('.time').removeClass("select");
		$(this).toggleClass("unselect select");
		timeSelected = $(this).find('p').text();
		console.log(timeSelected);
	});

	$('button.add-service').click(function(){
		$('.confirmed-appt').hide();
		$('.reservation').fadeIn(1500);
		var service = $(this).closest('.venue-menu-item').find('.service-name').text();
		var price = $(this).closest('.venue-menu-item').find('.price-item').text();		
		total  = parseInt($(this).closest('.venue-menu-item').find('.price-item').text(), 10) + total;
    var itemid = $(this).attr("itemid");
		var spanText = '<span class="label label-default remove-service" itemid="'+itemid+'">x | '+service+'</span>';

		// $(".book-services").append('<span class="label label-default remove-service">x | '+service+'</span> \n');

		$(".book-services-cost").append('<tr>\n \t <td>'+spanText+'</td> \n \t <td>'+price+'</td> \n <\/tr>');
		$('.totalcost').text(total);

	});

     $(document).on("click","#bookappt", function(){

      var totalcost = $(".totalcost").text(),
          appointdate = $("#appointdate").val(),
          appointtime = $("#appointtime").val(),
          venueid = $(this).attr("venueid"),
          userid = $("#userid").val(),
          contact = $("#contactno").val(),
          totalservice = $(".remove-service").length;

          var allservices = [];

          $(".remove-service").each(function(){

            allservices.push($(this).attr("itemid"));
          });

          //var servicestring = allservices.join(",");
      if(userid == 0) {

        alert("please login to book appointment.");
      }
      else if(totalservice == 0) {

        alert("Please select a service.");
      } else if(appointdate == "") {

        alert("Please select a appointment date.");
      } else if(appointtime == ""){

        alert("Please select a appointment time.");
      } else if(contact == "" || contact == 0){

        alert("Please enter contact number.");
      } else {

        $.ajax({
          type:'GET',
          url:'/bonsoul/public/book_appointment',
          data:{userid:userid, venueid:venueid, appointdate:appointdate, appointtime:appointtime, allservices:allservices, contact:contact},
          success:function(result)
          {

            console.log(result);

            if(result == 1) {

              $('.reservation').hide();
              $('.confirmed-appt').show();
            }
          }
        });

        
      }
    });

	$(document).on("click", ".remove-service" , function() {
            var result = window.confirm('Are you sure you want to remove the service?');
            if (result == false) {
                e.preventDefault();
            } else {
            	var price = $(this).closest('tr').find('td:eq(1)').text();
            	 $(this).closest('tr').remove();
            	 total  = total - parseInt($(this).closest('tr').find('td:eq(1)').text(), 10) ;
            	 $('.totalcost').text(total);

            }  
    });

    // $(document).on("click","#bookappt", function(){
    // 	$('.reservation').hide();
    // 	$('.confirmed-appt').show();
    // });

    // Gallery - On click photo
    

    blueimp.Gallery(
          document.getElementById('links'), {
              onslide: function (index, slide) {             
              var text = this.list[index].getAttribute('data-description');                 
      			$('#blueimp-gallery').find('.comments').find('.description').empty();

      			$('#blueimp-gallery').find('.comments').find('.description').text(text);

      			console.log('text');
          		
          	}
          });
	});