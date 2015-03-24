<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/bootstrap.min.css" />

  <!-- Include jQuery.mmenu .css files -->
  <link type="text/css" href="{{$locUrl}}/js/mmenu/jquery.mmenu.all.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/bonsoul.css" />
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/venue.css" />
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/search-result.css" />

  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/mobile.css" />

  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/star-rating.css">

  <!-- Gallery Slider -->

  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/js/slickjs/slick.css" />
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/js/slickjs/slick-theme.css"/>

  <!-- Gallery Plugin CSS -->
  <link rel="stylesheet" href="{{$locUrl}}/js/bootstrap-gallery/blueimp-gallery.min.css">
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/js/bootstrap-gallery/bootstrap-image-gallery.css"/>

  <!-- Date Picker CSS -->
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/js/datetimepicker/bootstrap-datetimepicker.min.css"/>

  <!-- Fonts  -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  <link href="{{$locUrl}}/css/font-awesome.min.css" rel="stylesheet" type='text/css'>

  <script src="{{$locUrl}}/js/sweet-alert.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  <link rel="stylesheet" type="text/css" href="{{$locUrl}}/css/sweet-alert.css">
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
            <div class="col-md-12">
              <div class="modal-header">
                <button type="button" class="close" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body next"></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left prev"> <i class="glyphicon glyphicon-chevron-left"></i>
                  Previous
                </button>
                <button type="button" class="btn btn-primary next">
                  Next <i class="glyphicon glyphicon-chevron-right"></i>
                </button>
              </div>
            </div>
            <!--   <div class="col-md-4 comments">
            <a class="close">×</a>
            <p class="description"></p>
          </div>
          -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="loader"></div>

<div id="search-header">
  <div class="wrapper">
    <div class="row">
      <div class="mobile-menu col-xs-2">
        <i class="fa fa-bars"></i>
      </div>
      <div class="col-xs-4 col-md-3">
        <img class="searchlogo" src="{{$locUrl}}/img/Bonsoul-Logo.png" width="50" />
      </div>

      <div class="col-xs-6 col-md-6 search-box">
        <div class="row">

           <div class="col-xs-6 col-md-6">
            <input type="email" class="form-control bv-search-prof-serv" id="autocomplete-prof" placeholder="Search for professional/service">
            <div class="prof-services">
              <ul>
                @foreach($categories as $category)
              
                  <li>{{$category->name}}</li>


                @endforeach

              </ul>
            </div>
          </div>

          <div class="col-xs-4 col-md-4">
            <input type="text" name="location" id="inputLocation" class="form-control selectvenue bv-loc-input" placeholder="Location">
            <div class="curr-loc">
              <ul>
                 @foreach($localities as $locality)
                    @if ($locality->cityId == 1)
                    <li>{{$locality->name}}</li>
                    @endif
                  @endforeach
              </ul>
            </div>
          </div>
         

          <div class="col-xs-2 col-md-2">
            <button type="button" class="btn btn-default">Search</button>
          </div>

        </div>

      </div>

      <div class="col-xs-6 col-md-3 profile">

        <img class="dropdown-toggle img-circle displayimage pull-right" data-toggle="dropdown" src="{{$locUrl}}/img/user.png">

        <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="dropdownMenu">
          <li>
            <a tabindex="-1" href="#">My Appointments</a>
          </li>
          <li>
            <a tabindex="-1" href="#">Settings</a>
          </li>
          <!-- <li>
          <a tabindex="-1" href="#"></a>
        </li>
        -->
        <li class="divider"></li>
        <li>
          <a tabindex="-1" class="logout-btn">Logout</a>
        </li>
      </ul>

      <h5 class="pull-right">Jaswanth Yella</h5>

    </div>
  </div>
</div>
</div>

<nav id="bonsoul-menu">
<ul>
  <li>
    <a href="/">Home</a>
  </li>
  <li>
    <a href="/about">Location</a>
    <ul>
      <li>
        <a href="#">Hyderabad</a>
      </li>
      <li>
        <a href="#">Bengaluru</a>
      </li>
      <li>
        <a href="#">Mumbai</a>
      </li>
      <li>
        <a href="#">Pune</a>
      </li>
      <li>
        <a href="#">Delhi</a>
      </li>
      <li>
        <a href="#">Noida</a>
      </li>
    </ul>
  </li>
  <li>
    <a href="#">Login</a>
  </li>
  <li>
    <a href="#">Sign Up</a>
  </li>
</ul>
</nav>
@yield('app-content')
<div class="wrapper">

<div class="push"></div>
</div>
<!-- .wrapper -->

<footer>
<div class="footercontainer">
<div class="inner-footercontainer row">

<div class="col-md-2">
  <h3>Follow Us</h3>
  <div class="row social-logo">
    <div class="col-md-1 col-xs-1 s-logo">
      <a href="https://www.facebook.com/bonsoulindia" target="_BLANK">
        <img src="{{$locUrl}}/img/footer-fb.png" alt="Bonsoul Facebook Page" />
      </a>

      <img src="{{$locUrl}}/img/footer-insta.png" alt="Bonsoul Instagram Page" />
    </div>

    <div class="col-md-1 col-xs-1 s-logo">
      <img src="{{$locUrl}}/img/footer-twitter.png" alt="Bonsoul Twitter Page" />

      <img src="{{$locUrl}}/img/footer-pinterest.png" alt="Bonsoul Pinterest Page" />
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
  <h3>About Us</h3>
  <ul>
    <li>Help/Contact Us</li>
    <li>Careers</li>
    <li><a href="/team">Team & Culture</a></li>
    <li>Terms & Conditions</li>
  </ul>
</div>

<div class="col-md-2">
  <h3>Oops, it's Missing?</h3>
  <ul>
    <li>I have a wellness venue</li>
    <li>I know a wellness venue</li>
  </ul>
</div>

<div class="col-md-4 rvan">
  <h3>Bonsoul.com</h3>
  <p>
    Bonsoul.com is India's First Health and Beauty Network.
                      We eliminate the extensive research of calling/surfing multiple websites or references to visit a venue, which typically leaves a consumer frustrated. Bonsoul.com helps consumers take the step to discover, review and book online.
  </p>
</div>

</div>

<div class="separator">
<p>BROWSE BY LINKS</p>
</div>

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

<div class="modal fade" id="login-modal" style="overflow:hidden;">
    <div class="row login-container" style="padding: 2em 0;">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h3 class="modal-title">Login into BonSoul</h3>

        <div class="classic-login col-sm-6" style="padding-top:0;min-height:120px;">
            <div class="login-form" id="signin">
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="loginemail">
                </div>
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="password" placeholder="Password" id="loginpassword">
                </div>
                <div class="form-group" style="width:100%;">
                    <button class="btn btn-bms btn-login"><span style="font-size:12px;">Sign In</span></button>
                    <div class="p-reset-btn">
                        <a href="#p-reset-modal" data-dismiss="modal" data-toggle="modal">Forgot Password?</a>
                    </div>
                </div>
                <div class="form-toggle-info text-center">
                    <p style="font-size:13px;">Don't have a BonSoul account?</p>
                    <a href="#p-signup-modal" data-dismiss="modal" data-toggle="modal">Sign Up</a>
                </div>
            </div>
            

        </div>
        <div class="social-login col-sm-6" style="padding-top:0;min-height:150px;">
            <div class="login-row">
                <button class="btn btn-bms btn-login fb-login">
                    <i class="fa fa-facebook" ></i><span>Sign In with Facebook</span>
                </button>
            </div>
            <div class="login-row">
                <button class="btn btn-bms btn-login google-login">
                    <i class="fa fa-google-plus"></i><span>Sign In with Google</span>
                </button>
            </div>
        </div>
        
    </div>
</div>

<div class="modal fade" id="p-signup-modal">
    <div class="row login-container">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h3 class="modal-title">Reset your password</h3>

        <div class="classic-login col-sm-6" style="padding-top:0;min-height:120px;">

          <div class="login-form" id="signup">
              <div class="form-group">
                  <input class="form-control bms-txt-back" type="text" placeholder="Name" id="signupname">
              </div>
              <div class="form-group">
                  <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="signupemail">
              </div>
              <div class="form-group">
                  <input class="form-control bms-txt-back" type="password" placeholder="Password" id="signuppassword">
              </div>
               <div class="form-group">
                  <input class="form-control bms-txt-back" type="password" placeholder="Confirm password" id="confpassword">
              </div>
              <div class="form-group">
                  <button class="btn btn-bms btn-signup"><span>Sign Up</span></button>
              </div>
              <div class="form-toggle-info text-center">
                  <p>Have a BonSoul account?</p>
                  <a href="#login-modal" data-dismiss="modal" data-toggle="modal">Sign In</a>
              </div>
          </div>
        </div>

           <div class="social-login col-sm-6" style="padding-top:0;min-height:150px;">
            <div class="login-row">
                <button class="btn btn-bms btn-login fb-login">
                    <i class="fa fa-facebook" ></i><span>Sign In with Facebook</span>
                </button>
            </div>
            <div class="login-row">
                <button class="btn btn-bms btn-login google-login">
                    <i class="fa fa-google-plus"></i><span>Sign In with Google</span>
                </button>
            </div>
        </div>
       
    </div>
    </div>
</div>



<div class="modal fade" id="p-reset-modal">
    <div class="row login-container">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Close</span></button>
        <h3 class="modal-title">Reset your password</h3>

        <div class="text-center">
            <div class="login-form" id="forgot-password">
                <div class="form-group">
                    <input class="form-control bms-txt-back" type="email" placeholder="E-Mail" id="email">
                </div>
                <div class="form-group">
                    <button class="btn btn-bms btn-login">Submit</button>
                </div>
            </div>
        </div>
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

            <input id="input-id" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm" >

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
<script type="text/javascript" src="{{$locUrl}}/js/mmenu/jquery.mmenu.min.all.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="{{$locUrl}}/js/bootstrap-gallery/jquery.blueimp-gallery.min.js"></script>
<script src="{{$locUrl}}/js/bootstrap.min.js"></script>
<script src="{{$locUrl}}/js/smooth-scroll.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

<script type="text/javascript" src="{{$locUrl}}/js/slickjs/slick.min.js"></script>
<script type="text/javascript" src="{{$locUrl}}/js/responsivetabs/responsive-tabs.js"></script>
<script type="text/javascript" src="{{$locUrl}}/js/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script src="{{$locUrl}}/js/bonvogue/bv-home.js"></script>
<script type="text/javascript" src="{{$locUrl}}/js/bonvogue/bv-venue.js"></script>
<script type="text/javascript" src="{{$locUrl}}/js/bonvogue/bv-search.js"></script>

<!-- Gallery Plugin  -->

<script src="{{$locUrl}}/js/bootstrap-gallery/bootstrap-image-gallery.min.js"></script>

<script src="{{$locUrl}}/js/star-rating.min.js" type="text/javascript"></script>

<script>

  $(document).ready(function() {
            $("#bonsoul-menu").mmenu({               
               "counters": true,
               "header": {
                  "title": "Bonsoul",
                  "add": true,
                  "update": true
               }
            });

            $('.mobile-menu').click(function(){
                $("#bonsoul-menu").trigger("open.mm");
            });

            
         });

  $("#input-id").rating();

// with plugin options
$("#input-id").rating({'size':'md'});

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