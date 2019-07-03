<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog cascading-modal" role="document">
        <div class="modal-content">
            <div class="modal-c-tabs">
                <ul class="justify-content-center nav nav-tabs md-tabs tabs-2 darken-3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#panelLogin" role="tab" id="tab-login">
                            <i class="fas fa-user mr-1"></i>
                            Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#panelRegister" role="tab" id="tab-signup"><i
                                    class="fas fa-user-plus mr-1"></i>
                            Sign Up</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade" id="panelRegister" role="tabpanel">
                        <div class="card">
                            <article class="card-body">
                                <form method="POST" id="formRegister">
                                    @csrf
                                    <div class="form-group">
                                        <h2 class="heading-title">Sign Up For Free</h2>
                                    </div>
                                    <div class="form-row">
                                        <div class="col form-group">
                                            <!-- <label>First name </label> -->
                                            <input id="first_name" type="text"
                                                   class="form-control"
                                                   name="first_name"
                                                   value="{{ old('first_name') }}" required
                                                   autocomplete="first_name" autofocus placeholder="First Name">

                                            <span class="text-danger">
                                                    <strong id="error-firstname"></strong>
                                                </span>
                                        </div>
                                        <div class="col form-group">
                                            <!-- <label>Last name</label> -->
                                            <input id="last_name" type="text"
                                                   class="form-control"
                                                   name="last_name"
                                                   value="{{ old('last_name') }}" required autocomplete="last_name"
                                                   autofocus placeholder="Last Name">


                                            <span class="text-danger">
                                                    <strong id="error-lastname"></strong>
                                                </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Email address</label> -->
                                        <input id="email" type="email"
                                               class="form-control"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="email"
                                               placeholder="Email Address">

                                        <span class="text-danger">
                                                <strong id="error-email"></strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Set a password</label> -->
                                        <input id="password" type="password"
                                               class="form-control"
                                               name="password"
                                               required autocomplete="new-password" placeholder="Set a password">

                                        <span class="text-danger">
                                                <strong id="error-password"></strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Confirm password</label> -->

                                        <input id="password-confirm" type="password" class="form-control"
                                               name="password_confirmation" required autocomplete="new-password"
                                               placeholder="Confirm Password">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Phone</label> -->
                                        <input id="phone" type="text"
                                               class="form-control"
                                               name="phone"
                                               required value="{{ old('phone') }}"
                                               autocomplete="phone" placeholder="Phone Number"
                                               id="phone">
                                        <span class="text-danger">
                                                <strong id="error-phone"></strong>
                                            </span>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block custom-btn"
                                                id="submitFormSignUp">GET STARTED
                                        </button>
                                    </div>
                                </form>
                            </article>
                        </div>
                    </div>
                    <div class="tab-pane fade in show active" id="panelLogin" role="tabpanel">
                        <div class="card">
                            <article class="card-body">
                                <form method="POST" id="formLogin">
                                    @csrf
                                    <div class="form-group">
                                        <!-- <label>Email address</label> -->
                                        <!-- <span class="second-letter">*</span> -->
                                        <input id="emailLogin" type="email"
                                               class="form-control"
                                               name="email"
                                               value="{{ old('email') }}" required autocomplete="email"
                                               placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <!-- <label>Password</label> -->
                                        <!-- <span class="second-letter">*</span> -->
                                        <input id="passwordLogin" type="password"
                                               class="form-control"
                                               name="password"
                                               required autocomplete="new-password" placeholder="Password">

                                        <span class="text-danger">
                                                <strong id="error-passwordLogin"></strong>
                                            </span>
                                    </div>
                                    <span class="text-danger">
                                                <strong id="error-emailLogin"></strong>
                                            </span>
                                    <span class="text-success">
                                            <strong id="activate"></strong>
                                        </span>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block custom-btn"
                                                id="submitFormLogin">LOGIN
                                        </button>
                                    </div>
                                </form>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>