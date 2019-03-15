<table class="table table-striped table-hover" id="drop-in-queue-table">
    <thead>
    <tr>
        <th width="10%">#</th>
        <th width="50%">Name</th>
        <th width="20%">Phone</th>
        <th width="20%">Service</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
    @foreach($data as $key => $row)
        <tr style="word-break: break-all">
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