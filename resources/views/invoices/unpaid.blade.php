@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
<style>

    body {
        font-size: 14px;
    }
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
        background: #0071f3;
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

    .inv-link {
        color: black;
    }

    .inv-link:hover {
        color: #0071f3;
    }

    .overlay{
        display: none;
        position: fixed;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: 999;
        background: rgba(255,255,255,0.8) url("loader.gif") center no-repeat;
    }

    body.loading{
    overflow: hidden;   
    }
   
    body.loading .overlay{
        display: block;
    }

    th, td {
        font-size: 14px;
    }
    .nav-link  {
        color: #0071f3;
        
    }

    .nav-link:hover {
        color: #023570;
    }
</style>
@endsection
@section('content')
<div class="vihcleGrid">

    <div>
        <p style="font-size: 16px; transform: scale(1, 1.3);"><span style="font-weight:300;">Unpaid Invoice</span> - <span style="font-weight:500;">Management</span></p>
    </div>
    
    
    
</div>
<div class="page-wrapper">
    <div class="card">
        <div class="page-w card-header p-1 m-0" >
            <form action="">
                <div class="form-row p-0 m-0">
                <div class="form-group col-md-5 m-0">
                    <label for="">from</label>
                    <input type="date" class="form-control" name="from" id="from" >
                    <p style="color: red" class="from-warning"></p>
                </div>
                <div  class="form-group col-md-5 m-0">
                    <label for="">to</label>
                    <input type="date" class="form-control" name="from" id="to">
                    <p style="color: red" class="to-warning"></p>
                </div>
                <div class="form-group col-md-2 m-0">
                    <label for="" style="visibility: hidden">cl</label><br>
                    <button type="button" class="btn get-data-unpaid" style="background: #0071f3">Submit</button>
                </div>
                </div>
            </form>
        </div>
</div>

<section id="tabs" class="project-tab">
    
    <div class="row">
        <div class="col-md-12">
           
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="table-responsive">
                        <p class="table-title-vehicle"><span style="color: #0071f3">Invoice</span> - List Viewer <span class="pl-5 total"></span></p>
                        @include('invoices.unpaid_includes.table1currentmonth')
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</section>

{{--
<div class="page-wrapper">
    <ul class="nav nav-pills nav-fill" >
        <li class="nav-item">
            <a class="nav-link inv-link active" href="#">This Month</a>
        </li>
        <li class="nav-item">
            <a class="nav-link inv-link" href="#">Longer nav link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link inv-link" href="#">Link</a>
        </li>
        <li class="nav-item">
            <a class="nav-link inv-link" href="#">Disabled</a>
        </li>
    </ul>

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card tabs-card">
                
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="home3" role="tabpanel">
    
                        <div class="table-responsive">
                            <p class="table-title-vehicle"><span style="color: #0071f3">Invoice</span> - List Viewer</p>
                            <table class="table table-striped" style="border: 1px solid gray;" id="vehTable" >
                                <thead style="background-color: #0071f3; color: #fff">
                                    <tr>
                                       
                                        <th>Inv No</th>
                                        <th>Paid</th>
                                        <th>Balance</th>
                                        <th>Total</th>

                                        <th>Status</th>
                                        <th>Parent</th>
                                        <th>Student</th>
                                        <th>Date</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($invoices as $invoice)
                                        @php 
                                        $amtReceipt = 0;

                                        foreach ($invoice->receipt as $receipt) {
                                            $amtReceipt += $receipt->amount;
                                        }
                                        $invAmt = $invoice->amount;

                                        $balance = $invAmt - $amtReceipt;

                                        $parent = App\User::where('id', '=', $invoice->parent_id)->first();
                                        $student = App\Student::where('id', '=', $invoice->student_id)->first();

                                        $date=date_create($invoice->created_at);

                                        $fDate = date_format($date,"Y/m/d");
                                        @endphp

                                        @if ($amtReceipt < $invAmt)
                                        <tr>
                                            <td>{{ $invoice->inv_num }}</td>
                                            
                                            <td>{{ $amtReceipt }}</td>
                                            <td>{{ $balance }}</td>
                                            <td>{{ $invAmt }}</td>
                                            <td>{{ $invoice->status }}</td>
                                            <td>{{ $parent->name }}</td>
                                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                            <td>{{ $fDate }}</td>
                                        </tr>
                                        @endif
                                        
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
---}}
<div class="overlay">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection


@section('js')
    <script defer src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer>
        $(document).ready( function () {
           


            
            $.ajax({
                type: "GET",
                url: "{{ route('unpaiddata') }}",
                processData: false,
                contentType: false,
                cache: false,
               
                error: function (err) {
                    console.log(err)
                },
                success: function (response) {
                 
                 $('tbody').html(response['table']);
                 $('.total').text('KSH ' + response['total']);
                }
            });


            function getData() {
                var from = $('#from').val();
                var to = $('#to').val();

                

                
                if (! from) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                if (! to) {
                    $('.to-warning').text('please eneter date');
                    return;
                }

                if (! from && ! to) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                var data = new FormData;
                data.append('_token', '{{ csrf_token() }}');
                data.append('from', from);
                data.append('to', to);

                $.ajax({
                    type: "POST",
                    url: "{{ route('unpaiddataquery') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        
                        $('tbody').html(response['table']);
                        $('.total').text('KSH ' + response['total']);
                    }
                });
                
            }

            $('.get-data-unpaid').on('click', getData);


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