@extends('layouts.app')
@section('css')

<style>
   #map {
        height: 100%;
        width: 100%;
        border-radius: 10px;
    }

    .div-map {
        height: 80vh;
        width: 100%;
        
    }
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Create Vehicle</h5>
            <p class="text-muted m-b-10">Add vehicle to fleet by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Vehilce</a></li>
                <li class="breadcrumb-item"><a href="#!">Create</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('vehicles.store') }}" method="POST" id="myForm">
                        @csrf 
                        <h5 class="mb-3 mt-3">Vehicle Details</h5>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Vehicle Identifier</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Vehicle Identifier">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="platenum">Plate Number</label>
                            <input type="text" name="platenum" class="form-control" id="platenum" placeholder="Plate Number">
                          </div>
                        </div>

                        


                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Number Of Seats</label>
                                <input type="text" name="num_of_seats" class="form-control" id="title" placeholder="Number Of Seats">
                              </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Driver</label>
                                <select id="inputState" class="form-control" name="driver">
                                    <option selected>Choose...</option>
                                  @foreach ($drivers as $driver)
                                    
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Route</label>
                                <select id="inputState" class="form-control" name="route">
                                    <option selected>Choose...</option>
                                    @foreach ($routes as $route)
                                        
                                        <option value="{{ $route->id }}">{{ $route->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="arrayone_first" id="arrayone_first">
                        <input type="hidden" name="arrayone_second" id="arrayone_second">
                        <input type="hidden" name="arraytwo_first" id="arraytwo_first">
                        <input type="hidden" name="arraytwo_second" id="arraytwo_second">
                        <input type="hidden" name="arraythree_first" id="arraythree_first">
                        <input type="hidden" name="arraythree_second" id="arraythree_second">
                        <input type="hidden" name="arrayfour_first" id="arrayfour_first">
                        <input type="hidden" name="arrayfour_second" id="arrayfour_second">
                       
                        <h5 class="mt-3">Create GeoFence for Vehicle</h5>
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12">
                                <div class="div-map p-2">
                                    <div id="map"></div>
                                   
                                </div>
                        
                            
                        
                                
                                
                        </div>
           
                        <button type="button" class="btn btn-block" id="save-fence" style="background:#0071f3">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('js')
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js" ></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiyrRpT1Rg7EUpZCUAKTtdw3jl70UzBAU&v=weekly&libraries=drawing" ></script>

<script defer>



var mapOptions;
var map;

var coordinates = []
let new_coordinates = []
let lastElement

function InitMap() {
    var location = new google.maps.LatLng(-1.4386634, 36.9952405)
    mapOptions = {
        zoom: 10,
        center: location,
        mapTypeId: google.maps.MapTypeId.RoadMap
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions)
    var all_overlays = [];
    var selectedShape;
    var drawingManager = new google.maps.drawing.DrawingManager({
        //drawingMode: google.maps.drawing.OverlayType.MARKER,
        //drawingControl: true,
        drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: [
                //google.maps.drawing.OverlayType.MARKER,
                //google.maps.drawing.OverlayType.CIRCLE,
                google.maps.drawing.OverlayType.POLYGON,
                //google.maps.drawing.OverlayType.RECTANGLE
            ]
        },
        markerOptions: {
            //icon: 'images/beachflag.png'
        },
        circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 0.2,
            strokeWeight: 3,
            clickable: false,
            editable: true,
            zIndex: 1
        },
        polygonOptions: {
            clickable: true,
            draggable: false,
            editable: true,
            // fillColor: '#ffff00',
            fillColor: '#ADFF2F',
            fillOpacity: 0.5,

        },
        rectangleOptions: {
            clickable: true,
            draggable: true,
            editable: true,
            fillColor: '#ffff00',
            fillOpacity: 0.5,
        }
    });

    function clearSelection() {
        if (selectedShape) {
            selectedShape.setEditable(false);
            selectedShape = null;
        }
    }
    //to disable drawing tools
    function stopDrawing() {
        drawingManager.setMap(null);
    }

    function setSelection(shape) {
        clearSelection();
        stopDrawing()
        selectedShape = shape;
        shape.setEditable(true);
    }

    function deleteSelectedShape() {
        if (selectedShape) {
            selectedShape.setMap(null);
            drawingManager.setMap(map);
            coordinates.splice(0, coordinates.length)
            
        }
    }

    function CenterControl(controlDiv, map) {

        // Set CSS for the control border.
        var controlUI = document.createElement('div');
        controlUI.style.backgroundColor = '#fff';
        controlUI.style.border = '2px solid #fff';
        controlUI.style.borderRadius = '3px';
        controlUI.style.boxShadow = '0 2px 6px rgba(0,0,0,.3)';
        controlUI.style.cursor = 'pointer';
        controlUI.style.marginBottom = '22px';
        controlUI.style.textAlign = 'center';
        controlUI.title = 'Select to delete the shape';
        controlDiv.appendChild(controlUI);

        // Set CSS for the control interior.
        var controlText = document.createElement('div');
        controlText.style.color = 'rgb(25,25,25)';
        controlText.style.fontFamily = 'Roboto,Arial,sans-serif';
        controlText.style.fontSize = '16px';
        controlText.style.lineHeight = '38px';
        controlText.style.paddingLeft = '5px';
        controlText.style.paddingRight = '5px';
        controlText.innerHTML = 'Delete Selected Area';
        controlUI.appendChild(controlText);

        //to delete the polygon
        controlUI.addEventListener('click', function () {
            deleteSelectedShape();
        });
    }

    drawingManager.setMap(map);

    var getPolygonCoords = function (newShape) {

        coordinates.splice(0, coordinates.length)

        var len = newShape.getPath().getLength();

        for (var i = 0; i < len; i++) {
            var arr = [];

            var myvalues = newShape.getPath().getAt(i).toUrlValue(6);



            var newArr = myvalues.split(",");

            new_coordinates.push(newArr);
            
            

            //console.log(newShape.getPath().getAt(i).toUrlValue(6));
        }
        
       
        getCoordinates();
    }

    google.maps.event.addListener(drawingManager, 'polygoncomplete', function (event) {
        event.getPath().getLength();
        google.maps.event.addListener(event, "dragend", getPolygonCoords(event));

        google.maps.event.addListener(event.getPath(), 'insert_at', function () {
            getPolygonCoords(event)
            
        });

        google.maps.event.addListener(event.getPath(), 'set_at', function () {
            getPolygonCoords(event)
        })
    })

    google.maps.event.addListener(drawingManager, 'overlaycomplete', function (event) {
        all_overlays.push(event);
        if (event.type !== google.maps.drawing.OverlayType.MARKER) {
            drawingManager.setDrawingMode(null);

            var newShape = event.overlay;
            newShape.type = event.type;
            google.maps.event.addListener(newShape, 'click', function () {
                setSelection(newShape);
            });
            setSelection(newShape);
        }
    })

    var centerControlDiv = document.createElement('div');
    var centerControl = new CenterControl(centerControlDiv, map);

    
    centerControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(centerControlDiv);

    
    
}


function getCoordinates() {
  console.log(new_coordinates[0][0]);
}


$('#save-fence').on('click', function() {

  var arrayone_first = new_coordinates[0][0];
  var arrayone_second = new_coordinates[0][1];

  var arraytwo_first = new_coordinates[1][0];
  var arraytwo_second = new_coordinates[1][1];


  var arraythree_first = new_coordinates[2][0];
  var arraythree_second = new_coordinates[2][1];


  var arrayfour_first = new_coordinates[3][0];
  var arrayfour_second = new_coordinates[3][1];

  

  $('#arrayone_first').val(arrayone_first);
  $('#arrayone_second').val(arrayone_second);
  $('#arraytwo_first').val(arraytwo_first);
  $('#arraytwo_second').val(arraytwo_second);
  $('#arraythree_first').val(arraythree_first);
  $('#arraythree_second').val(arraythree_second);
  $('#arrayfour_first').val(arrayfour_first);
  $('#arrayfour_second').val(arrayfour_second);
  $('#arrayfour_second').val(arrayfour_second);

  

  document.getElementById("myForm").submit();

  
});


InitMap()


</script>
@endsection