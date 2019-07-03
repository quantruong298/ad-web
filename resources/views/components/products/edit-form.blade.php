@csrf
<div class="form-group">
    <input type="hidden" class="form-control" name="pid" value="{{$product->id}}">
</div>
<div class="form-group">
    <p>Name</p>
    <input id="name-edit"
           type="text"
           class="form-control"
           name="name"
           value="{{$product->name}}" required
           placeholder="Name">
    <span class="text-danger">
      <strong id="error-name-edit"></strong>
   </span>
</div>
<div class="form-group">
    <p>Price</p>
    <input id="price-edit"
           type="number"
           class="form-control"
           name="price"
           value="{{$product->price}}" required
           placeholder="Price">
    <span class="text-danger">
        <strong id="error-price-edit"></strong>
    </span>
</div>
<div class="form-group">
    <p>Quantity</p>
    <input id="quantity-edit"
           type="number"
           class="form-control"
           name="quantity"
           required value="{{$product->quantity}}"
           placeholder="Quantity">
    <span class="text-danger">
        <strong id="error-quantity-edit"></strong>
    </span>
</div>
<div class="form-group">
    <p>Description</p>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">{{$product->description}}</textarea>
    <span class="text-danger">
        <strong id="error-description-edit"></strong>
    </span>
</div>
<div class="form-group">
    <p>Image</p>
    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" onchange="loadImage(this);">
    <img src="{{$product->image}}" class="img-fluid img-thumbnail" alt="Responsive image" id="pimage">
    <span class="text-danger">
        <strong id="error-image-edit"></strong>
    </span>
</div>
<div class="form-group">
    <p>Catalog</p>
    <select class="form-control" id="exampleFormControlSelect1" name="catalog_id">
        @if($product->catalog_id==0)<option disabled selected>Categories</option>@endif
        @foreach($catalogs as $catalog)
            <option @if($catalog->id==$product->catalog_id)selected @endif value="{{$catalog->id}}">{{$catalog->name}}</option>
        @endforeach
    </select>
    <span class="text-danger">
        <strong id="error-catalog-edit"></strong>
    </span>
</div>
@if(\Illuminate\Support\Facades\Auth::user()->role_id==\App\Enum\UserRoles::ADMIN)
    <div class="form-group">
        <p>User</p>
        <input type="text"
               class="form-control"
               name="User"
               value="{{$product->uname}}"
               disabled>
        <span class="text-danger">
        <strong id="error-user-edit"></strong>
    </span>
    </div>
@endif
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block"
            id="submitFormEdit">UPDATE
    </button>
</div>
