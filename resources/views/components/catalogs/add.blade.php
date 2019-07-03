<div class="row d-flex justify-content-center modalWrapper">
    <div class="modal fade addNewInputs" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Create New Catalog</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="POST" id="formAdd" name="formAdd">
                        @csrf
                        <div class="form-group">
                            <input id="name-edit"
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
                            <button type="submit" class="btn btn-primary btn-block"
                                    id="submitFormAdd">CREATE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>