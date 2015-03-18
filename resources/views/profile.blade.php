<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
        <meta name="format-detection" content="telephone=no" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="css/bonvogue.css" />
        <link rel="stylesheet" type="text/css" href="css/search-result.css" />
        <link rel="stylesheet" type="text/css" href="css/profile.css" />

        <!-- Gallery Slider -->

        <link rel="stylesheet" type="text/css" href="js/slickjs/slick.css" />
        <link rel="stylesheet" type="text/css" href="js/slickjs/slick-theme.css"/>

        <!-- Gallery Plugin CSS -->
        <link rel="stylesheet" href="js/bootstrap-gallery/blueimp-gallery.min.css">
        <link rel="stylesheet" type="text/css" href="js/bootstrap-gallery/bootstrap-image-gallery.css"/>

        <!-- Date Picker CSS -->
        <link rel="stylesheet" type="text/css" href="js/datetimepicker/bootstrap-datetimepicker.min.css"/>

        <!-- Fonts  -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
        <link href="css/font-awesome.min.css" rel="stylesheet" type='text/css'>


        <script src="js/sweet-alert.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/sweet-alert.css">
    <title>BonSoul</title>
    
  </head>
<body>
    <!-- Image Gallery lightbox -->
<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>    
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="row">
                <div class="col-md-12">  <div class="modal-header">
                                      <button type="button" class="close" aria-hidden="true">&times;</button>
                                      <h4 class="modal-title"></h4>
                                  </div>
                                  <div class="modal-body next"></div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default pull-left prev">
                                          <i class="glyphicon glyphicon-chevron-left"></i>
                                          Previous
                                      </button>
                                      <button type="button" class="btn btn-primary next">
                                          Next
                                          <i class="glyphicon glyphicon-chevron-right"></i>
                                      </button>
                                  </div></div>
                                <!--   <div class="col-md-4 comments">
                                    <a class="close">×</a>
                                      <p class="description"></p>
                                  </div> -->
                  </div>
            </div>
        </div>
    </div>
</div>


<div class="loader"></div>
<header id="search-header">
  <div class="wrapper">
      <div class="row">
        <div class="col-xs-3 col-md-3">
           <img class="searchlogo" src="img/Bonsoul-Logo.png" width="50" />
        </div>

        <div class="col-xs-6 col-md-5 search-box">
          <form class="form-inline">
             <div class="form-group">

                <input type="text" name="location" id="inputLocation" class="form-control selectvenue" value="Hyderabad" >
                <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Search for stylist or service">                

                <button type="button" class="btn btn-default">Search</button>
             </div>
          </form>
        </div>

        <div class="col-xs-3 col-md-3 profile">
            <!-- <a class="dropdown-toggle pull-right" data-toggle="dropdown" href="#"><i class="fa fa-bars"></i></a> -->

            <img class="dropdown-toggle img-circle displayimage pull-right" data-toggle="dropdown" src="img/user.png">

             <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
              <li><a tabindex="-1" href="#">My Appointments</a></li>
              <li><a tabindex="-1" href="#">Settings</a></li>
              <!-- <li><a tabindex="-1" href="#"></a></li> -->
              <li class="divider"></li>
              <li><a tabindex="-1" href="#">Logout</a></li>
            </ul>

            <h5 class="pull-right">Jaswanth Yella</h5>

           
        </div>


      </div>
  </div>
</header>

<div class="profile-container">
    
  <div class="row">

    <div class="col-md-3">
      <img src="img/user.jpg" width="250">
    </div>

    <div class="col-md-6 details">    
      <h3>Jessica Saltzer</h3>
      <h4>STYLIST | HEADLIGHTS HAIR STUDIO</h4>
      <button type="button" class="btn btn-default"  data-toggle="modal" data-target="#recommendation-modal">Recommend</button>
      <button type="button" class="btn btn-default"><a data-scroll href="#myTab">Book Me</a></button>

      <p>Hello and thank you for stopping by! My name is Jessica, my game is beauty.
My specailty is hair and makeup artistry, and consultations are free. Please call me or book online to set up an appointment, I can't wait to meet you.
-Jessica Saltzer
Professional Hair & Makeup</p>
      
      <div class="row recomm-fav-container">
        <p class="col-md-4"><i class="fa fa-envelope-o"> 34 Recommendations</i></p>
        <p class="col-md-4 favcount"><i class="fa fa-heart-o fav"></i> 45</p>
      </div>


    </div>

  </div>

<div class="profile-heading">
  <h3>Gallery</h3>
</div>

  <div class="img-portfolio" id="links">
     

      <div class="portfo-item">
        <a href="img/AZBiltmorePedicure.jpg" title="Banana" data-description="Lorem Ipsum is simply dummy text of the printing and typesetting industry." data-fav="34" data-comments="52" data-gallery>
            <img src="img/AZBiltmorePedicure.jpg" alt="Banana">
        </a>         

          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>

      <div class="portfo-item">
          <a href="img/bg.jpg" title="Banana" data-gallery>
            <img src="img/bg.jpg" alt="Banana">
        </a>

          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>
            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>

      <div class="portfo-item">
          <a href="img/bg2.jpeg" title="Banana" data-gallery>
            <img src="img/bg2.jpeg" alt="Banana">
          </a>



          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>
            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>

      <div class="portfo-item">
          <a href="img/AZBiltmorePedicure.jpg" title="Banana" data-gallery>
            <img src="img/AZBiltmorePedicure.jpg" alt="Banana">
        </a>

          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>
            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>

      <div class="portfo-item">
          <a href="img/AZBiltmorePedicure.jpg" title="Banana" data-gallery>
            <img src="img/AZBiltmorePedicure.jpg" alt="Banana">
        </a>

          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>
            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>

      <div class="portfo-item">
          <a href="img/AZBiltmorePedicure.jpg" title="Banana" data-gallery>
            <img src="img/AZBiltmorePedicure.jpg" alt="Banana">
        </a>

          <ul class="list-inline fav-comment-buttons">
            <li><a href="#"><p><i class="fa fa-heart"> 34</i></p></a>
            </li>
            <li><a href="#"><p><i class="fa fa-comments"> 52</i></p></a>
            </li>
            
          </ul>
          <!-- <i class="fa fa-heart-o"></i> -->
      </div>
  </div>



<div class="profile-heading">
  <h3>Menu</h3>
</div>

<div class="row menu-details">
<div class="col-md-8">
    <ul class="nav nav-tabs responsive" id="myTab">
      <li class="active"><a href="#hair">Hair Services</a></li>
      <li><a href="#bridalmakeup">Bridal Services</a></li>
      <li><a href="#makeup">MakeUp Services</a></li>
      <li><a href="#tattoo">Tattoo Services</a></li>
      <li><a href="#tattoo">Tattoo Services</a></li>

    </ul>

    <div class="tab-content responsive">
          <div class="tab-pane active" id="hair">

          <table class="stylist-menu">
            <tr>
              <td>
                <span class="td-val">Women's Haircut</span>
                <h5>Women's Haircut</h5>
                <p class="desc">Shampoo, condition, haircut, and styling product Service includes a blow dry style</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 500
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>

             <tr>
              <td>
              <span class="td-val">Bang Trim</span>
                <h5>Bang Trim</h5>
                <p class="desc">Complimentary with cuts by Jessica</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 400
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>

             <tr>
              <td>
              <span class="td-val">Womans Haircut - II</span>
                <h5>Womans Haircut</h5>
                <p class="desc">Shampoo, condition, haircut, and styling product Service includes a blow dry style</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 300
              </td>

              <td>
              <span class="td-val">55</span>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>

             <tr>
              <td>
              <span class="td-val">Womans Haircut - III</span>
                <h5>Womans Haircut</h5>
                <p class="desc">Permanent color is applied from scalp to ends. Service is good for altering virgin haircolor to desired shade and reflective ... (more)</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 100
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>
          </table>

        </div>

        <div class="tab-pane" id="bridalmakeup">
            
            <table class="stylist-menu">
            <tr>
              <td>
                <h5>Bridal Consultation</h5>
                <p class="desc"></p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 500
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>

             <tr>
              <td>
                <h5>Bridal Style</h5>
                <p class="desc">Complimentary with cuts by Jessica</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 500
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>
            

             <tr>
              <td>
                <h5>Bridal Makeup</h5>
                <p class="desc">Permanent color is applied from scalp to ends. Service is good for altering virgin haircolor to desired shade and reflective ... (more)</p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 500
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>
          </table>

        </div>
        <div class="tab-pane" id="makeup">
            
          <table class="stylist-menu">
            <tr>
              <td>
                <h5>Brow Tweeze</h5>
                <p class="desc"></p>
              </td>

              <td>
                <i class="fa fa-inr"></i> 500
              </td>

              <td>
                1hr 45min
              </td>

              <td>
                <button type="button" class="btn btn-default add-service" value="exampleservice"><i class="fa fa-plus-square"></i> Add Service</button>
              </td>
            </tr>

             
          </table>

        </div>
        <div class="tab-pane" id="tattoo">...content...</div>
    </div>



</div>

<!-- Contact and other misc details -->
<div class="col-md-4 misc-details">

  <div class="reservation">  

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
                      <input type='text' class="form-control" placeholder="Date of appointment"/>
                      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                      </span>
                  </div>
              </div>

              <div class="available-timings">

                  

              </div>

              <button type="button" class="btn btn-default" id="bookappt">Book Appointment</button>
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
          <h5><strong>Contact</strong></h5>
    </div>

  <div class="address-details">     
      <h5><strong>Toni & Guy</strong></h5>
      <p>Road Number 12, Banjara Hills, Hyderabad</p>
  </div>



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
        <tr>
          <td>
            <h5>Ashley J</h5>
           
          </td>
          <td>
            "She makes wonderful custom products too!"
          </td>
          <td>
             25/01/2015
          </td>
        </tr>

        <tr>
          <td>
            <h5>Ashley J</h5>
            
          </td>
          <td>
            "Jessica really listened to and understood what I wanted. She didn't rush and made sure I was happy with my haircut."
          </td>
          <td>25/01/2015</td>
        </tr>


        <tr>
          <td>
            <h5>Ashley J</h5>
            
          </td>
          <td>
            "Always excited to come into the studio to get bleachified/pinkified. Amazing color and company. You're the best Jessica =)"
          </td>
          <td>25/01/2015</td>
        </tr>

      </table>    
  </div>
  </div> 

  <!-- End of Reviews -->

  <!-- Review Highlights -->

  </div>



</div>


 <div class="wrapper">

      <div class="push"></div>
  </div> <!-- .wrapper -->
 
  <footer>
      <div class="footercontainer">
          <div class="inner-footercontainer row">

              <div class="col-md-2">
                  <h3>Follow Us</h3>
                  <div class="row social-logo">
                        <div class="col-md-1 col-xs-1 s-logo">
                           <a href="https://www.facebook.com/bonsoulindia" target="_BLANK"><img src="img/footer-fb.png" alt="Bonsoul Facebook Page" /></a>

                            <img src="img/footer-insta.png" alt="Bonsoul Instagram Page" />
                        </div>

                        <div class="col-md-1 col-xs-1 s-logo">
                            <img src="img/footer-twitter.png" alt="Bonsoul Twitter Page" />

                            <img src="img/footer-pinterest.png" alt="Bonsoul Pinterest Page" />
                        </div>
                  </div>
              </div>

               <div class="col-md-2">
                  <h3>Find More</h3>
                  <ul>
                    <li>Sign up to news letter</li>
                    <li>Blog</li>
                    <li>Press</li>                    
                  </ul>
              </div>               

               <div class="col-md-2">
                  <h3>Our Services</h3>
                  <ul>
                    <li>Verify a voucher</li>
                    <li>List your business</li>
                    <li>Sign up as therapist</li>                    
                  </ul>
              </div>

               <div class="col-md-2">
                  <h3>About Us</h3>
                  <ul>
                    <li>Help/Contact Us</li>
                    <li>Careers</li>
                    <li>Team</li>
                    <li>Culture</li>
                    <li>Terms & Conditions</li>
                  </ul>
              </div>

              <div class="col-md-4 rvan">
                  <h3>Bonsoul.com</h3>
                  <p>Bonsoul.com is India's First Health and Beauty Network.
                      We eliminate the extensive research of calling/surfing multiple websites or references to visit a venue, which typically leaves a consumer frustrated. Bonsoul.com helps consumers take the step to discover, review and book online.</p>                  
              </div>

          </div>

          <div class="separator"><p>BROWSE BY LINKS</p></div>

          <div class="inner-footercontainer-2 row">
              <div class="col-md-2">
                  <h3>Massage</h3>
                  <ul>                    
                    <li>Massage Hyderabad</li>
                    <li>Massage Bengaluru</li>
                    <li>Massage Mumbai</li>                    
                    <li>Massage Pune</li> 
                    <li>Massage Chennai</li> 
                    <li>Massage Kolkata</li> 
                    <li>Massage Delhi</li> 
                    <li>Massage Gurgaon</li> 
                    <li>Massage Noida</li>
                  </ul>
              </div>

              <div class="col-md-2">
                  <h3>Hair style</h3>
                  <ul>
                    <li>Hair style Hyderabad</li>
                    <li>Hair style Bengaluru</li>
                    <li>Hair style Mumbai</li>                    
                    <li>Hair style Pune</li> 
                    <li>Hair style Chennai</li> 
                    <li>Hair style Kolkata</li> 
                    <li>Hair style Delhi</li> 
                    <li>Hair style Gurgaon</li> 
                    <li>Hair style Noida</li>
                  </ul>
              </div>

              <div class="col-md-2">
                  <h3>Manicure</h3>
                  <ul>
                    <li>Manicure Hyderabad</li>
                    <li>Manicure Bengaluru</li>
                    <li>Manicure Mumbai</li>                    
                    <li>Manicure Pune</li> 
                    <li>Manicure Chennai</li> 
                    <li>Manicure Kolkata</li> 
                    <li>Manicure Delhi</li> 
                    <li>Manicure Gurgaon</li> 
                    <li>Manicure Noida</li>
                  </ul>
              </div>

              <div class="col-md-2">
                  <h3>Pedicure</h3>
                  <ul>
                    <li>Pedicure Hyderabad</li>
                    <li>Pedicure Bengaluru</li>
                    <li>Pedicure Mumbai</li>                    
                    <li>Pedicure Pune</li> 
                    <li>Pedicure Chennai</li> 
                    <li>Pedicure Kolkata</li> 
                    <li>Pedicure Delhi</li> 
                    <li>Pedicure Gurgaon</li> 
                    <li>Pedicure Noida</li>
                  </ul>
              </div>

              <div class="col-md-2">
                  <h3>SPAS & SALONS</h3>
                  <ul>
                    <li>SPAS & SALONS Hyderabad</li>
                    <li>SPAS & SALONS Bengaluru</li>
                    <li>SPAS & SALONS Mumbai</li>                    
                    <li>SPAS & SALONS Pune</li> 
                    <li>SPAS & SALONS Chennai</li> 
                    <li>SPAS & SALONS Kolkata</li> 
                    <li>SPAS & SALONS Delhi</li> 
                    <li>SPAS & SALONS Gurgaon</li> 
                    <li>SPAS & SALONS Noida</li>
                  </ul>
              </div>                           

              <div class="col-md-2">
                  <h3>Stylists</h3>
                  <ul>
                    <li>Stylists Hyderabad</li>
                    <li>Stylists Bengaluru</li>
                    <li>Stylists Mumbai</li>                    
                    <li>Stylists Pune</li> 
                    <li>Stylists Chennai</li> 
                    <li>Stylists Kolkata</li> 
                    <li>Stylists Delhi</li> 
                    <li>Stylists Gurgaon</li> 
                    <li>Stylists Noida</li>
                  </ul>
              </div>

          </div>
          <div class="company">
            <h5>&copy; Rvan Software Solutions Pvt Ltd</h5>
          </div>

          
      </div>


  </footer>

  <div class="modal fade" id="recommendation-modal">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Recommend your favorite professional</h4>
        </div>
        
        <div class="modal-body">
        
          

          <div class="row">
            <div class="col-md-12">
              
              <div class="form-group no-margin">
                <label for="field-7" class="control-label">Your precious words goes here</label>
                
                <textarea class="form-control autogrow" id="field-7" placeholder="Write something about the service" height="250px">Wow, what an amazing professional. I'm impressed!</textarea>
              </div>  
              
            </div>
          </div>        
        
          
          
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info">Send</button>
        </div>
      </div>
    </div>
  </div>




  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>   
   <script src="js/bootstrap-gallery/jquery.blueimp-gallery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/smooth-scroll.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
  
  <script type="text/javascript" src="js/slickjs/slick.min.js"></script>
  <script type="text/javascript" src="js/responsivetabs/responsive-tabs.js"></script>
  <script type="text/javascript" src="js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="js/bonvogue/bv-profile.js"></script>

  <!-- Gallery Plugin  -->
 
  <script src="js/bootstrap-gallery/bootstrap-image-gallery.min.js"></script>

  <script>

   $(window).load(function() {
      $(".loader").fadeOut("slow");
    });

  $( '#myTab a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );

      $( '#moreTabs a' ).click( function ( e ) {
        e.preventDefault();
        $( this ).tab( 'show' );
      } );


    ( function( $ ) {         
          fakewaffle.responsiveTabs( [ 'xs', 'sm' ] );
      } )( jQuery );

    $('.img-portfolio').slick({
      infinite: false,
      slidesToShow: 4,
      slidesToScroll: 4
    });
        

    smoothScroll.init({
      speed: 1500, // Integer. How fast to complete the scroll in milliseconds
      easing: 'easeInOutCubic', // Easing pattern to use
      updateURL: true, // Boolean. Whether or not to update the URL with the anchor hash on scroll
      offset: 100, // Integer. How far to offset the scrolling anchor location in pixels
      callbackBefore: function ( toggle, anchor ) {}, // Function to run before scrolling
      callbackAfter: function ( toggle, anchor ) {} // Function to run after scrolling
    });
</script>
</body>
</html>