<table class="table table-hover">
    <thead>
    <tr class="table-info">
        <th scope="col" width="10%">#</th>
        <th scope="col" width="30%">Email</th>
        <th scope="col" width="30%">Fullname</th>
        <th scope="col" width="20%">Phone</th>
        <th scope="col" width="10%">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->email }}</td>
            <td>{{ $user->fullname }}</td>
            <td>{{ $user->phone_number }}</td>
            <td class="btn-group">
                <button type="button" class="btn-sm btn-primary" onclick="getInfoUserById( {{ $user->id  }} )"><i
                            class="fa fa-edit"></i>
                </button>
                <button type="button" class="btn-sm btn-danger" onclick="deleteUser( {{ $user->id }} ) ;"><i
                            class="fa fa-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}