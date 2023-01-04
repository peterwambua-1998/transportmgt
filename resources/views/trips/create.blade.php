@extends('layouts.app')
@section('css')

<style>
   #map {
        height: 100%;
        width: 100%;
        border-radius: 10px;
    }

    .div-map {
        height: 80vh;
        width: 100%;
        
    }
</style>
@endsection
@section('content')

<div class="page-wrapper">

    <div class="page-header card">
        <div class="card-block">
            <h5 class="m-b-10">Create Trips</h5>
            <p class="text-muted m-b-10">Add Trips to route by filling the form</p>
            <ul class="breadcrumb-title b-t-default p-t-10">
                <li class="breadcrumb-item">
                    <a href="index.html"> <i class="fa fa-home"></i> </a>
                </li>
                <li class="breadcrumb-item"><a href="#!">Trips</a></li>
                <li class="breadcrumb-item"><a href="#!">Create</a></li>
            </ul>
        </div>
    </div>


    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-block">
                    <form action="{{ route('trips.store') }}" method="POST" >
                        @csrf 
                        <h5 class="mb-3 mt-3">Trip Details</h5>
                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="title">Trip Title</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Trip Title">
                          </div>

                          <div class="form-group col-md-6">
                            <label for="title"></label>
                            <label for="inputState">Select AM OR PM</label>
                            <select id="inputState" class="form-control" name="route_time">
                                <option selected value="am">am</option>
                                <option value="pm">pm</option>
                                  
                            </select>
                          </div>
                          
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="platenum">From</label>
                                <input type="time" name="from" class="form-control" id="platenum" placeholder="from">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="platenum">To</label>
                                <input type="time" name="to" class="form-control" id="platenum" placeholder="to">
                            </div>
                        </div>

                        
                        <input type="hidden" name="route_id" value="{{ $route->id }}">

                        
                        
           
                        <button type="submit" class="btn btn-block" id="save-fence" style="background:#0071f3">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection


@section('js')


<script defer>



</script>
@endsection