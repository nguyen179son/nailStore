<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Times</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($members) && !empty($members))
        @foreach ($members as $key => $member)
            <tr>
                <td>{{ ($members->currentPage()-1)*10+$key+1 }}</td>
                <td ><a href="#" data-toggle="modal" data-target="#history-modal" data-id="{{$member->id}}"
                                          class="member-name word-break">{{ ucwords(trim($member->name, "\"")) }}</a></td>
                <td class="word-break">{{$member->email}}
                </td>
                <td>{{$member->point}}</td>
            </tr>
        @endforeach
    @endif

    </tbody>
</table>

{!! $members->links() !!}