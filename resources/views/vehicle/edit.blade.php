@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Edit Vehicle</h5>
            <p class="text-muted m-b-10">Edit Vehicle Details filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Vehilce</a></li>
                <li class="breadcrumb-item"><a href="#!">Update</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">
                        @csrf 
                        @method('PATCH')
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Vehicle Identifier</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Vehicle Identifier" value="{{ old('title', $vehicle->title) }}">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="platenum">Plate Number</label>
                            <input type="text" name="platenum" class="form-control" id="platenum" placeholder="Plate Number" value="{{ old('plate_num', $vehicle->plate_num) }}">
                          </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="title">Number Of Seats</label>
                                <input type="text" name="num_of_seats" class="form-control" id="title" placeholder="Number Of Seats" value="{{ old('num_of_seats', $vehicle->num_of_seats) }}">
                              </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Driver</label>
                                <select id="inputState" class="form-control" name="driver">
                                  <option selected>Choose...</option>
                                  @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ $driver->id == $vehicle->driver_id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                  @endforeach
                                  
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputState">Select Route</label>
                                <select id="inputState" class="form-control" name="route">
                                  <option selected>Choose...</option>
                                  @foreach ($routes as $route)
                                    <option value="{{ $route->id }}" {{ $route->id == $vehicle->route_id ? 'selected' : '' }}>{{ $route->title }}</option>
                                  @endforeach
                                
                                </select>
                            </div>
                        </div>

           
                        <button type="submit" class="btn" style="background:#0071f3">Submit Changes</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>
    

@endsection


@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script defer>
       
       $(document).ready( function () {
            

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
    </script>
@endsection