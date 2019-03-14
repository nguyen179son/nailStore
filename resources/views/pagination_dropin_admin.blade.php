<table class="table table-striped table-hover" id="drop-in-queue-table">
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
    <td>1</td>
    <td><a href="#">Michael Holz</a></td>
    <td>076465507334</td>
    <td><span class="badge badge-secondary">Finger nail</span></td>
    <td>
        <div class="dropdown">
            <button class="btn dropdown-toggle status-waiting" type="button" id="dropdownMenuButton"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="status">&bull;</span> waiting
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item status-waiting" onclick="changeStatus(this, 'waiting');"><span class="status">&bull;</span>
                    waiting</a>
                <a class="dropdown-item status-doing" onclick="changeStatus(this, 'doing');"><span
                            class="status">&bull;</span> doing</a>
                <a class="dropdown-item status-done" onclick="changeStatus(this, 'done');"><span
                            class="status">&bull;</span> done</a>
                <a class="dropdown-item status-removed" onclick="changeStatus(this, 'removed');"><span class="status">&bull;</span>
                    removed</a>
            </div>
        </div>
    </td>
    <td>
        <a href="#" class="settings" title="Send a message" data-toggle="tooltip">
            <i class="material-icons">textsms</i>
        </a>
        <a href="#" class="delete" title="Remove" data-toggle="tooltip">
            <i class="material-icons">&#xE5C9;</i>
        </a>
    </td>
    @if(isset($data) && !empty($data))
        @foreach($data as $key => $row)
            <tr>
                <td>{{ ($data->currentPage()-1)*10+$key }}</td>
                <td><a href="#">{{ $row->name }}</a></td>
                <td>{{ $row->telephone }}</td>
                <td>{{ $row->type }}</td>
                <td>{{ $row->status }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
{!! $data->links() !!}