<table class="table table-striped table-hover" id="booking-queue-table">
    <thead>
    <tr>
        <th width="10%">#</th>
        <th width="30%">Name</th>
        <th width="30%">Phone</th>
        <th width="15%">Time</th>
        <th width="15%">Service</th>


    </tr>
    </thead>
    <tbody>

    @foreach($data as $key => $row)
        <tr style="word-break: break-all">
            <td>{{ ($data->currentPage()-1)*10+$row->id+101 }}</td>
            <td>{{ ucwords(json_decode($row->customer_name)) }}</td>
            <td>{{ substr($row->mobile, 0, 4) . '****' . substr($row->mobile,  -4)}}</td>
            <td>{{ explode(' ',$row->reservation_time)[1] }}</td>
            <td>{{ $row->service_type }}</td>
        </tr>
    @endforeach

    </tbody>
</table>
{!! $data->links() !!}