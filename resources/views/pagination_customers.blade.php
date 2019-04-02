<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="10%">Code</th>
        <th width="20%">Name</th>
        <th width="20%">Phone</th>
        <th width="30%">Email</th>
        <th width="10%">Times</th>
        <th width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($members) && !empty($members))
        @foreach ($members as $key => $member)
            <tr style="word-break: break-all">
                <td>{{ $member->customer_code }}</td>
                <td ><a href="#" data-toggle="modal" data-target="#history-modal" data-id="{{$member->id}}"
                                          class="member-name" style="text-decoration: underline;">
                        {{ ucwords(trim($member->name, "\"")) }}
                    </a>
                </td>
                <td>{{$member->phone_number}}
                </td>
                <td>{{$member->email}}
                </td>
                <td>{{$member->point}}</td>
                <td>
                    <a href="sms:{{$member->phone_number}}?body=" class="settings" title="Send a message" data-toggle="tooltip"
                       data-telephone="{{$member->phone_number}}">
                        <i class="material-icons">textsms</i>
                    </a>
                    <a href="#" class="add-history" data-name="{{ ucwords(trim($member->name, "\"")) }}" data-email="{{$member->email}}"
                       data-id="{{$member->id}}" data-phone="{{$member->phone_number}}" data-toggle="modal" data-target="#add-history-modal" style="color: #007bff">
                        <i class="material-icons">playlist_add</i>
                    </a>

                    {{--<a href="sms:{{$member->telephone}}?body=Hej%20{{$row->name}},%20please%20be%20back%20to%20Labella%20within%2010%20minutes%20!" class="settings" title="Send a message" data-toggle="tooltip"--}}
                       {{--data-telephone="{{$row->telephone}}">--}}
                        {{--<i class="material-icons">textsms</i>--}}
                    {{--</a>--}}
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>

{!! $members->links() !!}