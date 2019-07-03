<table class="table table-hover">
    <thead>
    <tr class="table-info">
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($catalogs as $catalog)
        <tr>
            <th scope="row">{{ $catalog->id }}</th>
            <td>{{ $catalog->name }}</td>
            <td>
                <button type="button" class="btn-sm btn-primary" onclick="edit('/catalog/{{ $catalog->id  }}/edit ')"><i
                            class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn-sm btn-danger btn-delete" onclick="del('/catalog/{{ $catalog->id }}')"><i
                            class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>