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
        <p style="font-size: 16px; transform: scale(1, 1.3);"><span style="font-weight:300;">Todays Attendance</span> - <span style="font-weight:500;">List</span></p>
    </div>
    
   

    
    
</div>
<div class="page-wrapper">
    <form action="{{ route('school-attendance.store') }}" method="POST">
    
        @csrf
    <div class="card">
        
        <div class="card-body">
            
        
                <div class="table-responsive">
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Mark Present / Absent</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($attendanceAm as $attendance)
                            
                            @php
                                $student = App\Student::where('id', '=', $attendance->student_id)->first();
                            @endphp
                            <tr>
                                <td>
                                    <input type="text" value="{{ $student->first_name }} {{ $student->last_name }}" name="" class="form-control">
                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                    <input type="hidden" name="vehicle_id[]" value="{{ $attendance->vehicle_id }}">
                                </td>
                                <td>
                                    <select id="inputState" class="form-control" name="present[]">
                                        <option selected value="0">absent</option>
                                        <option value="1">present</option>
                                    </select>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <div >
                    <button class="btn btn-primary btn-block">Submit</button>
                </div>
            
    
        
            
            
               
                
                
            
    
    
            
        
        </div>
    </div>
</form>
    

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
        } );

    </script>
@endsection