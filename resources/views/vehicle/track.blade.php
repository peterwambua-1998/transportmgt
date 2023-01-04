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
        margin-top: -30px;
        height: 10vh;
     }

     .outer-row p {
      position: relative;
      top: 20px;
     }

     .img-outer {
      
       
     }
     .img-outer .image-outer-img {
      height: 70%;
      width: 55%;

     }

     .image-cover img{
      height: 100%;
      width: 50%;
      position: relative;
      top: 20px;
     }

     .outer-row-text {
      line-height: 2px !important;
      margin-left: -16%;
      margin-top: 10px;
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
        width: 90%;
        left: 50%;
        transform: translateX(-50%);
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
            <div id="map2"></div>
        </div>
        
    </div>

    <div class="col-xl-4 col-md-4 col-sm-12 details">
      <div class="vehicle-details">
        <div>
          <p class="vehicle-details-header">Fleet Details <small style="float: right; margin-right: 5px"><button class="show-all">Show All</button></small></p>
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
          <p>Driver Details</p>
          <div class="row">
            <div class="col-md-4 col-sm-2 image-cover">
              <img src="{{ asset('images/person.png') }}" alt="" class="">
            </div>
            <div class="col-md-8 col-sm-8 outer-row-text">
              <p style="font-weight: bold" id="driver"></p>
              <p id="driver-number"></p>
            </div>
          </div>
        </div>
        

      </div>
    </div>

    <div class="col-xl-4 col-md-4 col-sm-12 detailsall">
      <div class="vehicle-details">

        <div>
          <p class="vehicle-details-header">Driver Details</p>
        </div>

        @foreach ($drivers as $driver)
            
        
        <div class="">
         
          <div class="my-row">
            <div class="my-grid img-outer">
              <img src="{{ asset('images/person.png') }}" alt="" class="img-outer-img">
            </div>
            <div class="driver-details-text" >
              <div>
                <p style="font-weight: bold">{{ $driver->name }}</p>
                <p> {{ $driver->phone_num }}</p>
                @php
                    
                    $vehicle = App\Vehicle::where('driver_id', '=', $driver->id)->first();
                @endphp
                <p>{{ $vehicle->title ?? 'not assigned vehicle' }}</p>
              </div>
              
            </div>
          </div>
        </div>

        @endforeach
      </div>
      <div style="text-align: center">
        <button class="btn btn-primary btn-block add-driver">add driver</button>
      </div>
      
    </div>

  </div>

</div>
@endsection


@section('js')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js" ></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyrRpT1Rg7EUpZCUAKTtdw3jl70UzBAU&libraries=geometry&v=weekly" ></script>

<script defer>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
myMap();
$('.show-all').on('click', function () {
  $('.details').hide();
  $('.detailsall').show();
});
function showMore(position) {
  console.log(position.id);

  var data = new FormData;

  data.append('_token','{{csrf_token()}}');
  data.append('id', position.id);

  $.ajax({
    type: "POST",
    url: "{{ route('get_vehicle') }}",
    processData: false,
    contentType: false,
    cache: false,
    data: data,
    error: function (err) {
        console.log(err)
    },
    success: function (response) {
      console.log(response);
      $('.detailsall').hide();
      $('.details').show();
      $('.vhl-title').text(response[0].title);
      $('.vhl-plate').text(response[0].plate_num);
      $('#driver').text(response[1].name);
      $('#driver-number').text(response[1].phone_num);

    }
  });
}



setInterval(myMap, 30000);




function myMap() {

$.ajax({
  type: "GET",
  url: "{{ route('all_vehicles') }}",
  processData: false,
  contentType: false,
  cache: false,

  error: function (err) {
      console.log(err)
  },
  success: function (response) {
    console.log(response);
    
    
    let locations = [];

    

    let labels = [];

    let routedetails = [];

    

    for (let i = 0; i < response.length; i++) {
      //var locNum = i + i;

      //console.log(response[locNum]);
      if (i === 0) {
          //var locNum = i;

          locations.push(
            { lat: response[i][0] - 0, lng: response[i][1] - 0, id: response[i][2] }
          );
          labels.push(response[i][3]);
         
        }
        else if (i % 2 === 0) {
          locations.push(
            { lat: response[i][0] - 0, lng: response[i][1] - 0, id: response[i][2] }
          );
          labels.push(response[i][3]);
        }
        else {
          routedetails.push(response[i]);
        }

      

      
      /*
      locations.push(
          { lat: value[0][0] - 0, lng: value[0][1] - 0, id: value[0][2] }
      );

      labels.push(value[0][3]);

      routedetails.push(value[1]);
      */
      
    }


    let map, infoWindow;

    

    
      var loc = { lat: -1.4386634, lng: 36.9952405 }
      map = new google.maps.Map(document.getElementById("map"), {
        center: loc,
        zoom: 10,
      });
      infoWindow = new google.maps.InfoWindow({
        content: "",
        disableAutoPan: true,
      });


   
      // Add some markers to the map.

      const markers = locations.map((position, i) => {
        const label = labels[i];
        
        const marker = new google.maps.Marker({
          position,
          label,

        });

        
        marker.addListener("click", () => {
          infoWindow.setContent(label);
          infoWindow.open(map, marker);
          console.log(position);
          showMore(position);
          
        });

        
        return marker;
      });

      
      console.log(locations[0].lat);
      
      

      
      new markerClusterer.MarkerClusterer({ markers, map });


      console.log(locations);

      for (let i = 0; i < routedetails.length; i++) {
        console.log(routedetails[i]);
        var newVal = routedetails[i];
        
        const triangleCoords = [
          { lat: newVal.arrone_first - 0, lng: newVal.arrone_second - 0 },
          { lat: newVal.arrtwo_first - 0, lng: newVal.arrtwo_second - 0 },
          { lat: newVal.arrthree_first - 0, lng: newVal.arrthree_second - 0 },
          { lat: newVal.arrfour_first - 0, lng: newVal.arrfour_second - 0 },
        ];
       
        const bermudaTriangle = new google.maps.Polygon({
          paths: triangleCoords,
          strokeColor: "#FF0000",
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: "#ADFF2F",
          fillOpacity: 0.5,
        });

        bermudaTriangle.setMap(map);

        var status = google.maps.geometry.poly.containsLocation({lat: locations[i].lat, lng: locations[i].lng}, bermudaTriangle);

        if (status == false) {
          notify(status, locations[i].id);

          var dataTwo = new FormData;
          dataTwo.append('_token', '{{ csrf_token() }}');
          dataTwo.append('vehicle_id', locations[i].id);


          $.ajax({
            type: "POST",
            url: "{{ route('vehicleoutofzone') }}",
            processData: false,
            contentType: false,
            cache: false,
            data: dataTwo,
            error: function (err) {
                console.log(err)
            },
            success: function (response) {
              console.log(response);

            }
          });
        }
        
      }


      function notify(status, id) {
        console.log(id);
        if (! status) {
          if (!("Notification" in window)) {
            
            alert("This browser does not support desktop notification");
          } else if (Notification.permission === "granted") {
            
            
            const notification = new Notification("one of the vehilces is out of zone ");
            
          } else if (Notification.permission !== "denied") {
            
            Notification.requestPermission().then((permission) => {
              
              if (permission === "granted") {
                const notification = new Notification("one of the vehilces is out of zone");
               
              }
            });
          }
        }
      }

      


    
    /*
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      infoWindow.setPosition(pos);
      infoWindow.setContent(
        browserHasGeolocation
          ? "Error: The Geolocation service failed."
          : "Error: Your browser doesn't support geolocation."
      );
      infoWindow.open(map);
    }
    */



    var vehicles = [];

    window.initMap = map;

  } 

});

}






</script>
@endsection