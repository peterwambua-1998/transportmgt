@extends('layouts.app')
@section('css')

<style>
   
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Edit Route</h5>
            <p class="text-muted m-b-10">Edit {{ $route->title }} Route by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Route</a></li>
                <li class="breadcrumb-item"><a href="#!">Edit</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('routes.update', $route->id) }}"  method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="{{ old('title', $route->title) }}" required>
                          </div>
                          <div class="form-group col-md-6">
                            <label for="platenum">Description</label>
                            <input type="text" name="description" class="form-control" id="desc" placeholder="Description" value="{{ old('description', $route->description) }}" required>
                          </div>
                        </div>


                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="platenum">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Enter Price" value="{{ old('price', $route->price) }}" required>
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