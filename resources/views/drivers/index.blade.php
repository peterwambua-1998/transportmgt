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
</style>
@endsection
@section('content')


<div class="vihcleGrid">

    <div>
        <p style="font-size: 16px; transform: scale(1, 1.3);"><span style="font-weight:300;">Driver</span> - <span style="font-weight:500;">Management</span></p>
    </div>
    
   

    <div>
        <button class="btn btn-create" style="float: right;border-radius:5px">
            <a href="{{ route('drivers.create') }}">Create</a>
        </button>
    </div>
    
    
</div>
<div class="page-wrapper">

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card tabs-card">
                
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
    
                        <div class="table-responsive">
                            <p class="table-title-vehicle"><span style="color: #0071f3">Drivers</span> - List Viewer</p>
                            <table class="table table-striped" style="border: 1px solid gray;" id="vehTable">
                                <thead style="background-color: #0071f3; color: #fff">
                                    <tr>
                                       
                                        <th>Name</th>
                                        
                                        <th>Staff Number</th>
                                        <th>Phone Number</th>
                                        <th>ID Number</th>
                                        <th>Email</th>
                                        
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($drivers as $driver)
                                        
                                    
                                    <tr>
                                        
                                        <td>{{$driver->name}}</td>
                                        <td>{{ $driver->staff_num }}</td>
                                        <td>{{ $driver->phone_num }}</td>
                                        <td>{{ $driver->id_num ?? 'not provided' }}</td>
                                        <td>{{ $driver->email }}</td>
                                        
                                        <td>
                                            <a href="{{ route('drivers.edit', $driver->id) }}" class="span-delete">
                                                <span><i class="fa fa-pencil" aria-hidden="true" style="color: rgb(2, 167, 2);"></i></span>
                                            </a>

                                            
                                                <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST" style="display: inline-block">
                                                   
                                                    @csrf
                                                    @method('DELETE')
                                                        
                                                    <button type="submit" style="background: none; border: none" class="span-delete"><i class="fa fa-trash" aria-hidden="true" style="color: red"></i></button>
                                                    
                                                </form>
                                                
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
    <script defer src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer>
        $(document).ready( function () {
            $('#vehTable').DataTable({
                language: { searchPlaceholder: "Search records", search: "",},
            });


            if("{{ Session::has('success') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("success") }}',
                    showConfirmButton: false,
                    timer: 1500
                })
                
            } else if ("{{ Session::has('unsuccess') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("unsuccess") }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } );



    </script>
@endsection