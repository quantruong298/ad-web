@csrf
<div class="form-group">
    <input id="name-add"
           type="text"
           class="form-control"
           name="name"
           value="" required
           placeholder="Name">
    <span class="text-danger">
      <strong id="error-name-add"></strong>
    </span>
</div>
<div class="form-group">
    <input id="price-add"
           type="number"
           class="form-control money"
           name="price"
           required
           placeholder="Price">
    <span class="text-danger">
        <strong id="error-price-add"></strong>
    </span>
</div>
<div class="form-group">
    <input id="quantity-add"
           type="number"
           data-a-dec=","
           class="form-control"
           name="quantity"
           required value=""
           placeholder="Quantity" >
    <span class="text-danger">
        <strong id="error-quantity-add"></strong>
    </span>
</div>
<div class="form-group">
    <textarea placeholder="Description" class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
    <span class="text-danger">
        <strong id="error-description-add"></strong>
    </span>
</div>
<div class="form-group">
    <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1" onchange="loadImage(this);">
    <img src="http://s3-img.pixpa.com/local/800/dummy-image.jpg" id="pimage" class="img-fluid img-thumbnail" alt="Responsive image">
    <span class="text-danger">
        <strong id="error-image-add"></strong>
    </span>
</div>
<div class="form-group">
    <select required class="form-control" id="exampleFormControlSelect1" name="catalog_id">
        <option disabled selected>Categories</option>
        @foreach($catalogs as $catalog)
            <option value="{{$catalog->id}}">{{$catalog->name}}</option>
        @endforeach
    </select>
    <span class="text-danger">
        <strong id="error-catalog-add"></strong>
    </span>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block"
            id="submitFormAdd">CREATE
    </button>
</div>