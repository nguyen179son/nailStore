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
        <tr style="word-break: break-all"
            {{--data-toggle="modal" data-target="#fill-in-code" --}}
            onclick=showModalEnterCode(this)
            data-phone="{{$row->telephone}}" data-id="{{$row->id}}">
            <td>{{ ($data->currentPage()-1)*10+$key+121 }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ substr($row->telephone, 0, 4) . '****' . substr($row->telephone,  -4)}}</td>
            <td>{{ $row->type }}</td>
        </tr>
    @endforeach
    @endif
    </tbody>
</table>
{!! $data->links() !!}