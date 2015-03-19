  @extends('homeheader')
  <!-- <h3>INDIA'S FIRST WELLNESS PLATFORM</h3>
    -->
    @section('content')

    
    <h2>
        FIND AND BOOK THE BEST SPAS, SALONS & FITNESS CENTRES AROUND YOU
      </h2>
    <div class="bvsearch-container">

      <div class="service-search row">

        <div class="col-md-4 bv-search-box">
          <input type="text" placeholder="Search for service" class="form-control bv-input bv-search-prof-serv" required="required" id="autocomplete-prof">

          <div class="prof-services">
            <ul>
              <li>All Treatments</li>
              @foreach($categories as $category)
              
              <li>{{$category->name}}</li>


              @endforeach
              
            </ul>
          </div>

        </div>

        <div class="col-md-4 bv-search-box">
          <input type="text" placeholder="Location" class="form-control bv-input bv-loc-input" required="required" >
          <div class="curr-loc">
            <ul>
              <li class="popular">Near Me</li>
              @foreach($localities as $locality)
              @if ($locality->cityId == 1)
              <li>{{$locality->name}}</li>
              @endif
              @endforeach
            </ul>
          </div>
        </div>

        <div class="col-md-4 bv-search-box">
          <button type="button" class="btn">SEARCH</button>
        </div>
      </div>

      <div class="venue-search row">

        <div class="col-md-8 bonsoulvenue-search">
          <input type="text" placeholder="Search for venue" class="form-control bv-input venue-input-search" required="required" id="autocomplete-prof"></div>

        <div class="col-md-4 bv-search-box">
          <button type="button" class="btn">SEARCH</button>
        </div>

      </div>

      <div class="bv-search-bottom pull-right">
        <h3>Search by name</h3>
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

<div class="bv-mid-container row">

  <div class="col-xs-5 col-md-4 bonmid-img">
    <img src="img/bonvogue-stylist-search.png" alt="" ></div>

  <div class="col-xs-7 col-md-8 bv-mid-container-text">
    <p>
      <span class="fa-stack fa-1x">
        <i class="fa fa-circle fa-stack-2x"></i> <strong class="fa-stack-1x bullet-text">1</strong>
      </span>
      Search for a spa, salon or fitness venue.
    </p>
    <p>
      <span class="fa-stack fa-1x">
        <i class="fa fa-circle fa-stack-2x"></i> <strong class="fa-stack-1x bullet-text">2</strong>
      </span>
      Select a treatment
    </p>
    <p>
      <span class="fa-stack fa-1x">
        <i class="fa fa-circle fa-stack-2x"></i>
        <strong class="fa-stack-1x bullet-text">3</strong>
      </span>
      Select a time and date
    </p>
    <p>
      <span class="fa-stack fa-1x">
        <i class="fa fa-circle fa-stack-2x"></i>
        <strong class="fa-stack-1x bullet-text">4</strong>
      </span>
      Make payment at the venue
    </p>
  </div>

</div>

<div class="top-sections">

  <div class="recommend-heading">
    <div class="separator">
      <p>Recommended For You</p>
    </div>

  </div>

  <div class="row">

    <div class="col-xs-4 col-md-4 top-card">

      <div class="section-heading">
        <h3>Top 5 Treatments</h3>
        <!-- <div class="separator">
        <p>Hyderabad</p>
      </div>
      -->
      <hr />
    </div>

    <div class="section-list">

      @foreach($toptreatarr as $toptreat)
      <div class="row section-item">

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
          <img src="img/AZBiltmorePedicure.jpg" class="img-responsive" />
        </div>

        <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
          <h3>{{$toptreat['name']}}</h3>
         <!-- <span>available in 574 salons</span> -->
        </div>

      </div>
      @endforeach

    </div>

    <hr />

    <h4 class="btm-txt">
      <a href="#">View all treatments</a>
    </h4>

  </div>

  <div class="col-xs-4 col-md-4 top-card hour-card">

    <div class="section-heading">
      <h3>SUPRISE ME</h3>
      <!-- <div class="separator">
      <p>Hyderabad</p>
    </div>
    -->
    <hr />
  </div>

  <div class="section-list">

    @foreach($randomvenues as $randomvenue)
    <div class="row section-item">

      <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <img src="img/AZBiltmorePedicure.jpg" class="img-responsive" />
      </div>

      <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
        <h3>{{$randomvenue->name}}</h3>
       <!-- <span>available in 574 salons</span> -->
      </div>

    </div>
    @endforeach

    

  </div>

  <hr />

  <h4 class="btm-txt">
    <a href="#">View all deals</a>
  </h4>

</div>

<div class="col-xs-4 col-md-4 top-card">

  <div class="section-heading">
    <h3>Top 5 Venues</h3>
    <!-- <div class="separator">
    <p>Hyderabad</p>
  </div>
  -->
  <hr />
</div>

<div class="section-list">

@foreach($topvenues as $topvenue)

  <div class="row section-item">

    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
      <img src="img/AZBiltmorePedicure.jpg" class="img-responsive" />
    </div>

    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
      <h3>{{$topvenue->name}}</h3>
      <!--<span>available in 574 salons</span>-->
    </div>

  </div>

@endforeach

</div>

<hr />

<h4 class="btm-txt">
  <a href="#">View all venues</a>
</h4>

</div>

</div>

</div>

<div class="wrapper">

<div class="push"></div>
</div>
<!-- .wrapper -->
@stop