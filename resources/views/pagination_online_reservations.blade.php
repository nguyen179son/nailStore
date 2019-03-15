<table class="table table-striped table-hover" id="booking-queue-table">
    <thead>
    <tr>
        <th>#</th>
        <th class="max-width-300px">Name</th>
        <th class="max-width-300px">Phone</th>
        <th class="max-width-300px">Time</th>
        <th class="max-width-250px">Service</th>


    </tr>
    </thead>
    <tbody>

    @foreach($data as $key => $row)
        <tr>
            <td>{{ ($data->currentPage()-1)*10+$row->id+101 }}</td>
            <td>{{ ucwords(json_decode($row->customer_name)) }}</td>
            <td>{{ $row->telephone }}</td>
            <td>{{ explode(' ',$row->reservation_time)[1] }}</td>
            <td>{{ $row->service_type }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
{!! $data->links() !!}