@extends('layouts.app')
@section('css')

<style>
   .table-bordered thead th {
    border-bottom: 0; 
   }

   .table-bordered td {
    border: 1px solid #d0d2d4 !important;
   }
</style>
@endsection
@section('content')
<h5 class="text-center">Attendance Report</h5>
<div class="page-wrapper">
    <div class="page-header card">
        <span class="text-center" style="font-weight: bold; text-decoration: underline">Report includes both am and pm</span>
        <div class="card-block p-1 m-0 mt-3">
            
            <br>
            <form action="" >
                <div class="form-row p-0 m-0">
                <div class="mr-5 ml-2 pt-2">
                    <label for="" style="display: inline">Month of</label >
                </div>
                    
                <div  class="form-group col-md-5 m-0" >
                    
                    <input type="month" class="form-control" name="month" id="month">
                    <p style="color: red" class="to-warning"></p>
                </div>
                <div class="form-group col-md-1 m-0">
                    
                    <button type="button" id="filter" class="btn get-data" style="background: #0071f3">Filter</button>

                    
                </div>

                
                </div>
            </form>
            
        </div>
    </div>

    <div class="page-header card">
        <div class="card-block">
            <table class="table  table-bordered" style="border: 1px solid gray;" id="vehTable">
                <thead style="background-color: #0071f3; color: #fff">
                    <tr>
                       
                        <th>#</th>
                        <th>Student</th>
                        <th>Grade</th>
                        <th>Present</th>
                        <th>Absent</th>
                    </tr>
                </thead>
                <tbody id="attendance_table">

                    
                </tbody>
               
                
            </table>
        </div>
    </div>


    <div class="page-body">
        
    </div>

</div>
    

@endsection


@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script defer>
        $(document).ready( function () {

            
            $.ajax({
                type: "GET",
                url: "{{ route('attendance-report-table') }}",
                processData: false,
                contentType: false,
                cache: false,
               
                error: function (err) {
                    console.log(err)
                },
                success: function (response) {
                 
                 $('tbody').html(response);

                }
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


            $('#filter').on('click', getAtt);

            function getAtt() {

                var month = $('#month').val();
                var data = new FormData;
                data.append('_token', '{{ csrf_token() }}');
                data.append('month', month);
                

                $.ajax({
                    type: "POST",
                    url: "{{ route('attendance-report-query') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        console.log(response);
                        $('tbody').html(response[0]);

                    }
                });
            }
        } );



    </script>
@endsection