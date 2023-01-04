@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Add Student</h5>
            <p class="text-muted m-b-10">Add Student by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Student</a></li>
                <li class="breadcrumb-item"><a href="#!">Add</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('students.update', $student->id) }}"  method="POST" id="studentForm">
                        @csrf
                        @method('PATCH')
                        

                        <h5>Student Details</h5>

                        <br>

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Student First Name</label>
                            <input type="text" name="fname" class="form-control" id="title" value="{{ $student->first_name }}" placeholder="Student First Name">
                          </div>
                          <div class="form-group col-md-6">
                            <label for="platenum">Student Last Name</label>
                            <input type="text" name="lname" class="form-control" id="desc" value="{{ $student->last_name }}" placeholder="Student Last Name">
                          </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="platenum">Grade</label>
                                <input type="text" name="grade" value="{{ $student->grade }}" class="form-control" id="desc" placeholder="Student Grade">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputState">Select Vehicle</label>
                                <select id="inputState" class="form-control" name="vehicle_id">

                                  @foreach ($vehicles as $vehicle)
                                  <option {{ old($student->vehicle_id) == $vehicle->id ? "selected" : "" }}  value="{{$vehicle->id}}">{{ $vehicle->title }} - ({{ $vehicle->plate_num }})</option>
                                  @endforeach
                                  
                                </select>
                            </div>
                        </div>
    
                        <br>

                        <div id="extraInputs">

                        </div>

                        <div style="width: 100vw">
                           

                        
                            <button type="submit" class="btn" style="background:#0071f3; color: #fff" style="float: right">Submit</button>
                        </div>

                        
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
    </script>
@endsection