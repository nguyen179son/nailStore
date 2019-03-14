<table class="table table-striped table-hover" id="drop-in-queue-table">
    <thead>
    <tr>
        <th>#</th>
        <th class="max-width-300px">Name</th>
        <th class="max-width-300px">Phone</th>
        <th class="max-width-250px">Service</th>


    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
    @foreach($data as $key => $row)
        <tr>
            <td>{{ ($data->currentPage()-1)*10+$row->id+101 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->telephone }}</td>
            <td>{{ $row->type }}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>
{!! $data->links() !!}