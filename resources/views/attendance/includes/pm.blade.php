<table class="table table-striped" style="border: 1px solid gray;" id="pmattendance">
    <thead style="background-color: #0071f3; color: #fff">
        <tr>
        
            <th>First Name</th>
            <th>Last Name</th>
            <th>Grade</th>
            <th>Vehicle</th>

            <th>Driver</th>
            <th>Date</th>
            
        </tr>
    </thead>
    <tbody >
        @foreach ($attendancePm as $item)
            @php
                $vehicle = App\Vehicle::where('id', '=', $item->vehicle_id)->first();
                $student = App\Student::where('id', '=', $item->student_id)->first();
                $driver = App\User::where('id', '=', $item->driver_id)->first();
            @endphp
            <tr>
                <td>{{ $student->first_name }}</td>
                <td>{{ $student->last_name }}</td>
                <td>{{ $student->grade }}</td>
                <td>{{ $vehicle->title }} {{ $vehicle->plate_num }}</td>
                <td>{{ $vehicle->driver->name }}</td>
                <td>{{ $item->created_at }}</td>
            </tr>
        @endforeach
        
    </tbody>

    
</table>