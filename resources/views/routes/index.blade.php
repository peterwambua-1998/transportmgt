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

   
</style>
@endsection
@section('content')


<div class="vihcleGrid">

    <div>
        <h5><span style="font-weight:300;">Routes</span> - <span style="font-weight:500;">Management</span></h5>
    </div>
    
   

    <div>
       
            <a href="{{ route('routes.create') }}" class="btn btn-create" style="float: right;border-radius:5px">Create</a>
        
    </div>
    
    
</div>
<div class="page-wrapper">

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card tabs-card">
                
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
    
                        <div class="table-responsive">
                            <p class="table-title-vehicle"><span style="color: #0071f3">Routes</span> - List Viewer</p>
                            <table class="table table-striped" style="border: 1px solid gray;" id="vehTable">
                                <thead style="background-color: #0071f3; color: #fff;">
                                    <tr>
                                       
                                        <th style="text-align: center">Title</th>
                                        <th  style="text-align: center">description</th>
                                        <th style="text-align: center">Price (KSH)</th>
                                        <th>Number Of Trips</th>
                                        <th style="text-align: center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($routes as $route)
                                        
                                    <tr style="text-align: center">

                                        @php
                                            /*$trips = count(App\RoutePolyline::where('route_id', '=', $route->id)->get());*/

                                        @endphp
                                        
                                        <td>{{ $route->title }}</td>
                                        <td>{{ $route->description }}</td>
                                        <td>{{ $route->price }}</td>
                                        <td>{{ 0 }}</td>
                                        <td>
                                            

                                            <a href="{{ route('routes.edit', $route->id) }}" class="span-delete">
                                                <span><i class="fa fa-pencil" aria-hidden="true" style="color: rgb(2, 167, 2);"></i></span>
                                            </a>

                                            <form action="{{ route('routes.destroy', $route->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                
                                            <button type="submit" class="span-delete" style="background: none; border: none" >
                                                <span ><i class="fa fa-trash" aria-hidden="true" style="color: red"></i></span>
                                            </button>
                                            </form>
                                            

                                           @if ($route->path)
                                           <a href="{{ route('geofence_show', $route->path->id) }}" class="span-delete">
                                            <span><i class="fa fa-map" aria-hidden="true" style="color:#0071f3"></i></span>
                                            </a>

                                            
                                           @endif

                                           

                                            
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                               
                                
                            </table>
                        </div>
                        <div class="text-center">
                            
                        </div>
                    </div>
                   
                    
                </div>
            </div>
        </div>
    </div>

</div>
@endsection


@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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

    </script>
@endsection