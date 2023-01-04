@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="page-body">
      <div class="row">

            <!-- order-card start -->
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Paid Invoices</h6>
                        <h2 class="text-right"><i class="ti-shopping-cart f-left"></i><span id="total_paid"></span></h2>
                        <p class="m-b-0">Todays Payment<span class="f-right" id="today_paid"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Unpaid Invoices</h6>
                        <h2 class="text-right"><i class="ti-tag f-left"></i><span id="total_unpaid" ></span></h2>
                        <p class="m-b-0">Unpdaid Count<span class="f-right" id="today_unpaid"></span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Customers</h6>
                        <h2 class="text-right"><i class="ti-reload f-left"></i><span id="customers"></span></h2>
                       
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Students</h6>
                        <h2 class="text-right"><i class="ti-wallet f-left"></i><span id="students">$9,562</span></h2>
                        
                    </div>
                </div>
            </div>
            <!-- order-card end -->

            <!-- statustic and process start -->
            <div class="col-lg-8 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Statistics</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <canvas id="my-Statistics-chart" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Notifications</h5>
                    </div>
                    <div class="card-block">
                        @foreach ($notifications as $notification) 
                        @if ($notification->type == 'App\Notifications\InvoicePaid')
                        <div class="toast p-1" role="alert" aria-live="assertive" aria-atomic="true" style="background: rgb(207, 206, 206); border-radius: 5px;">
                            <div class="toast-header">
                              
                              <strong class="mr-auto">Paid Invoice</strong>
                              <small>({{ $notification->created_at->format('d/m/Y H:i') }})</small>
                              <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                <span aria-hidden="true" onclick="">&times;</span>
                              </button>
                            </div>
                            <div class="toast-body">
                                @php
                                        
                                $name = 'deleted';

                                $user = App\User::where('id', '=', $notification->data['user'])->first();

                                if ($user) {
                                    $name = $user->name;
                                }
                            @endphp

                                Paid invoice from {{ $name }}, amount <strong> KSH {{ $notification->data['amount'] }}</strong>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- statustic and process end -->
            <!-- tabs card start -->
            <div class="col-sm-12">
                <div class="card tabs-card">
                    <div class="card-block p-0">
                        <!-- Nav tabs -->
                        
                        <!-- Tab panes -->
                        <div class="tab-content card-block">
                            <div class="tab-pane active" id="home3" role="tabpanel">

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Staff Number</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody id="staff">

                                        </tbody>
                                        
                                    </table>
                                </div>
                                <div class="text-center">
                                    <a href="{{ route('staff_index') }}" class="btn btn-outline-primary btn-round btn-sm">Show More</a>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <!-- tabs card end -->

            <!-- social statustic start -->
            <div class="col-md-12 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="fa fa-envelope-open text-c-blue d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-blue">Staff</h4>
                        <p class="m-b-20" id="staffNum">peter</p>
                        <a href="{{ route('staff_index') }}" class="btn btn-primary btn-sm btn-round">Manage List</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="fa fa-twitter text-c-green d-block f-40"></i>
                        <h4 class="m-t-20"><span class="text-c-blgreenue">Vehicles</h4>
                        <p class="m-b-20" id="vehicleNum"></p>
                        <a href="{{ route('vehicles.index') }}" class="btn btn-success btn-sm btn-round">Check them out</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-block text-center">
                        <i class="fa fa-puzzle-piece text-c-pink d-block f-40"></i>
                        <h4 class="m-t-20">Attendance</h4>
                        <p class="m-b-20">Checkout todays attendance</p>
                        <a href="{{ route('attendances.index') }}" class="btn btn-danger btn-sm btn-round">take a look</a>
                    </div>
                </div>
            </div>
            <!-- social statustic end -->

            <!-- users visite and profile start 
            <div class="col-md-4">
                <div class="card user-card">
                    <div class="card-header">
                        <h5>Profile</h5>
                    </div>
                    <div class="card-block">
                        <div class="usre-image">
                            <img src="assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                        </div>
                        <h6 class="f-w-600 m-t-25 m-b-10">Alessa Robert</h6>
                        <p class="text-muted">Active | Male | Born 23.05.1992</p>
                        <hr/>
                        <p class="text-muted m-t-15">Activity Level: 87%</p>
                        <ul class="list-unstyled activity-leval">
                            <li class="active"></li>
                            <li class="active"></li>
                            <li class="active"></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <div class="bg-c-blue counter-block m-t-10 p-20">
                            <div class="row">
                                <div class="col-4">
                                    <i class="ti-comments"></i>
                                    <p>1256</p>
                                </div>
                                <div class="col-4">
                                    <i class="ti-user"></i>
                                    <p>8562</p>
                                </div>
                                <div class="col-4">
                                    <i class="ti-bag"></i>
                                    <p>189</p>
                                </div>
                            </div>
                        </div>
                        <p class="m-t-15 text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                        <hr/>
                        <div class="row justify-content-center user-social-link">
                            <div class="col-auto"><a href="#!"><i class="fa fa-facebook text-facebook"></i></a></div>
                            <div class="col-auto"><a href="#!"><i class="fa fa-twitter text-twitter"></i></a></div>
                            <div class="col-auto"><a href="#!"><i class="fa fa-dribbble text-dribbble"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Activity Feed</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-refresh reload-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <ul class="feed-blog">
                            <li class="active-feed">
                                <div class="feed-user-img">
                                    <img src="assets/images/avatar-3.jpg" class="img-radius " alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-danger">File</span> Eddie uploaded new files: <small class="text-muted">2 hours ago</small></h6>
                                <p class="m-b-15 m-t-15">hii <b> @everone</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                <div class="row">
                                    <div class="col-auto text-center">
                                        <img src="assets/images/blog/blog-r-1.jpg" alt="img" class="img-fluid img-100">
                                        <h6 class="m-t-15 m-b-0">Old Scooter</h6>
                                        <p class="text-muted m-b-0"><small>PNG-100KB</small></p>
                                    </div>
                                    <div class="col-auto text-center">
                                        <img src="assets/images/blog/blog-r-2.jpg" alt="img" class="img-fluid img-100">
                                        <h6 class="m-t-15 m-b-0">Wall Art</h6>
                                        <p class="text-muted m-b-0"><small>PNG-150KB</small></p>
                                    </div>
                                    <div class="col-auto text-center">
                                        <img src="assets/images/blog/blog-r-3.jpg" alt="img" class="img-fluid img-100">
                                        <h6 class="m-t-15 m-b-0">Microphone</h6>
                                        <p class="text-muted m-b-0"><small>PNG-150KB</small></p>
                                    </div>
                                </div>
                            </li>
                            <li class="diactive-feed">
                                <div class="feed-user-img">
                                    <img src="assets/images/avatar-4.jpg" class="img-radius " alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-success">Task</span>Sarah marked the Pending Review: <span class="text-c-green"> Trash Can Icon Design</span><small class="text-muted">2 hours ago</small></h6>
                            </li>
                            <li class="diactive-feed">
                                <div class="feed-user-img">
                                    <img src="assets/images/avatar-2.jpg" class="img-radius " alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-primary">comment</span> abc posted a task:  <span class="text-c-green">Design a new Homepage</span>  <small class="text-muted">6 hours ago</small></h6>
                                <p class="m-b-15 m-t-15"hii <b> @everone</b> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </li>
                            <li class="active-feed">
                                <div class="feed-user-img">
                                    <img src="assets/images/avatar-3.jpg" class="img-radius " alt="User-Profile-Image">
                                </div>
                                <h6><span class="label label-warning">Task</span>Sarah marked : <span class="text-c-green"> do Icon Design</span><small class="text-muted">10 hours ago</small></h6>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            -->
            <!-- users visite and profile end -->

        </div>
    </div>

    <div id="styleSelector">

    </div>
</div>
@endsection


@section('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script defer>
        $(document).ready( function () {

            function headerData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('header-data') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        
                        $('#total_paid').text(response["total_paid"]);
                        $('#today_paid').text(response["total_today_paid"]);
                        $('#total_unpaid').text(response["total_unpaid"]);
                        $('#today_unpaid').text(response["unpaidCount"]);
                        $('#customers').text(response["parentsNum"]);
                        $('#students').text(response["studentsNum"]);
                        
                        

                    }
                });     
            }

            function staffTableData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('officestaff-data') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                       
                        $('#staff').html(response);

                    }
                });     
            }


            function getStaffVehicleNum() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('vehiclestaffnum') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                       $('#staffNum').text(response['staff_num']);
                       $('#vehicleNum').text(response['vehicle_num']);
                    }
                });     
            }



            function chartData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('chart-data') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        
                        var arr = [];
                 
                        const ctx = document.getElementById('my-Statistics-chart').getContext('2d');

                        
        
                        const myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sept', 'oct', 'nov', 'dec'],
                            datasets: [{
                                label: 'Paid Invoices This Year',
                                data: response["totals"],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 159, 64, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    console.log

                    }
                });     
            }

            headerData();
            chartData();
            staffTableData();
            getStaffVehicleNum();
            

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