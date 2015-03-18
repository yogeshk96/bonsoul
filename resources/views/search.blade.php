<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="format-detection" content="telephone=no" />
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
  <!-- Include jQuery.mmenu .css files -->
  <link type="text/css" href="js/mmenu/jquery.mmenu.all.css" rel="stylesheet" />

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="css/bonsoul.css" />
  <link rel="stylesheet" type="text/css" href="css/search-result.css" />
  <link rel="stylesheet" type="text/css" href="css/mobile.css" />


  

  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
  <link href="css/font-awesome.min.css" rel="stylesheet" type='text/css'>
  <script src="js/sweet-alert.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/sweet-alert.css">
  <title>BonSoul</title>

</head>
<body>

<div class="mobile-filter">
  <i class="fa fa-filter"></i>
</div>

  
  <div id="search-header">
    <div class="wrapper">
      <div class="row">
        <div class="mobile-menu col-xs-2"> <i class="fa fa-bars"></i>
        </div>
        <div class="col-xs-4 col-md-3">
          <img class="searchlogo" src="img/Bonsoul-Logo.png" width="50" />
        </div>

        <div class="col-xs-6 col-md-6 search-box">
          <div class="row">
            <div class="col-xs-4 col-md-4">
              <input type="text" name="location" id="inputLocation" class="form-control selectvenue bv-loc-input" placeholder="Location">
              <div class="curr-loc">
                <ul>
                  <li>Hyderabad</li>
                  <li>Bangalore</li>
                  <li>Delhi</li>
                  <li>Mumbai</li>
                  <li>Ahmedabad</li>
                </ul>
              </div>
            </div>
            <div class="col-xs-6 col-md-6">
              <input type="email" class="form-control bv-search-prof-serv" id="autocomplete-prof" placeholder="Search for professional/service">
              <div class="prof-services">
                <ul>
                  <li>
                    <div class="sub-menu">
                      <p>Massage Services</p>
                      <p class="pull-right"> <i class="fa fa-arrow-circle-right"></i>
                      </p>

                    </div>

                    <ul class="sub">
                      <li>Deep Tissue Massage</li>
                      <li>Thai Massage</li>
                      <li>Ayurvedic Massage</li>
                    </ul>

                  </li>
                  <li>
                    <div class="sub-menu">
                      <p>Hair Services</p>

                      <p class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i>
                      </p>

                    </div>
                    <ul class="sub">
                      <li>Hair Cut</li>
                      <li>Hair Trim</li>
                      <li>Beard Shave</li>
                      <li>Hair Styling</li>
                    </ul>
                  </li>
                  <li>
                    <div class="sub-menu">
                      <p>Art Services</p>
                      <p class="pull-right">
                        <i class="fa fa-arrow-circle-right"></i>
                      </p>
                    </div>

                    <ul class="sub">
                      <li>Nail Art</li>
                      <li>Tattoo</li>
                      <li>Makeup</li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-xs-2 col-md-2">
              <button type="button" class="btn btn-default">Search</button>
            </div>

          </div>

        </div>

        <div class="col-xs-6 col-md-3 profile">

          <img class="dropdown-toggle img-circle displayimage pull-right" data-toggle="dropdown" src="img/user.png">

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
            <a tabindex="-1" href="#">Logout</a>
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


<div class="resultscontainer">

  <div class="row">

    <div class="col-xs-3 col-md-3 filter-container">

      <!-- Filters -->

      <div class="filter">
        <label>
          <input type="checkbox" value="1" id="service-checkbox">SHOW ONLY RUSH HOUR DEALS</label>

      </div>

      <div class="filter">
        <i class="fa fa-map-marker"></i>
        <label>Location</label>
        <select name="Location" id="inputLocation" class="form-control" >
          <option value="Banjara Hills">Banjara Hills</option>
          <option value="Jubilee Hills">Jubilee Hills</option>
        </select>
      </div>

      <div class="filter">
        <i class="fa fa-scissors"></i>
        <label>Service</label>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="All" id="service-checkbox">All</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="1" id="service-checkbox">Deep Tissue Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="2" id="service-checkbox">Thai Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="3" id="service-checkbox">Ayurvedi Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="4" id="service-checkbox">Balinese Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="5" id="service-checkbox">Head Massage</label>
        </div>

      </div>

      <div class="filter">
        <i class="fa fa-sort-amount-asc"></i>
        <label>Sort By</label>
        <select name="Location" id="inputLocation" class="form-control" >
          <option value="Banjara Hills">Popularity</option>
          <option value="Jubilee Hills">Deals</option>
          <option value="Jubilee Hills">Cost - High to Low</option>
          <option value="Jubilee Hills">Cost - Low to High</option>
        </select>
      </div>

      <div class="filter">
        <button type="button" class="btn btn-default">Submit</button>
        <button type="button" class="btn btn-default">Reset</button>
      </div>

    </div>

    <div class="col-xs-12 col-md-8 stylist-search-container">

      <div class="stylist-result row">

        <div class="col-md-5 venue-img">
          <img src="images/01.jpg" class="img-responsive"></div>

        <div class="col-md-7 col-xs-12">
          <div class="row">
            <div class="col-md-9 col-xs-9">
              <label>Toni & Guy</label>
              <p>Road No. 12, Banjara Hills</p>
              <p></p>
            </div>

            <div class="col-md-3 col-xs-3">
              <div  id="rating">4.5</div>

            </div>

          </div>

          <div class="menu-items">

            <div class="row item">

              <div class="col-md-9">Deep Tissue Massage</div>

              <div class="col-md-3 item-cost">Rs. 2000</div>

            </div>

            <div class="row item">

              <div class="col-md-9">Thai Massage</div>

              <div class="col-md-3 item-cost">Rs. 5000</div>

            </div>

            <div class="row item">

              <div class="col-md-9">Head Massage</div>

              <div class="col-md-3 item-cost">Rs. 500</div>

            </div>

            <div class="show-menu">

              <span class="label label-default">SHOW MENU</span>

            </div>

          </div>

        </div>

      </div>

      <!-- Venue 02 -->

      <div class="stylist-result row">

        <div class="col-md-5 venue-img">
          <img src="images/01.jpg" class="img-responsive"></div>

        <div class="col-md-7 col-xs-12">
          <div class="row">
            <div class="col-md-9 col-xs-9">
              <label>Toni & Guy</label>
              <p>Road No. 12, Banjara Hills</p>
              <p></p>
            </div>

            <div class="col-md-3 col-xs-3">
              <div  id="rating">4.5</div>

            </div>

          </div>

          <div class="menu-items">

            <div class="row item">

              <div class="col-md-9">Deep Tissue Massage</div>

              <div class="col-md-3 item-cost">Rs. 2000</div>

            </div>

            <div class="row item">

              <div class="col-md-9">Thai Massage</div>

              <div class="col-md-3 item-cost">Rs. 5000</div>

            </div>

            <div class="row item">

              <div class="col-md-9">Head Massage</div>

              <div class="col-md-3 item-cost">Rs. 500</div>

            </div>

            <div class="show-menu">

              <span class="label label-default">SHOW MENU</span>

            </div>

          </div>

        </div>

      </div>

      <!-- End of venue 02 -->

    </div>

  </div>
</div>


<div class="mobile-filter-container">

      <!-- Filters -->

      <div class="filter">
        <label>
          <input type="checkbox" value="1" id="service-checkbox">SHOW ONLY RUSH HOUR DEALS</label>

      </div>

      <div class="filter">
        <i class="fa fa-map-marker"></i>
        <label>Location</label>
        <select name="Location" id="inputLocation" class="form-control" >
          <option value="Banjara Hills">Banjara Hills</option>
          <option value="Jubilee Hills">Jubilee Hills</option>
        </select>
      </div>

      <div class="filter">
        <i class="fa fa-scissors"></i>
        <label>Service</label>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="All" id="service-checkbox">All</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="1" id="service-checkbox">Deep Tissue Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="2" id="service-checkbox">Thai Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="3" id="service-checkbox">Ayurvedi Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="4" id="service-checkbox">Balinese Massage</label>
        </div>

        <div class="checkbox">
          <label>
            <input type="checkbox" value="5" id="service-checkbox">Head Massage</label>
        </div>

      </div>

      <div class="filter">
        <i class="fa fa-sort-amount-asc"></i>
        <label>Sort By</label>
        <select name="Location" id="inputLocation" class="form-control" >
          <option value="Banjara Hills">Popularity</option>
          <option value="Jubilee Hills">Deals</option>
          <option value="Jubilee Hills">Cost - High to Low</option>
          <option value="Jubilee Hills">Cost - Low to High</option>
        </select>
      </div>

      <div class="filter">
        <button type="button" class="btn btn-default">Submit</button>
        <button type="button" class="btn btn-default">Reset</button>
      </div>

    </div>

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
              <img src="img/footer-fb.png" alt="Bonsoul Facebook Page" />
            </a>

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

</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/mmenu/jquery.mmenu.min.all.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smooth-scroll.min.js"></script>
<script src="js/bonvogue/bv-home.js"></script>
<script src="js/bonvogue/bv-search.js"></script>
<script src="js/jquery-autocomplete/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.min.js"></script>
<script>

    // $('#service-checkbox').click(function(){      
    //     // if($(this).val == 'All'){
    //       alert('Hello');
    //     // }      
    // });

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

    smoothScroll.init({
    speed: 1500, // Integer. How fast to complete the scroll in milliseconds
    easing: 'easeInOutCubic', // Easing pattern to use
    updateURL: true, // Boolean. Whether or not to update the URL with the anchor hash on scroll
    offset: 0, // Integer. How far to offset the scrolling anchor location in pixels
    callbackBefore: function ( toggle, anchor ) {}, // Function to run before scrolling
    callbackAfter: function ( toggle, anchor ) {} // Function to run after scrolling
  });
</script>
</body>
</html>