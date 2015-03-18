
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
  <h3>About Us</h3>
  <ul>
    <li>Help/Contact Us</li>
    <li>Careers</li>
    <li>Team & Culture</li>
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

</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/mmenu/jquery.mmenu.min.all.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/smooth-scroll.min.js"></script>
<script src="js/bonvogue/bv-home.js"></script>
<script src="js/jquery-autocomplete/jquery.autocomplete.min.js"></script>

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

    $('.submit').click( function(){
      if($( "#service-type" ).val()=="2"){
        swal({   title: "Coming soon",   text: "We are almost there!",   imageUrl: "img/popup-img.jpg" });
      } else if ($( "#service-type" ).val()=="3") {        
        swal({   title: "Coming soon",   text: "We are almost there!",   imageUrl: "img/vector-leg.png" });
      } else{
        window.location = "book.html";
      }
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