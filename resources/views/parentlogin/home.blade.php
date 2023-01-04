@extends('layouts.app')

@section('css')
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<style>
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

    .my-card {
        height: 100vh;
        width: 100%;
    }
    .card-block {
        height: 100%;
        width: 100%;
    }
    #map {
        height: 100%;
        width: 100%;
    }

    .panel {
      margin-bottom: 19px;
      background-color: #fff;
      border: 1px solid transparent;
      border-radius: 4px;
      -webkit-box-shadow:  0 2px 5px 0 rgba(0,0,0,.26);
      box-shadow: 0 2px 5px 0 rgba(0,0,0,.26);
    }

    .text-thin {
      font-weight: 100!important;
    }

    .thumb24 {
  width: 24px!important;
  height: 24px!important;
  line-height: 24px!important;
}
    @media only screen and (max-width: 500px) and (orientation: portrait) {
        .my-card .card-block {
          padding: 0 !important;
        }
        #map {
          height: 100%;
          width: 100%;
        }

        .my-row {
          display: none;
        }

    }
</style>
@endsection

@section('content')

<div class="page-wrapper">

    <div class="page-body">
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Orders Received</h6>
                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span>486</span></h2>
                        <p class="m-b-0">Completed Orders<span class="f-right">351</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 my-row" >
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Total Sales</h6>
                        <h2 class="text-right"><i class="ti-tag f-left"></i><span>1641</span></h2>
                        <p class="m-b-0">This Month<span class="f-right">213</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4 my-row">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Revenue</h6>
                        <h2 class="text-right"><i class="ti-reload f-left"></i><span>$42,562</span></h2>
                        <p class="m-b-0">This Month<span class="f-right">$5,032</span></p>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12">
                <div class="card my-card">
                    <div class="card-block">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

            

            
            
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card">
              <div class="card-body p-0">
                <div class="pane py-2 px-3 border-bottom">
                  <div>
                    <h2 class="card-title mb-3 mt-0 lead">Order History</h2>
                    <p class="text-muted">
                      Manage billing information and view receipts
                    </p>
                  </div>
                </div>
                <div class="pane py-2 px-3 border-bottom">
                  <div>
                    <h2 class="card-title mb-3 mt-0 h6">Invoice #120345</h2>
                    <p class="text-muted">Billed August 21, 2019</p>
                  </div>
                  <button class="btn btn-flat btn-sm btn-outline-success ml-auto">
                    Pay now
                  </button>
                </div>
                <div class="pane py-2 px-3">
                  <div>
                    <h2 class="card-title mb-3 mt-0 h6">Invoice #120344</h2>
                    <p class="text-muted">Billed July 21, 2019</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-body bg-primary">
                 <h2 class="text-thin mt">Contact Us:</h2>
                 <div class="clearfix">
                    <div class="pull-right">
                       <ul>
                          <li>+254010001001</li>
                          <li>systme@mail.com</li>
                       </ul>
                    </div>
                 </div>
              </div>
            </div>
          
          </div>
        </div>
    </div>

</div>



<div style="visibility: hidden">
  <i class="fa fa-location-arrow" aria-hidden="true" id="loc"></i>

 
</div>


@endsection


@section('js')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js" ></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyrRpT1Rg7EUpZCUAKTtdw3jl70UzBAU&v=weekly" ></script>
<script defer>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see the error "The Geolocation service
// failed.", it means you probably did not give permission for the browser to
// locate you.
let map, infoWindow;



var parent_id = '{{ Auth::user()->id }}' - 0;

getlatlong();





function getlatlong() {
  var data = new FormData;

  data.append('_token','{{csrf_token()}}');
  data.append('pid', parent_id);

  $.ajax({
    type: "POST",
    url: "{{ route('getlatlong') }}",
    processData: false,
    contentType: false,
    cache: false,
    data: data,
    error: function (err) {
        console.log(err)
    },
    success: function (response) {
      console.log(response);

      let locations = [];


      let labels = [];

      for (let i = 0; i < response.lat.length; i++) {
        
        locations.push(
            { lat: response.lat[i] - 0, lng: response.lng[i] - 0 }
        );
        
        labels.push(response.label[i]);
      }
      
      
      console.log(locations);

      map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -1.4386634, lng: 36.9952405 },
        zoom: 10,
      });
      infoWindow = new google.maps.InfoWindow({
        content: "",
        disableAutoPan: true,
      });


      const markers = locations.map((position, i) => {
      
        const label = labels[i];
        
        const marker = new google.maps.Marker({
          position,
          label,

        });

        // markers can only be keyboard focusable when they have click listeners
        // open info window when marker is clicked
        marker.addListener("click", () => {
          infoWindow.setContent(label);
          infoWindow.open(map, marker);
          console.log(position);
          showMore(position);
          
        });

        return marker;
      });


      new markerClusterer.MarkerClusterer({ markers, map });
      
      window.initMap = map;

    }
  });
}


setInterval(getlatlong, 30000);






</script>
@endsection