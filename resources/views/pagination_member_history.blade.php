<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>Service</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($entries) && !empty($entries))
        @foreach ($entries as $key => $entry)
            <tr>
                <td>{{ ($entries->currentPage()-1)*10+$key+1 }}</td>
                <td>{{$entry->updated_at}}</td>
                <td>{{$entry->service_type}}
                </td>
                <td>{{$entry->status}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

{!! $entries->links() !!}