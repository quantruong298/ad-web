<div class="row d-flex justify-content-center modalWrapper">
    <div class="modal fade addNewInputs" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEdit"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Edit User Form</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form id="formEdit">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" id="id-edit">
                        </div>
                        <div class="form-group">
                            <p>Full name</p>
                            <input id="fullname-edit"
                                   type="text"
                                   class="form-control"
                                   name="full_name"
                                   value="{{ old('full_name') }}" required
                                   autocomplete="full_name" autofocus placeholder="Full Name">
                            <span class="text-danger">
                                <strong id="error-fullname-edit"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Email</p>
                            <input id="email-edit"
                                   type="email"
                                   class="form-control"
                                   name="email"
                                   value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="Email Address" readonly>
                            <span class="text-danger">
                                <strong id="error-email-edit"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <p>Phone</p>
                            <input id="phone-edit"
                                   type="text"
                                   class="form-control"
                                   name="phone"
                                   required value="{{ old('phone') }}"
                                   autocomplete="phone" placeholder="Phone Number">
                            <span class="text-danger">
                                <strong id="error-phone-edit"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"
                                    id="submitFormEdit" disabled="true">GET STARTED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>