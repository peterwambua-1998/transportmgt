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
        <p style="font-size: 16px; ">
            @if ($numChild > 1)
            <span style="font-weight:300;">My Children</span>
            @endif
            
            @if ($numChild == 1)
            <span style="font-weight:300;">My Child</span>
            @endif
        </p>
    </div>
    
   

    
    
    
</div>
<div class="page-wrapper">

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card tabs-card">
                
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
    
                        <div class="table-responsive">
                            <p class="table-title-vehicle">
                                @if ($numChild > 1)
                                <span style="color: #0071f3">My Children</span> - List Viewer
                                @endif

                                @if ($numChild == 1)
                                <span style="color: #0071f3">My Child</span> - Viewer
                                @endif
                            </p>
                            <table class="table table-striped" style="border: 1px solid gray;" id="vehTable">
                                <thead style="background-color: #0071f3; color: #fff">
                                    <tr>
                                       
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Grade</th>
                                        <th>Parent Name</th>
                                        <th>Parent Phone</th>
                                        <th>Driver Name</th>
                                        <th>Driver Number</th>
                                        <th>Vehicle</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        
                                    
                                    <tr>
                                        <td>{{ $student->first_name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->grade }}</td>
                                        <td>{{ $student->parent->name }}</td>
                                        <td>{{ $student->parent->phone_num }}</td>
                                        <td>{{ $student->vehicle->title }} {{ $student->vehicle->plate_num }}</td>
                                        <td>{{ $student->vehicle->driver->name }}</td>
                                        <td>{{ $student->vehicle->driver->phone_num }}</td>
                                        
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
    <script defer>
        $(document).ready( function () {
            $('#vehTable').DataTable({
                language: { searchPlaceholder: "Search records", search: "",},
            });
        } );

    </script>
@endsection