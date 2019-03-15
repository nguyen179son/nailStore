<table class="table table-striped table-hover" id="drop-in-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Service</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
        @foreach($data as $key => $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td><a href="#">{{ $row->name }}</a></td>
                <td>{{ $row->telephone }}</td>
                <td><span class="badge badge-secondary">{{ $row->type }}</span></td>
                <td>
                    <select class="form-control form-control-lg dropdown-status" id="{{$row->id}}">
                        <option value="wating" {{$row->status=='wating'?'selected':''}}>
                            waiting
                        </option>
                        <option value="doing" {{$row->status=='doing'?'selected':''}}>
                            doing
                        </option>
                        <option value="done" {{$row->status=='done'?'selected':''}}>
                            done
                        </option>
                        <option value="removed" {{$row->status=='removed'?'selected':''}}>
                            removed
                        </option>
                    </select>
                </td>
                <td>
                    <a href="#" class="settings" title="Send a message" data-toggle="tooltip" data-telephone="{{$row->telephone}}">
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