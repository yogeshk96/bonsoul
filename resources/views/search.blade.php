@extends('master')

@section('content')
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

      <!--<div class="filter">
        <label>
          <input type="checkbox" value="1" id="service-checkbox">SHOW ONLY RUSH HOUR DEALS</label>
      
      </div> -->

      <div class="filter">
        <i class="fa fa-map-marker"></i>
        <label>Location</label>
        <select name="Location" id="inputLocation" class="form-control" >
        <option value="All">All</option>
          @foreach($localities as $locality)
            @if ($locality->cityId == 1)
            <option value="{{$locality->name}}">{{$locality->name}}</option>
            @endif
          @endforeach
        </select>
      </div>

      <div class="filter">
        <i class="fa fa-scissors"></i>
        <label>Service</label>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="All" class="service_checkbox" id="allservice">All</label>
        </div>
        @foreach($relatedtreatments as $relatedtreatment)
        <div class="checkbox">
          <label>
            <input type="checkbox" value="{{$relatedtreatment->name}}" class="service_checkbox">{{$relatedtreatment->name}}</label>
        </div>
        @endforeach
      </div>

      <div class="filter">
        <i class="fa fa-sort-amount-asc"></i>
        <label>Sort By</label>
        <select name="Location" id="inputSortBy" class="form-control" >
          <option value="popularity">Popularity</option>
          
        </select>
      </div>

      <div class="filter">
        <button type="button" class="btn btn-default submitfilter">Submit</button>
        <button type="button" class="btn btn-default">Reset</button>
      </div>

    </div>

    <div class="col-xs-12 col-md-8 stylist-search-container">

    @foreach($venueArr as $venue)

      <div class="stylist-result row">

        <div class="col-md-5 venue-img">
          <img src="http://d2rmoau0tbh3pz.cloudfront.net/{{$venuepicarr[$venue['id']]}}" class="img-responsive"></div>

        <div class="col-md-7 col-xs-12">
          <div class="row">
            <div class="col-md-9 col-xs-9">
              <label>{{$venue['name']}}</label>
              <p style="line-height:18px;">{{$venue['address']}}</p>
              <p></p>
            </div>

            <div class="col-md-3 col-xs-3">
            @if($rating[$venue['id']] == 0) 

              <div  id="rating">2.5</div>
            @else

              <div  id="rating">{{$rating[$venue['id']]}}</div>

            @endif

            </div>

          </div>

          
          <div class="menu-items">

          <!-- 
          @foreach($menuitems[$venue['id']] as $menuitem)

            <div class="row item">

              <div class="col-md-9">{{$menuitem['name']}}</div>

              <div class="col-md-3 item-cost">Rs. {{$menuitem['price']}}</div>

            </div>
          @endforeach
          -->

            <div class="show-menu" style="cursor:pointer;">

              <span class="label label-default">VIEW VENUE</span>

            </div>

          </div>

        </div>

      </div>

      @endforeach


    </div>

  </div>
</div>


<div class="mobile-filter-container">

      <!-- Filters -->
<!--
      <div class="filter">
        <label>
          <input type="checkbox" value="1" id="service-checkbox">SHOW ONLY RUSH HOUR DEALS</label>

      </div> -->

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
@stop