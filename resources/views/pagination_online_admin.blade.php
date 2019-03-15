<table class="table table-striped table-hover" id="booking-table">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Service</th>
        <th>Notice</th>
        <th>Time</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
        @foreach($data as $key => $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td><a href="#">{{ ucwords(json_decode($row->customer_name)) }}</a></td>
{{--                <td>{{ $row->telephone }}</td>--}}
                <td>{{ $row->mobile }}</td>
                <td><span class="badge badge-secondary">{{ $row->service_type }}</span></td>
                <td>{{ $row->notice }}</td>
                <td>{{ explode(' ',$row->reservation_time)[1] }}</td>
                <td>
                    <select class="form-control form-control-lg dropdown-status" id="{{$row->id}}" data-email="{{$row->email}}" data-name="{{$row->customer_name}}">
                        <option  data-email="{{$row->email}}" data-name="{{$row->customer_name}}" value="waiting" {{$row->status=='waiting'?'selected':''}}>
                            waiting
                        </option>
                        <option  data-email="{{$row->email}}" data-name="{{$row->customer_name}}" value="doing" {{$row->status=='doing'?'selected':''}}>
                            doing
                        </option>
                        <option  data-email="{{$row->email}}" data-name="{{$row->customer_name}}" value="done" {{$row->status=='done'?'selected':''}}>
                            done
                        </option>
                        <option  data-email="{{$row->email}}" data-name="{{$row->customer_name}}" value="removed" {{$row->status=='removed'?'selected':''}}>
                            removed
                        </option>
                    </select>
                </td>
                <td>
                    <a href="sms:{{$row->mobile}}&body=Hej {{ucwords(json_decode($row->customer_name))}}, please be back to Labella within 10 minutes !" class="settings" title="Send a message" data-toggle="tooltip"
                       data-telephone="{{$row->mobile}}">
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
