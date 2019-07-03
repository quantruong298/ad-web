@csrf
<div class="form-group">
    <input type="hidden" class="form-control" name="id" value="{{$catalog->id}}">
</div>
<div class="form-group">
    <p>Name</p>
    <input id="name-edit"
           type="text"
           class="form-control"
           name="name"
           value="{{$catalog->name}}" required
           placeholder="Name">
    <span class="text-danger">
      <strong id="error-name-edit"></strong>
   </span>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary btn-block"
            id="submitFormEdit">UPDATE
    </button>
</div>
