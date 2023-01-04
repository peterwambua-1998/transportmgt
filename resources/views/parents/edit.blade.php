@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Edit Parent Details</h5>
            <p class="text-muted m-b-10">Edit {{ $parent->name }} details by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Parent</a></li>
                <li class="breadcrumb-item"><a href="#!">Edit</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('parents.update', $parent->id) }}"  method="POST">
                        @csrf
                        @method('PATCH')
                       
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Full Name</label>
                            <input type="text" name="name" class="form-control" id="title" placeholder="Staff Name" value="{{ old('name', $parent->name) }}">
                          </div>
                          
                          <div class="form-group col-md-6">
                            <label for="platenum">Phone Number</label>
                            <input type="text" name="phone_num" class="form-control" id="phone_num" placeholder="Staff Phone Number" value="{{ old('name', $parent->phone_num) }}">
                          </div>
                        </div>


                        <div class="form-row">
                            

                            <div class="form-group col-md-6">
                                <label for="platenum">Email</label>
                                <input type="email" name="email" class="form-control" id="d_email" placeholder="Staff Email" value="{{ old('email', $parent->email) }}">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="platenum">Change Password</label>
                              <input type="password" name="password" class="form-control" id="platenum" placeholder="Password">
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