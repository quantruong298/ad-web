<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/488ad36053.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Styles -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mdb.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8" async></script>
    <script src="{{ asset('js/autoNumeric.js') }}" async></script>
    <script src="{{ asset('js/app.js') }}" async></script>
    <script src="{{ asset('js/notify.min.js') }}" async></script>
    <script src="{{ asset('js/popper.min.js') }}" async></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" async></script>
    <script src="{{ asset('js/mdb.js') }}" async></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>

<body>
    <div id="app">
        @yield('content')
    </div>
</body>

</html>
<script type="text/javascript">
    $(document).ready(function() {
        var validateRegister = $("#formRegister").validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 255,
                },
                last_name: {
                    required: true,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 255,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                },
                phone: {
                    required: true,
                }
            },
        });

        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Wrong phone number format."
        );

        $("#phone").rules("add", {
            regex: "^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]*$"
        })

        var validateLogin = $("#formLogin").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6,
                },
            },
        });

        $("#formRegister").keyup(function() {
            $("#submitFormSignUp").attr("disabled", false);
        });

        $('#formRegister').submit(function(e) {
            e.preventDefault()
            $('#error-firstname').html('')
            $('#error-lastname').html('')
            $('#error-email').html('')
            $('#error-password').html('')
            $('#error-phone').html('')
            if ($('#formRegister').valid()) {
                formInputs = $('#formRegister').serialize();
                $.ajax({
                    url: '/register',
                    type: 'POST',
                    data: formInputs,
                    success: function(data) {
                        $('#modalForm').modal("hide")
                        Swal.fire({
                            title: 'Successful',
                            text: data.message,
                            type: 'success',
                        })
                    },
                    error: function(data) {
                        errors = data.responseJSON.errors
                        if (errors.first_name) {
                            $('#error-firstname').html(errors.first_name[0]);
                        }
                        if (errors.last_name) {
                            $('#error-lastname').html(errors.last_name[0]);
                        }
                        if (errors.email) {
                            $('#error-email').html(errors.email[0]);
                        }
                        if (errors.password) {
                            $('#error-password').html(errors.password[0]);
                        }
                        if (errors.phone) {
                            $('#error-phone').html(errors.phone[0]);
                        }
                        $("#submitFormSignUp").attr("disabled", true);
                    }
                });
            }
        });

        $("#formLogin").keyup(function() {
            $("#submitFormLogin").attr("disabled", false);
        });

        $('#formLogin').submit(function(e) {
            e.preventDefault()
            $('#error-emailLogin').html('')
            $('#error-passwordLogin').html('')
            $('#activate').html('')
            if ($('#formLogin').valid()) {
                formInputs = $('#formLogin').serialize();
                $.ajax({
                    url: '/login',
                    type: 'POST',
                    data: formInputs,
                    success: function(data) {
                        if (data.message) {
                            $('#activate').html(data.message)
                        } else {
                            $('#modalForm').modal("hide")
                            location.reload()
                        }
                    },
                    error: function(data) {
                        errors = data.responseJSON.errors
                        if (errors.email) {
                            $('#error-emailLogin').html(errors.email[0]);
                        }
                        if (errors.password) {
                            $('#error-passwordLogin').html(errors.password[0]);
                        }
                        $("#submitFormLogin").attr("disabled", true);
                    }
                });

            }
        });

        $('#tab-login').click(function() {
            $('#formRegister')[0].reset();
            validateRegister.resetForm();
            $('#error-firstname').html('')
            $('#error-lastname').html('')
            $('#error-email').html('')
            $('#error-password').html('')
            $('#error-phone').html('')
        })

        $('#tab-signup').click(function() {
            $('#formLogin')[0].reset();
            validateLogin.resetForm();
            $('#error-emailLogin').html('')
            $('#error-passwordLogin').html('')
        })

        $('#modalForm').on('hidden.bs.modal', function() {
            $('#formRegister')[0].reset();
            $('#formLogin')[0].reset();
            validateRegister.resetForm();
            validateLogin.resetForm();
            $('#error-firstname').html('')
            $('#error-lastname').html('')
            $('#error-email').html('')
            $('#error-password').html('')
            $('#error-phone').html('')
            $('#error-emailLogin').html('')
            $('#error-passwordLogin').html('')
        })

        $("#email").keyup(function() {
            $('#error-email').html('');
        });

    })
    @php($check = \App\ Helpers\ CommonFunction::checkRoute())
    /*Show Product + Catagories (Ajax)*/

    window.onload = function() {
        @if(!$check) getProducts();
        @endif
    }

    $(document).on('click', '.list-product .page-link', function(e) {
        e.preventDefault();
        getProducts($(this).attr('href'));
    });

    function getProducts(url = '/product_items/0') {
        $.ajax({
            url: url,
            success: function(data) {
                $('.list-product').html(data.pview);
                $('.list-catalog').html(data.cview);
            }
        });
    };

    function getProductById(url) {
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                $('.list-product').html(data);
            },
            error: function(data) {
                alert('Get product fail!');
            }
        });
    }
</script>