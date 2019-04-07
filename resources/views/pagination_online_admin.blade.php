<table class="table table-striped table-hover" id="booking-table">
    <thead>
    <tr>
        <th width="5%">Code</th>
        <th width="17%">Name</th>
        <th width="15%">Phone</th>
        <th width="10%">Service</th>
        <th width="15%">Notice</th>
        <th width="13%">Time</th>
        <th width="10%">Status</th>
        <th width="15%">Action</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($data) && !empty($data))
        @foreach($data as $key => $row)
            <tr style="word-break: break-all">
                <td>{{ $row->code  }}</td>
                @if($row->discount && $row->status!='done')
                    <td class="red-text">
                        {{ ucwords(json_decode($row->customer_name)) }}<i class='material-icons'>card_giftcard</i>
                    </td>
                @else
                    <td>
                        {{ ucwords(json_decode($row->customer_name)) }}
                    </td>
                @endif
{{--                <td>{{ ucwords(json_decode($row->customer_name)) }}</td>--}}
                <td>{{ $row->mobile }}</td>

                <!-- <td><span class="badge badge-secondary">{{ $row->service_type }}</span></td> -->

                @if($row->service_type == 'Fransar')
                <td><span class="badge badge-warning">{{ $row->service_type }}</span></td>
                @else
                <td><span class="badge badge-secondary">{{ $row->service_type }}</span></td>
                @endif


                <td>{{ ucwords(json_decode($row->notice) }}</td>
                <td>{{ substr(explode(' ',$row->reservation_time)[1], 0, 5) }}</td>
                <td>
                    <select class="form-control form-control-lg dropdown-status" id="{{$row->id}}" data-email="{{$row->mobile}}" data-name="{{$row->customer_name}}">
                        <option  data-email="{{$row->telephone}}" data-name="{{$row->customer_name}}" value="waiting" {{$row->status=='waiting'?'selected':''}}>
                            waiting
                        </option>
                        <option  data-email="{{$row->telephone}}" data-name="{{$row->customer_name}}" value="checked-in" {{$row->status=='checked-in'?'selected':''}}>
                            checked-in
                        </option>
                        <option  data-email="{{$row->telephone}}" data-name="{{$row->customer_name}}" value="done" {{$row->status=='done'?'selected':''}}>
                            done
                        </option>
                        <option  data-email="{{$row->telephone}}" data-name="{{$row->customer_name}}" value="not come" {{$row->status=='not come'?'selected':''}}>
                            not come
                        </option>
                    </select>
                </td>
                <td>
                    @if($row->status != "done")
                        <a href="sms:{{$row->mobile}}?body=Hej%20{{ucwords(json_decode($row->customer_name))}},%20please%20be%20back%20to%20Labella%20within%2010%20minutes%20!" class="settings" title="Send a message" data-toggle="tooltip"
                           data-telephone="{{$row->mobile}}">
                            <i class="material-icons">textsms</i>
                        </a>

                        <a href="tel:{{$row->mobile}}" class="settings" title="Make a phone call">
                            <i class="material-icons">phone</i>
                        </a>

                    @endif
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
