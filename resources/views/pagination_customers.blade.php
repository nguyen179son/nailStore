<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="10%">#</th>
        <th width="40%">Name</th>
        <th width="40%">Email</th>
        <th width="10%">Times</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($members) && !empty($members))
        @foreach ($members as $key => $member)
            <tr style="word-break: break-all">
                <td>{{ ($members->currentPage()-1)*10+$key+1 }}</td>
                <td ><a href="#" data-toggle="modal" data-target="#history-modal" data-id="{{$member->id}}"
                                          class="member-name" style="text-decoration: underline;">
                        {{ ucwords(trim($member->name, "\"")) }}
                    </a>
                </td>
                <td>{{$member->email}}
                </td>
                <td>{{$member->point}}</td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>

{!! $members->links() !!}