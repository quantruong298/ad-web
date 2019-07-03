@if(isset($products) && sizeof($products)>0)
    <table class="table table-hover">
        <thead>
        <tr class="table-info">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Catalog</th>
            @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)
                <th scope="col">User</th>@endif
            {{--            <th scope="col">Campaign</th>--}}
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{number_format($product->price) }}</td>
                <td>{{ $product->quantity }}</td>
                <td><img src="{{ $product->image }}" class="img-fluid img-thumbnail" alt="Responsive image"></td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->cname}}</td>
                @if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)
                    <td>{{ $product->uname }}</td>@endif
                {{--                <td>{{$product->TotalCampaign}}</td>--}}
                <td width="10%" class="btn-group">
                    <button type="button" class="btn-sm btn-primary" onclick="edit({{$product->id}})">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn-sm btn-danger" onclick="del('/product/{{$product->id}}')">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
@else
    <br/>
    <h3>No result</h3>
@endif