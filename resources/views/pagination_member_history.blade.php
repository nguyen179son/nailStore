<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="5%">#</th>
        <th width="20%">Date</th>
        <th width="15%">Service</th>
        <th width="10%">Status</th>
        <th width="20%">Staff</th>
        <th width="15%">Note</th>
        <th width="5%">Receipt</th>
    </tr>
    </thead>
    <tbody>
    @if (isset($entries) && !empty($entries))
        @foreach ($entries as $key => $entry)
            <tr>
                <td>{{ ($entries->currentPage()-1)*10+$key+1 }}</td>
                <td>{{$entry->updated_at}}</td>
                <td>{{$entry->service_type}}</td>
                <td>{{$entry->status}}</td>
                <td>{{$entry->staff}}</td>
                <td>{{$entry->note}}</td>
                <td>
                    {{--{{$entry->receipt}}--}}
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

{!! $entries->links() !!}