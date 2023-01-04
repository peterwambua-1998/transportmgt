@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">

<style>
  ::-webkit-scrollbar {
    display: none;
    }

    .pcoded-inner-content {
        padding: 0 !important;
        height: 92vh !important;
       
    }

    .main-body {
      height: 100%;
    }
    .outer-div {
       height: 100%;
        
        background: #d3d3d3;
    }

    .outer-div .row {
      height: 100% !important;
    }
    .dataTables_wrapper .dataTables_filter {
        float: none;
        text-align: center;
    }

    .vihcleGrid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        justify-content: end;
        padding-left: 20px;
        padding-right: 3%;
    }

    a {
        color: #fff;

    }

    a:hover {
        color: #fff;
    }

    .btn-create {
        background: #0071f3
    }

    .vihcleGrid .btn-create:hover {
        background: #012549;
    }
    
    .table-title-vehicle {
        font-size:18px;
        font-weight: 500;
        margin-bottom: 25px;
        
    }

    .span-delete {
        margin-right: 2vw;
        font-size: 20px;
    }

    #map {
        height: 100%;
        width: 100%;
        border-radius: 10px;
    }

    .div-map {
        height: 80vh;
        width: 100%;
        
    }

    .vehicle-details {
      background: #fff;
      height: 100%;
      border-top  : 10px solid #0162d1;
    }

    .vehicle-details-header {
      box-shadow: 0px 3px 10px 0px rgba(0, 0, 255, .2);
      height: 7vh;
      padding-left: 2%;
      padding-top: 2%;
      align-items: center;
      font-size: 20px;
    }

    .vhl-title {
      font-weight: bold;
      font-size: 15px;
      padding-left: 5%;
    }
    .vhl-plate {
      letter-spacing: 1px;
      font-weight: 100;
      padding-left: 5%;

    }
    

    .vehicle-details-image {
      height: 40vh;
      margin: 5%;

      
      
    }

    .vehicle-details-image img {
      border-radius: 10px;
    }

    .vehicle-details-grid {
      display: grid;
      grid-template-columns: 40% 35% 1fr;
      margin: 5%;
      
      padding-top: 25px;
      line-height: 1px;
      
      border-radius: 10px;
    }

    .speed {
      font-weight: bold;
      font-size: 18px;
    }

    

    .more-details .outer {
      
      height: 20vh;
      
    }

    
      
     .outer-row {
        padding: 2%;
        margin: 2%;
        border-radius: 10px;
        
        height: 10vh;
     }

     .img-outer {
      
       
     }
     .img-outer .image-outer-img {
      height: 80%;
      width: 65%;

     }

     .image-cover img{
      height: 100%;
      width: 50%;
     }

     .outer-row-text {
      line-height: 2px !important;
      margin-left: -16%;
      margin-top: 30px;
     }
    

     .custom-map-control-button {
        background-color: #fff;
        border: 0;
        border-radius: 2px;
        box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
        margin: 10px;
        padding: 0 0.5em;
        font: 400 18px Roboto, Arial, sans-serif;
        overflow: hidden;
        height: 40px;
        cursor: pointer;
      }
      .custom-map-control-button:hover {
        background: rgb(235, 235, 235);
      }

      .details {
        display: none
      }

      .detailsall {
        display: block;
        
      }


      .my-row {
        display: grid;
        grid-template-columns: 20% 1fr;
      }

      .driver-details-text div{
        position: relative;
        left: -20px;
        line-height: 2px;
        padding-top: 5px;
        
      }

      .driver-details-text div p {
        font-size: 15px;
      }

      .add-driver {
        position: absolute;
        bottom: 10px;
        width: 36%;
        left: 10%;
        
      }

      .add-driver-two {
        position: absolute;
        right: 10%;
        bottom: 10px;
        width: 36%;
      }
      .show-all {
        border: none;
        background: #4099ff;
        color: #fff;
        font-size: 15px;
      }

      .img-outer-img {
        height: 80%;
        width: 65%;
      }
    @media only screen and (max-width: 500px) and (orientation: portrait) {

      .pcoded-inner-content {
        padding: 0 !important;
        height: fit-content !important;
       
    }
      ::-webkit-scrollbar {
        display: block;
      }
      .details {
        margin: 2%;
        font-size: 12px;
      }
      .vehicle-details-image {
        display: none
      }

      .vehicle-details {
        border-radius: 10px;
        height: fit-content;
      }

      

      .speed {
        font-size: 12px
      }
      .speed i{
        display: none;
      }

      .outer-row {
        height: max-content;
        
      }

      .vehicle-details-header {
        font-size: 15px;
      }

      .image-cover {
        width: 30%;
      }
      .outer-row .image-outer-img {
        
        width: 20vw !important;
      }
      .outer-row-text {
        margin-left: 0px;
      }
      .detailsall {
        height: max-content !important;
      }
      
      .vehicle-details {
        height: max-content !important;
        text-align: left;
      }

      .add-driver {
        display: none
      }

      .add-driver-two {
        display: none
      }

      
      .img-outer {
        width: 100% !important;
 
      }

      .show-all {
        font-size: 10px;
        padding: 5px;
        border-radius: 5px;
      }
    }
</style>
@endsection
@section('content')
<div class="outer-div">

  <div class="row">
    <div class="col-xl-8 col-md-8 col-sm-12">
        <div class="div-map p-2">
            <div id="map"></div>
           
        </div>
        
    </div>

    <div class="col-xl-4 col-md-4 col-sm-12 details">
      <div class="vehicle-details">
        <div>
          <p class="vehicle-details-header">Route Details</p>
        </div>

        <div style="line-height: 9px;">
          <p class="vhl-title">Vehicle Title</p>
          <p class="vhl-plate">KBX 124D</p>
        </div>

        <div class="vehicle-details-image">
          <img src="{{ asset('images/bus2.jpg') }}" alt="" style="height: 100%; width: 100%">
        </div>

        <div class="vehicle-details-grid">
          <div>
            <p style="font-weight: 100">speed</p>
            <p class="speed">120 km/h </p>
          </div>
          <div>
            <p  style="font-weight: 100">Altitude</p>
            <p  class="speed">208m </p>
          </div>
          <div>
            <p style="font-weight: 100">Direction</p>
            <p class="speed">NE </p>
          </div>
        </div>


        <div class="outer-row">
          <p>Route Geo Fence</p>
          <div class="row">
            <div class="col-md-4 col-sm-2 image-cover">
              <img src="{{ asset('images/person.png') }}" alt="" class="">
            </div>
            <div class="col-md-8 col-sm-8 outer-row-text">
              <p style="font-weight: bold" id="driver">Peter Wambua</p>
              <p id="driver-number">0715100539</p>
            </div>
          </div>
        </div>
        

      </div>
    </div>

    <div class="col-xl-4 col-md-4 col-sm-12 detailsall">
      <div class="vehicle-details">

        <div>
          <p class="vehicle-details-header">Route Geo Fence</p>
        </div>

        
        
        <div class="outer-row">
         
          <div class="">
            
            <div class="" >
              <div>
                <h5 style="font-weight: bold">Title: {{ $route->title }}</h5>
                <p>Description: {{ $route->description }}</p>
                
                <p>Price: KSH {{ $route->price }}</p>

                
              </div>
              <div>
                <h5>Trips</h5>

                <div id="details">
                  <p>Number: {{ count($trips) }}</p>

                  <div style="line-height: 2px">
                    @for ($i = 0; $i < count($trips); $i++)
                    <div style="border: 1px solid gray; padding-top: 10px; padding-bottom: 5px;">
                      <p style="font-weight: bold"><span class="pr-3">Trip: {{$trips[$i]->title}}</span></p>
                      <p>Time: {{ $trips[$i]->time }}</p>
                      <p>From: {{$trips[$i]->time_from}}</p> 
                      <p>To: {{$trips[$i]->time_to}}</p> 
                      <button class="p-1" onclick="deleteTrip({{$trips[$i]->id}})">Delete Trip</button>
                    </div>
                    @endfor
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <div>
            <p id="info"></p>
        </div>
        
      </div>
      <div style="text-align: center; display: grid; grid-template-columns: 1fr 1fr" >
        

        <a href="{{ route('polyline_edit', $polylines->id) }}" class="btn btn-primary  add-driver text-center">
          Edit Path
        </a>

        <a href="{{ route('trips_create', $route->id) }}" class="btn btn-primary add-driver-two">
          Add Trips
        </a>
      </div>
      
    </div>

  </div>

</div>


<div style="display: none">
  <input type="hidden" name="origin" class="form-control mb-2 origin" value="{{ $polylines->origin }}" style="font-size: 11px">


  
  <input type="hidden" name="waypoint_1" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_1 }}" style="font-size: 11px">



  
  <input type="hidden" name="waypoint_2" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_2 }}" style="font-size: 11px">


  
  <input type="hidden" name="waypoint_3" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_3 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="waypoint_4" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_4 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="waypoint_5" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_5 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="waypoint_6" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_6 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="waypoint_7" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_7 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="waypoint_8" class="form-control mb-2 waypoint" value="{{ $polylines->way_point_8 }}" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

  
  <input type="hidden" name="destination" class="form-control mb-2 destination" value="{{ $polylines->destination }}" placeholder="Destination Lat,Lng" style="font-size: 11px">

  @foreach ($colors as $color)
      <p class="colors">{{ $color }}</p>
  @endforeach
</div>
@endsection


@section('js')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js" ></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyrRpT1Rg7EUpZCUAKTtdw3jl70UzBAU&v=weekly&libraries=drawing,geometry,places" ></script>

<script defer>

var directionDisplay;
            var directionsService = new google.maps.DirectionsService();

            var map;

            var infowindow = new google.maps.InfoWindow();

            function initialize() {
                directionsDisplay = new google.maps.DirectionsRenderer({
                    suppressMarkers: true
                });

                

                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: -1.4386634, lng: 36.9952405 },
                    zoom: 10,
                });

                let infoWindow = new google.maps.InfoWindow({
                    content: "Click the map to get Lat/Lng!",
                    position: { lat: -1.287875, lng: 36.875965 }, 
                });

    
                directionsDisplay.setMap(map);

                //search feature
                const input = document.getElementById("pac-input");
                const searchBox = new google.maps.places.SearchBox(input);


                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                // Bias the SearchBox results towards current map's viewport.
                map.addListener("bounds_changed", () => {
                    searchBox.setBounds(map.getBounds());
                });


                let markers = [];

                searchBox.addListener("places_changed", () => {
                    const places = searchBox.getPlaces();

                    if (places.length == 0) {
                    return;
                    }

                    // Clear out the old markers.
                    markers.forEach((marker) => {
                    marker.setMap(null);
                    });
                    markers = [];

                    // For each place, get the icon, name and location.
                    const bounds = new google.maps.LatLngBounds();

                    places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place contains no geometry");
                        return;
                    }

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25),
                    };

                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                        })
                    );
                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                    });
                    map.fitBounds(bounds);
                });

                map.addListener("click", (mapsMouseEvent) => {
                    // Close the current InfoWindow.
                        infoWindow.close();
                        // Create a new InfoWindow.
                        infoWindow = new google.maps.InfoWindow({
                            position: mapsMouseEvent.latLng,
                        });

                        var jjj = mapsMouseEvent.latLng.toJSON()

                        navigator.clipboard.writeText(jjj['lat'] + ',' + jjj['lng']).then(
                            (cliptext) => {
                                console.log(cliptext);
                            },
                        );
                        infoWindow.setContent(
                            //JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2),
                            'lat and lng copyied'
                        );
                        infoWindow.open(map);
                });
            }

            function calcRoute() {

                
                var waypts = [];

                $('.waypoint').each(function(index, ele){
                    console.log(this.value);

                    var wayLat = this.value;

                    if (wayLat) {
                        var myarrway = wayLat.split(',');

                        stop = new google.maps.LatLng(myarrway[0] - 0, myarrway[1] - 0)
                        waypts.push({
                            location: stop,
                            stopover: true
                        });
                    }

                    
                })

                console.log(waypts);

                var latOne = $('.origin').val();

                var myarr = latOne.split(',');

                var lngOne = $('.destination').val();

                var myarrlng = lngOne.split(',');


                var latStart = myarr[0] - 0;
                var lngStart = myarr[1] - 0;

                var latend = myarrlng[0] - 0;
                var lngend = myarrlng[1] - 0;

                
                start = new google.maps.LatLng(latStart, lngStart);
                end = new google.maps.LatLng(latend, lngend);
                
                createMarker(start);
                
                var request = {
                    origin: start,
                    destination: end,
                    waypoints: waypts,
                    optimizeWaypoints: true,
                    travelMode: google.maps.DirectionsTravelMode.WALKING
                };

                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        var route = response.routes[0];
                    }
                });
            }

            function createMarker(latlng) {
                
                var marker = new google.maps.Marker({
                    position: latlng,
                    map: map
                });
            }


            function getCoord() {
                
                
            }


            $('#save').on('click', function() {
                document.getElementById("pathForm").submit();
            });

            initialize();

            calcRoute();


function deleteTrip(id) {

  var data = new FormData;
  data.append('_token', "{{ csrf_token() }}");
  data.append('id', id);

  var url = '/trips/destroy/'+ id;
  
  $.ajax({
    type: "POST",       
    url: url,
    processData: false,
    contentType: false,
    cache: false,
    data: data,
    error: function (err) {
        console.log(err);
    },
    success: function (response) {
      
      
        if (response['unsuccess'] == null) {
          console.log(response);
          location.reload();  
        }

        if (response['success'] == null) {
          Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'system error please try again',
                    showConfirmButton: false,
                    timer: 2000
            });
        }
        
                   
    }
});
}

</script>
@endsection