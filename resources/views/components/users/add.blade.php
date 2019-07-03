<div class="row d-flex justify-content-center modalWrapper">
    <div class="modal fade addNewInputs" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modalAdd"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Create New User Form</h4>
                    <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <form method="POST" id="formAdd">
                        @csrf
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="full_name"
                                   value="{{ old('full_name') }}" required
                                   autocomplete="full_name" autofocus placeholder="Full Name"
                                   id="full_name_add">
                            <span class="text-danger">
                                <strong id="error-fullname-add"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="email"
                                   class="form-control"
                                   name="email_add"
                                   value="{{ old('email') }}" required autocomplete="email"
                                   placeholder="Email Address"
                                   id="email_add">
                            <span class="text-danger">
                                <strong id="error-email-add"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password"
                                   class="form-control"
                                   name="password"
                                   required autocomplete="new-password" placeholder="Set a password" id="password-add">
                            <span class="text-danger">
                                <strong id="error-password-add"></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control"
                                   name="password_confirmation" required autocomplete="new-password"
                                   placeholder="Confirm Password">
                        </div>
                        <div class="form-group">
                            <input type="text"
                                   class="form-control"
                                   name="phone_add"
                                   required value="{{ old('phone') }}"
                                   autocomplete="phone" placeholder="Phone Number" id="phone_add">
                            <span class="text-danger">
                                <strong id="error-phone-add"></strong>
                            </span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"
                                    id="submitFormAdd">GET STARTED
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>