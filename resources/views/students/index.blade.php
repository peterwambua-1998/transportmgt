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

    .pick-up:hover {
        cursor: pointer;
    }
</style>
@endsection
@section('content')


<div class="vihcleGrid">

    <div>
        <p style="font-size: 16px;"><span style="font-weight:300;">Students</span> - <span style="font-weight:500;">Management</span></p>
    </div>
    
   

    <div>
       
            <a href="{{ route('students.create') }}" class="btn btn-create" style="float: right;border-radius:5px">Add Student</a>
       
    </div>
    
    
</div>
<div class="page-wrapper">

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card tabs-card">
                
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
    
                        <div class="table-responsive">
                            <p class="table-title-vehicle"><span style="color: #0071f3">Students</span> - List Viewer</p>
                            <table class="table table-striped" style="border: 1px solid gray;" id="vehTable">
                                <thead style="background-color: #0071f3; color: #fff">
                                    <tr>
                                       <th>Pick Up</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Grade</th>
                                        <th>Admission</th>
                                        <th>Parent Name</th>
                                        <th>Parent Phone</th>
                                        <th>Vehicle</th>
                                        <th>Trip</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="stdTableBody">
                                    @foreach ($students as $student)
                                        
                                    
                                    <tr>
                                        <td class="text-center">
                                        @if ($student->pick_up)
                                        <i class="fa fa-check-circle pick-up" aria-hidden="true" style="color: green; font-size: 25px" onclick="pickup({{ $student->id }}, 1)"></i>
                                        @else
                                        <i class="fa fa-times-circle pick-up" aria-hidden="true" style="color: red; font-size: 25px"></i>
                                        @endif
                                    </td>
                                        <td>{{ $student->first_name }}</td>
                                        <td>{{ $student->last_name }}</td>
                                        <td>{{ $student->grade }}</td>
                                        <td>{{ $student->add_num }}</td>
                                        <td>{{ $student->parent->name ?? 'deleted' }}</td>
                                        <td>{{ $student->parent->phone_num ?? 'deleted' }}</td>
                                        <td>{{ $student->vehicle->title }} {{ $student->vehicle->plate_num }}</td>
                                        <td>{{ $student->trip->title }}, {{ $student->trip->time }}, From: {{ $student->trip->time_from }}, to: {{$student->trip->time_to}}</td>
                                        
                                        <td>
                                            <a href="{{ route('students.edit', $student->id) }}" class="span-delete">
                                                <span><i class="fa fa-pencil" aria-hidden="true" style="color: rgb(2, 167, 2);"></i></span>
                                            </a>
                                            <form action="{{ route('students.destroy', $student->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="student_id" value="{{ $student->id }}">
                                            <button type="submit" class="span-delete" style="background: none; border: none" >
                                                <span ><i class="fa fa-trash" aria-hidden="true" style="color: red"></i></span>
                                            </button>
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
            

            function pickup(student_id, pickup_value) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('get_vehicle') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        console.log(response);
                        $('.detailsall').hide();
                        $('.details').show();
                        $('.vhl-title').text(response[0].title);
                        $('.vhl-plate').text(response[0].plate_num);
                        $('#driver').text(response[1].name);
                        $('#driver-number').text(response[1].phone_num);

                    }
                })
            }

        });

    </script>
@endsection