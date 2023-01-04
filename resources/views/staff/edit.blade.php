@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Edit Office Staff Details</h5>
            <p class="text-muted m-b-10">Edit {{ $staff->name }} details by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Office Staff</a></li>
                <li class="breadcrumb-item"><a href="#!">Edit</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('staff_update', $staff->id) }}"  method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Full Name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Staff Name" value="{{ old('name', $staff->name) }}" required>
                          </div>
                          
                          <div class="form-group col-md-6">
                            <label for="title">Staff Number</label>
                            <input type="text" name="staff_num" class="form-control" id="staff_num" placeholder="Staff Number" value="{{ old('name', $staff->staff_num) ?? 'not provided' }}" required>
                          </div>
    
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="platenum">Phone Number</label>
                                <input type="text" name="phone_num" class="form-control" id="phone_num" placeholder="Staff Phone Number" value="{{ old('name', $staff->phone_num) ?? 'not provided' }}" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="platenum">Email</label>
                                <input type="email" name="email" class="form-control" id="d_email" placeholder="Staff Email" value="{{ old('email', $staff->email) }}" required>
                            </div>
                            <div class="form-group col-md-4">
                              <label for="platenum">Id Number</label>
                              <input type="text" name="id_number" class="form-control" id="platenum" placeholder="ID Number" required value="{{ $staff->id_num ?? 'not provided' }}">
                            </div>
  
      
                        </div>

                        <div class="form-row">
                            


                            
                            <div class="form-group col-md-4">
                                    <label for="inputState">Select Role</label>
                                    <select id="role" class="form-control role" name="user_type" required onchange="getval(this);">
                                      <option @if ($staff->user_type == 'office staff') selected   @endif value="office staff">Office Staff</option>
                                      <option @if ($staff->user_type == 'driver') selected   @endif value="driver">Driver</option>
                                      <option @if ($staff->user_type == 'supervisor') selected   @endif value="supervisor">Supervisor</option>
                                      <option @if ($staff->user_type == 'manager') selected   @endif value="manager">Manager</option>
                                      <option @if ($staff->user_type == 'office_executive') selected   @endif value="office_executive">Office Executive</option>
                                      <option @if ($staff->user_type == 'teacher') selected   @endif value="teacher">Teacher</option>
                                    </select>
                            </div>

                            <div class="form-group col-md-4 gradehide" >
                                <label for="inputState">Select Grade</label>
                                <select id="inputState" class="form-control" name="grade" >
                                  
                                  
                                  <option @if ($staff->grade == null) selected   @endif value="null">null</option>
                                  <option @if ($staff->grade == 1) selected   @endif value="1">Grade 1</option>
                                  <option @if ($staff->grade == 2) selected   @endif value="2">Grade 2</option>
                                  <option @if ($staff->grade == 3) selected   @endif value="3">Grade 3</option>
                                  <option @if ($staff->grade == 4) selected   @endif value="4">Grade 4</option>
                                  <option @if ($staff->grade == 5) selected   @endif value="5">Grade 5</option>
                                  <option @if ($staff->grade == 6) selected   @endif value="6">Grade 6</option>
                                  <option @if ($staff->grade == 7) selected   @endif value="7">Grade 7</option>
                                  <option @if ($staff->grade == 8) selected   @endif value="8">Grade 8</option>
                                  
                                  
                                  
                                </select>
                            </div>
                            
                        </div>

           
                        <button type="submit" class="btn" style="background:#0071f3">Update</button>
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
       var role = $('.role').val();

       $('.gradehide').hide();

       if (role == 'teacher') {
        $('.gradehide').show();
       }


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