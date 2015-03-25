@extends('app')

@section('app-content')
<input type="hidden" id="userid" value="{{$userid}}" />

<div class="profile-container">
    
  <div class="row">

    <div class="col-md-3">
      <img src="{{$cdnUrl}}/{{$mainpic}}" width="100%">
    </div>

    <div class="col-md-5 details">    
      <h3>{{$venuedetail->name}}</h3>
      <h4>{{$venuedetail->address}}</h4>
      <!--<button type="button" class="btn btn-default"  data-toggle="modal" data-target="#recommendation-modal">Write A Review</button> -->
      <button type="button" class="btn btn-default"><a data-scroll href="#myTab">Book</a></button>

      <!-- <p>Hello and thank you for stopping by! My name is Jessica, my game is beauty.
My specailty is hair and makeup artistry, and consultations are free. Please call me or book online to set up an appointment, I can't wait to meet you.
-Jessica Saltzer
Professional Hair & Makeup</p> -->
      
      <div class="row recomm-fav-container">
        <p class="col-md-4"><i class="fa fa-envelope-o"> {{count($selfreviews)}} Review(s)</i></p>
        <!-- <p class="col-md-4 favcount"><i class="fa fa-heart-o fav"></i> 45</p> -->
      </div>


    </div>

    <div class="col-md-4">    


    </div>

  </div>

<div class="profile-heading">
  <h3>Gallery</h3>
</div>

  <div class="img-portfolio" id="links">
     
      @foreach($venuepicArr as $venuepic)
      <div class="portfo-item">
        <a href="{{$cdnUrl}}/{{$venuepic}}" title="Banana" data-description="Lorem Ipsum is simply dummy text of the printing and typesetting industry." data-fav="34" data-comments="52" data-gallery>
            <img src="{{$cdnUrl}}/{{$venuepic}}" alt="Banana">
        </a>         
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>
      @endforeach

  </div>



<div class="profile-heading">
  <h3>Menu</h3>
</div>

<div class="row menu-details">
<div class="col-md-8">
    <ul class="nav nav-tabs responsive" id="myTab">
    {{--*/ $i = 1 /*--}}
    @foreach($venueitems[0]->allitems as $vvalue)

        @if($i == 1)
          {{--*/ $activebox = $vvalue->name /*--}}
          <li class="active"><a href="#{{$vvalue->name}}">{{$vvalue->name}}</a></li>
        @else
          <li><a href="#{{$vvalue->name}}">{{$vvalue->name}}</a></li>
        @endif
        {{--*/ $i = $i+1 /*--}}
      
    @endforeach
     

    </ul>

    <div class="tab-content responsive">
        @foreach($venueitems[0]->allitems as $vvalue)

          @if($vvalue->name == $activebox)
            <div class="tab-pane active" id="{{$vvalue->name}}"> 
          @else
            <div class="tab-pane" id="{{$vvalue->name}}">
          @endif 


             

            @foreach($itemsub[$vvalue->id] as $isub)
             <h3>{{$isub->name}}</h3>
             @foreach($venueprice[$isub->id] as $iprice)
             <div class="row venue-menu-item">

              <div class="col-md-5">
                  <h5 class="service-name">{{$iprice->name}}</h5>
                  <!--<p>Shampoo, condition, haircut, and styling product Service includes a blow dry style</p>-->
              </div>

              <div class="col-md-2 price-item">
                <i class="fa fa-inr"></i>{{$iprice->price}}
             </div>

             <!--<div class="col-md-2">
              1hr 45min
             </div> -->

             <div class="col-md-3">
                <button type="button" class="btn btn-default add-service" itemid="{{$iprice->id}}"><a data-scroll href="#myReservation"><i class="fa fa-plus-square"></i> Add Service</a></button>
             </div>

            </div>

            @endforeach

            @endforeach
            
          </div>
          

        @endforeach

    </div>



</div>

<!-- Contact and other misc details -->
<div class="col-md-4 misc-details">

  <div class="reservation" id="myReservation">  

     <div class="sub-heading">
        <h5><strong>Appointment</strong></h5>
    </div>

   

    <div class="book-services">
      
    </div>

    <div class="services-cost">

      <table class="book-services-cost">
      <tr>
        <th>Service</th>
        <th>Cost</th>
      </tr>

       <tfoot class="book-services-total">
        <tr>
          <td><strong>Total</strong></td>
          <td class="totalcost"><strong>0</strong></td>
        </tr>
      </tfoot>
    </table>   
    </div>

     <div class="container datetimepick">
      <div class="row">
          <div class='col-md-3'>
              <div class="form-group">
                  <div class='input-group date' id='datetimepicker1'>
                      <input type='text' class="form-control" id="appointdate" placeholder="Date of appointment"/>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>

              <div class="form-group">
                  <div class='input-group date' id='timepick'>
                      <input type='time' class="form-control" id="appointtime" placeholder="Time of appointment"/>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                      </span>
                  </div>
              </div>
              
               <div class="form-group">
                  <div class='input-group date' id='timepick'>
                      <input type='number' class="form-control" id="contactno" placeholder="Contact number"/>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-earphone"></span>
                      </span>
                  </div>
              </div>

              <button type="button" class="btn btn-default" id="bookappt" venueid="{{$venuedetail->id}}">Book Appointment</button>
          </div>
      </div>
    </div>

  </div>

  <div class="confirmed-appt">

      <p>Your request for the appointment has been sent.</p>
      <p>The Professional will contact you soon.</p>
      <p><a href="faq.html">Click here</a> for frequently asked questions.</p>

  </div>  
  
  <div class="time-details">
      
      <div class="sub-heading">
        <h5><strong>Business Hours</strong></h5>
      </div>
      <table class="timings">          

          <tr>
            <td>Monday</td>
            <td>10 AM to 7 PM</td>
          </tr>

          <tr>
            <td>Tuesday</td>
            <td>10 AM to 7 PM</td>
          </tr>

          <tr class="today">
            <td>Wednesday</td>
            <td>10 AM to 7 PM</td>
          </tr>          

          <tr>
            <td>Thursday</td>
            <td>10 AM to 7 PM</td>
          </tr>

           <tr>
            <td>Friday</td>
            <td>10 AM to 7 PM</td>
          </tr>

          <tr>
            <td>Saturday</td>
            <td>Closed</td>
          </tr>

          <tr>
            <td>Saturday</td>
            <td>10 AM to 5 PM</td>
          </tr>

      </table>

  </div> 

  <!-- End of Time Details -->

  <!-- Contact Details -->

    <div class="sub-heading">
          <h5><strong>Map</strong></h5>
    </div>

  <div class="address-details">
      <script>
            var map;
            function initialize() {

            var latitude = "<?php echo $venuedetail->latitude; ?>";
            var longitude = "<?php echo $venuedetail->longitude; ?>";

            var myLatlng = new google.maps.LatLng(latitude, longitude);

            var mapOptions = {
            zoom: 16,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP

            };
            map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);

            var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: '<?php echo $venuedetail->name; ?>'
            });

            }
             
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>

        <div id="map_canvas"></div>
     
  </div>


<!--
  <div class="sub-heading">
          <h5><strong>Miscellaneous</strong></h5>
  </div>

  <div class="miscl-details">     
      <table>        
        <tr>
          <td><i class="fa fa-credit-card"></i> Credit Card</td>
          <td>Accepted</td>
        </tr>

        <tr>
            <td><i class="fa fa-car"></i> Parking</td>
            <td> Available</td>
        </tr>
      </table>
  </div>

  -->


   <div class="sub-heading">
          <h5><strong>Social</strong></h5>
  </div>

  <div class="social-details">
      <H4><i class="fa fa-facebook-square"></i>
     <i class="fa fa-twitter-square"></i>
     <i class="fa fa-google-plus-square"></i></H4>
  </div>



</div>

</div>

<!-- End of Menu and Misc details -->
<div class="row">
<div class="col-md-8">
  <div class="profile-heading">
    <h3>Recommendations</h3>
  </div>

  <div class="recommendations-list">
      <table>
        @foreach($selfreviews as $selfreview)
        <tr>
          <td>
            <h5>{{$selfreview->name}}</h5>
           
          </td>
          <td>
            {{$selfreview->remarks}}
          </td>
          <td>
             {{date('d/m/Y', strtotime($selfreview->created))}}
          </td>
        </tr>

        @endforeach

      </table>    
  </div>
  </div> 

  <!-- End of Reviews -->

  <!-- Review Highlights -->

  </div>



</div>
@stop