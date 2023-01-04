@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
<style>
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

    .span-delete i {
        
    }

   /* 
 * Always set the map height explicitly to define the size of the div element
 * that contains the map. 
 */

 .map-wrapper {
    height: 109vh;
 }
#map {
  height: 100%;
}

/* 
 * Optional: Makes the sample page fill the window. 
 */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.controls {
  background-color: #fff;
  border-radius: 2px;
  border: 1px solid transparent;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  box-sizing: border-box;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  height: 29px;
  margin-left: 17px;
  margin-top: 10px;
  outline: none;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

.controls:focus {
  border-color: #4d90fe;
}

.title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}
   
</style>
@endsection
@section('content')

<div class="page-wrapper">
    
        <h5 style="margin-top: -25px; margin-bottom: 12px;">Create Route Path</h5>
   
    <div class="row">
        <div class="col-md-9 map-wrapper">
            <input
                id="pac-input"
                class="controls"
                type="text"
                placeholder="Search Box"
            />
            <div id="map"></div>
        </div>
        <div class="col-md-3">
            <form action="{{ route('save-route-path', $route->id) }}" method="post" id="pathForm">
                @csrf
                <label for="" style="font-size: 11px">Origin</label>
                <input type="text" name="origin" class="form-control mb-2 origin" placeholder="Origin Lat,Lng" style="font-size: 11px">


                <label for="" style="font-size: 11px">Waypoint 1</label>
                <input type="text" name="waypoint_1" class="form-control mb-2 waypoint" placeholder="Origin Lat,Lng" style="font-size: 11px">



                <label for="" style="font-size: 11px">Waypoint 2</label>
                <input type="text" name="waypoint_2" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">


                <label for="" style="font-size: 11px">Waypoint 3</label>
                <input type="text" name="waypoint_3" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Waypoint 4</label>
                <input type="text" name="waypoint_4" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Waypoint 5</label>
                <input type="text" name="waypoint_5" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Waypoint 6</label>
                <input type="text" name="waypoint_6" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Waypoint 7</label>
                <input type="text" name="waypoint_7" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Waypoint 8</label>
                <input type="text" name="waypoint_8" class="form-control mb-2 waypoint" placeholder="Waypoint Lat,Lng" style="font-size: 11px">

                <label for="" style="font-size: 11px">Destination</label>
                <input type="text" name="destination" class="form-control mb-2 destination" placeholder="Destination Lat,Lng" style="font-size: 11px">
            </form>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-4">
            <button class="btn btn-block btn-primary" onclick="calcRoute()">Get Route Path</button>
        </div>

        <div class="col-md-4">
            <button class="btn btn-block btn-primary">Clear</button>
        </div>

        <div class="col-md-4">
            <button class="btn btn-block btn-success" id="save">Save Path</button>
        </div>
    </div>

   
@endsection


@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyrRpT1Rg7EUpZCUAKTtdw3jl70UzBAU&libraries=places,geometry,drawing&v=weekly"
      
    ></script>
    <script defer>
        $(document).ready( function () {
            $('#vehTable').DataTable({
                responsive: true,
                language: { searchPlaceholder: "Search records", search: "",},
                columnDefs: [{
                    targets: 0,
                    className: 'stripe'
                }]
                
            });

            if("{{ Session::has('success') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("success") }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else if ("{{ Session::has('unsuccess') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("unsuccess") }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } );

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
    </script>
@endsection