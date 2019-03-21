<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="10%">Code</th>
        <th width="40%">Name</th>
        <th width="40%">Email</th>
        <th width="5%">Times</th>
        <th width="5%">Add</th>
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
                <td>{{$member->email}}
                </td>
                <td>{{$member->point}}</td>
                <td>
                    <a href="#" class="add-history" data-name="{{ ucwords(trim($member->name, "\"")) }}" data-email="{{$member->email}}"
                       data-id="{{$member->id}}" data-toggle="modal" data-target="#add-history-modal" style="color: #007bff">
                        <i class="material-icons">playlist_add</i>
                    </a>
                </td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>

{!! $members->links() !!}