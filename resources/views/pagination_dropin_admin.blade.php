<table class="table table-striped table-hover" id="drop-in-table">
    <thead>
    <tr>
        <th width="7%">#</th>
        <th width="25%">Name</th>
        <th width="20%">Phone</th>
        <th width="20%">Service</th>
        <th width="15%">Status</th>
        <th width="13%">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
        @foreach($data as $key => $row)
            <tr style="word-break: break-all">
                <td>{{ ($data->currentPage()-1)*10+$row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->telephone }}</td>
                <td><span class="badge badge-secondary" data-email="{{$row->email}}" data-name="{{$row->name}}">{{ $row->type }}</span></td>
                <td>
                    <select class="form-control form-control-lg dropdown-status" id="{{$row->id}}">
                        <option  data-email="{{$row->email}}" data-name="{{$row->name}}" value="wating" {{$row->status=='wating'?'selected':''}}>
                            waiting
                        </option>
                        <option  data-email="{{$row->email}}" data-name="{{$row->name}}" value="wating" {{$row->status=='checked-in'?'selected':''}}>
                            checked-in
                        </option>
                        <option  data-email="{{$row->email}}" data-name="{{$row->name}}" value="done" {{$row->status=='done'?'selected':''}}>
                            done
                        </option>
                    </select>
                </td>
                <td>
                    <a href="sms:{{$row->telephone}}&body=Hej {{ucwords(json_decode($row->name))}}, please be back to Labella within 10 minutes !" class="settings" title="Send a message" data-toggle="tooltip"
                       data-telephone="{{$row->telephone}}">
                        <i class="material-icons">textsms</i>
                    </a>
                    <a href="#" class="delete" title="Remove" data-toggle="modal" data-target="#confirm-delete" id="{{$row->id}}">
                        <i class="material-icons">&#xE5C9;</i>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{!! $data->links() !!}