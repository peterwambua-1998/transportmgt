@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Register Staff</h5>
            <p class="text-muted m-b-10">Register office staff by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Office Staff</a></li>
                <li class="breadcrumb-item"><a href="#!">Create</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('staff_store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Full Name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Staff Name" required>
                          </div>
                          
                          <div class="form-group col-md-6">
                            <label for="title">Staff Number</label>
                            <input type="text" name="staff_num" class="form-control" id="staff_num" placeholder="Staff Number" required>
                          </div>
    
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="platenum">Phone Number</label>
                                <input type="text" name="phone_num" class="form-control" id="phone_num" placeholder="Phone Number" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputState">Select Role</label>
                                <select id="role" class="form-control role" name="user_type" required onchange="getval(this);">
                                  <option selected value="office staff">Office Staff</option>
                                  <option value="driver">Driver</option>
                                  <option value="supervisor">Supervisor</option>
                                  <option value="manager">Manager</option>
                                  <option value="office_executive">Office Executive</option>
                                  <option value="teacher">Teacher</option>
                                </select>
                            </div>

                        </div>

                        <div class="form-row">
                            

                            <div class="form-group col-md-6">
                                <label for="platenum">Email</label>
                                <input type="email" name="email" class="form-control  @error('email') is-invalid @enderror" id="d_email" placeholder="Email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="platenum">ID Number</label>
                                <input type="text" name="id_num" class="form-control"  id="d_email" placeholder="ID Number" required>

                            </div>
                            
                            
                            
      
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6 gradehide" >
                                <label for="inputState">Select Grade</label>
                                <select id="inputState" class="form-control" name="grade" >
                                  
                                  
                                  <option value="1">Grade 1</option>
                                  <option value="2">Grade 2</option>
                                  <option value="3">Grade 3</option>
                                  <option value="4">Grade 4</option>
                                  <option value="5">Grade 5</option>
                                  <option value="6">Grade 6</option>
                                  <option value="7">Grade 7</option>
                                  <option value="8">Grade 8</option>
                                  
                                  
                                  
                                </select>
                            </div>
                        </div>

           
                        <button type="submit" class="btn" style="background:#0071f3">Submit</button>
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
    $('.gradehide').hide();
    function getval(sel)
    {
        console.log(sel);
        if (sel.value == 'teacher') {
            $('.gradehide').show();
        } else {
            $('.gradehide').hide();
        }
        
    }
    
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