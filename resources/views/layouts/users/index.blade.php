@extends('home')
@section('data-table')
    <div class="container">
        <div>
            <div>
                <div class="col-lg-6 float-left">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." id="search" name="search">
                    </div>
                </div>
                <div class="col-lg-6 float-right">
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"
                            data-target="#modalAdd">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="user-list">
                @component('components.users.list', ['users' => $users])
                @endcomponent
            </div>
        </div>
    </div>
    <div class="user-add">
        @component('components.users.add')
        @endcomponent
    </div>
    <div class="user-edit">
        @component('components.users.edit')
        @endcomponent
    </div>
    <script type="text/javascript">
        function deleteUser(id) {
            Swal.fire({
                title: 'Are you sure delete it?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '/user/delete',
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id
                        },
                        success: function (data) {
                            $.notify(data.message, "success");
                            $('.user-list').html(data.view)
                        },
                        error: function (data) {
                        }
                    });
                }
            })
        }

        function getInfoUserById(id) {
            $.ajax({
                url: '/user/get-info-user-by-id',
                type: 'GET',
                data: {
                    id: id
                },
                success: function (data) {
                    $('#fullname-edit').val(data[0]['fullname']);
                    $('#email-edit').val(data[0]['email']);
                    $('#phone-edit').val(data[0]['phone_number']);
                    $('#id-edit').val(data[0]['id']);
                    $('#modalEdit').modal()
                },
                error: function (data) {
                }
            });
        }

        $(document).ready(function () {
            var validateAdd = $("#formAdd").validate({
                rules: {
                    full_name: {
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
                        equalTo: "#password-add"
                    },
                    phone: {
                        required: true,
                    }
                },
            });

            var validateEdit = $("#formEdit").validate({
                rules: {
                    full_name: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    }
                },
            });

            $.validator.addMethod(
                "regex",
                function (value, element, regexp) {
                    var re = new RegExp(regexp);
                    return this.optional(element) || re.test(value);
                },
                "Wrong phone number format."
            );
            $("#phone_add").rules("add", {regex: "^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]*$"})
            $("#phone-edit").rules("add", {regex: "^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[0-9]*$"})

            $("#formAdd").keyup(function () {
                $("#submitFormAdd").attr("disabled", false);
            });
            $('#formAdd').submit(function (e) {
                e.preventDefault();
                $('#error-fullname-add').html('');
                $('#error-email-add').html('');
                $('#error-password-add').html('');
                $('#error-phone-add').html('');
                if ($('#formAdd').valid()) {
                    formInputs = $('#formAdd').serialize();
                    $.ajax({
                        url: '/user/store',
                        type: 'POST',
                        data: formInputs,
                        success: function (data) {
                            $('#modalAdd').modal("hide");
                            $.notify(data.message, "success");
                            $('.user-list').html(data.view)
                        },
                        error: function (data) {
                            errors = data.responseJSON.errors;
                            if (errors.full_name) {
                                $('#error-fullname-add').html(errors.full_name[0]);
                            }
                            if (errors.email_add) {
                                $('#error-email-add').html(errors.email_add[0]);
                            }
                            if (errors.password) {
                                $('#error-password-add').html(errors.password[0]);
                            }
                            if (errors.phone) {
                                $('#error-phone-add').html(errors.phone[0]);
                            }
                            $("#submitFormAdd").attr("disabled", true);
                        }
                    });
                }
            });

            $("#formEdit").keyup(function () {
                var val = $(this).val();
                if( $(this).data('last') != val ){
                    $("#submitFormEdit").attr("disabled", false);
                }
            });

            $('#formEdit').submit(function (e) {
                e.preventDefault();
                $('#error-fullname-edit').html('');
                $('#error-email-edit').html('');
                $('#error-phone-edit').html('');
                if ($('#formEdit').valid()) {
                    formInputs = $('#formEdit').serialize();
                    $.ajax({
                        url: '/user/update',
                        type: 'PUT',
                        data: formInputs,
                        success: function (data) {
                            if (data.status == 'success') {
                                $('#modalEdit').modal("hide");
                                $.notify(data.message, "success");
                                $('.user-list').html(data.view)
                                $("#submitFormEdit").attr("disabled", true);
                            } else if (data.status == 'fail') {
                                $('#modalEdit').modal("hide");
                                $.notify(data.message, "error")
                                $("#submitFormEdit").attr("disabled", true);
                            }
                        },
                        error: function (data) {
                            errors = data.responseJSON.errors;
                            if (errors.full_name) {
                                $('#error-fullname-edit').html(errors.full_name[0]);
                            }
                            if (errors.phone) {
                                $('#error-phone-edit').html(errors.phone[0]);
                            }
                            $("#submitFormEdit").attr("disabled", true);
                        }
                    });
                }
            });

            function delay(fn, ms) {
                let timer = 0;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(fn.bind(this, ...args), ms || 0)
                }
            }

            $('#search').keyup(delay(function () {
                var keyword = $('#search').val();
                $.ajax({
                    url: '/user',
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function (data) {
                        $('.user-list').html(data)
                    },
                    error: function (data) {
                    }
                });
            }, 500))

            $('#modalAdd').on('hidden.bs.modal', function () {
                $('#formAdd')[0].reset();
                validateAdd.resetForm();
                $('#error-fullname-add').html('');
                $('#error-email-add').html('');
                $('#error-password-add').html('');
                $('#error-phone-add').html('');
            })

            $('#modalEdit').on('hidden.bs.modal', function () {
                $('#formEdit')[0].reset();
                validateEdit.resetForm();
                $('#error-fullname-edit').html('');
                $('#error-email-edit').html('');
                $('#error-phone-edit').html('');
            })

            $("#email_add").keyup(function () {
                $('#error-email-add').html('');
            });
        })
    </script>
@endsection