@extends('home')
@section('data-table')
    <div class="container">
        <div>
            <div>
                {{--                <div class="col-lg-6 float-left">--}}
                {{--                    <div class="input-group">--}}
                {{--                        <input type="text" class="form-control" placeholder="Search for..." id="search" name="search">--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <div class="col-lg-6 float-right">
                    <button type="button" class="btn btn-success float-right" data-toggle="modal"  data-target="#modalAdd">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="catalog-list">
                @component('components.catalogs.list', ['catalogs' => $catalogs])
                @endcomponent
            </div>
        </div>
    </div>
    <div class="catalog-add">
        @component('components.catalogs.add')
        @endcomponent
    </div>
    <div class="catalog-edit">
        @component('components.catalogs.edit')
        @endcomponent
    </div>
    <script>
        function del(url){
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
                        url: url,
                        type: 'DELETE',
                        data:{
                            _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            Swal.fire("Deleted!", "Your catalog has been deleted.", "success");
                            $('.catalog-list').html(data.view)
                        },
                        error: function (data) {
                        }
                    });
                }
            })
        }
        function edit(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('#formEdit').html(data);
                    $('#modalEdit').modal();
                },
                error: function (data) {
                    alert('Get catalog fail!');
                }
            });
        }
        $(document).ready(function () {
            $('#formAdd').submit(function (e) {
                e.preventDefault();
                formInputs = $('#formAdd').serialize();
                $.ajax({
                    url: '/catalog',
                    type: 'POST',
                    data: formInputs,
                    success: function (data) {
                        $('#modalAdd').modal("hide");
                        $('.catalog-list').html(data.view);
                    },
                    error: function (data) {
                        //console.log(data);
                        errors = data.responseJSON.errors;
                        if (errors.name) {
                            $('#error-name-add').html(errors.name[0]);
                        }
                    }
                });
            });
            //
            $('#formEdit').submit(function (e) {
                e.preventDefault();
                formInputs = $('#formEdit').serialize();
                $.ajax({
                    url: '/catalog/update',
                    type: 'PUT',
                    data: formInputs,
                    success: function (data) {
                        // if (data.status == 'success') {
                        $('#modalEdit').modal("hide");
                        //     $.notify(data.message, "success");
                        $('.catalog-list').html(data.view)
                        // } else if (data.status == 'fail') {
                        //     $('#modalEdit').modal("hide");
                        //     $.notify(data.message, "error")
                        // }
                    },
                    error: function (data) {
                        errors = data.responseJSON.errors;
                        if (errors.name) {
                            $('#error-name-edit').html(errors.name[0]);
                        }
                    }
                });
            });
            // function delay(fn, ms) {
            //     let timer = 0;
            //     return function (...args) {
            //         clearTimeout(timer);
            //         timer = setTimeout(fn.bind(this, ...args), ms || 0)
            //     }
            // }
            // $('#search').keyup(delay(function () {
            //     console.log(123);
            //     var keyword = $('#search').val();
            //     $.ajax({
            //         url: '/product/search',
            //         type: 'GET',
            //         data: {
            //             keyword: keyword
            //         },
            //         success: function (data) {
            //             $('.product-list').html(data)
            //         },
            //         error: function (data) {
            //         }
            //     });
            // }, 500))

        })
    </script>
@endsection