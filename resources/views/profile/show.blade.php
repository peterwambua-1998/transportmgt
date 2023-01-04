@extends('layouts.app')
@section('css')

<style>

</style>
@endsection
@section('content')
<form action="{{ route('profile_update', $userProfile->id) }}" method="post">
    @csrf
<div class="container rounded bg-white mt-2 mb-5">
    <div class="row">
        
        <div class="col-md-12 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile Settings</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels">Full Name</label><input type="text" class="form-control" placeholder="full name" value="{{ $userProfile->name }}" name="name"></div>
                    <div class="col-md-6"><label class="labels">Email</label><input type="email" class="form-control" value="{{ $userProfile->email }}" placeholder="example@mail.com" name="email"></div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6"><label class="labels">Mobile Number</label><input type="text" class="form-control" placeholder="enter phone number" value="{{ $userProfile->phone_num }}" name="phone_num"></div>
                    <div class="col-md-6"><label class="labels">ID Number</label><input type="text" class="form-control" placeholder="enter ID number" value="{{ $userProfile->id_num }}" name="id_num"></div>
                   
                </div>

                <div class="row mt-3">
                    @if (Auth::user()->user_type == 'teacher')
                        
                    <div class="col-md-6">
                        <label for="inputState">Select Grade</label>
                                <select id="inputState" class="form-control" name="grade">
                                  
                                  
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
                    @endif
                    <div class="col-md-6">
                        <label class="labels">Change Password</label>
                        <input type="password" class="form-control" id="myInput" autocomplete="new-password">
                        <input class="form-check-input" style="margin-left: 5px; " type="checkbox"  onclick="myFunction()"><span style="margin-left: 20px; ">Show Password</span>
                    </div>
                    
                </div>
                
                <div class="mt-5"><button class="btn btn-primary profile-button btn-block" type="submit">Save Profile</button></div>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
</form> 

@endsection


@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script defer>
        function myFunction() {
                var x = document.getElementById("myInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
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