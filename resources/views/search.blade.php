@extends('app')

@section('app-content')


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
        <select name="Location" id="inputLocation" class="form-control inputLocation" >
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

      <!-- <div class="filter">
        <i class="fa fa-sort-amount-asc"></i>
        <label>Sort By</label>
        <select name="Location" id="inputSortBy" class="form-control" >
          <option value="popularity">Popularity</option>
          
        </select>
      </div> -->

      <div class="filter">
        <button type="button" class="btn btn-default submitfilter">Submit</button>
        <button type="button" class="btn btn-default">Reset</button>
      </div>

    </div>

    <div class="col-xs-12 col-md-8 stylist-search-container">

    @foreach($venueArr as $venue)

      <div class="stylist-result row">

        <div class="col-md-5 venue-img">
          <img src="{{$cdnUrl}}{{$venuepicarr[$venue['id']]}}" class="img-responsive"></div>

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

            <a href="{{$locUrl}}/{{$city}}/{{$venue['id']}}/{{$venuenamearr[$venue['id']]}}" style="text-decoration:none;">
            <div class="show-menu">

              <span class="label label-default">VIEW VENUE</span>

            </div>
            </a>

          </div>

        </div>

      </div>

      @endforeach

      @if(count($venueArr) == 0)

        <h3>No results found.</h3>

      @endif


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
        <select name="Location" class="form-control" >
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
            <input type="checkbox" value="All" class="service_checkbox" id="allservice">All
          </label>
        </div>
        @foreach($relatedtreatments as $relatedtreatment)
        <div class="checkbox">
          <label>
            <input type="checkbox" value="{{$relatedtreatment->name}}" class="service_checkbox">{{$relatedtreatment->name}}</label>
        </div>
        @endforeach

      </div>

      <!--<div class="filter">
        <i class="fa fa-sort-amount-asc"></i>
        <label>Sort By</label>
        <select name="Location" id="inputLocation" class="form-control" >
          <option value="Banjara Hills">Popularity</option>
          <option value="Jubilee Hills">Cost - High to Low</option>
          <option value="Jubilee Hills">Cost - Low to High</option>
        </select>
      </div> -->

      <div class="filter">
        <button type="button" class="btn btn-default submitfilter">Submit</button>
        <button type="button" class="btn btn-default">Reset</button>
      </div>

    </div>

<div class="wrapper">

  <div class="push"></div>
</div>
<!-- .wrapper -->
@stop