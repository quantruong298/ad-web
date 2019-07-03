@extends('home')
@section('data-table')
    <div class="container">
        <div>
            <div>
                <div class="col-lg-6 float-left">
                    <div style="position: relative" class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." id="search" name="search" value="">
                        <i style="position: absolute;top:10px;right:10px" class="fa fa-search"></i>
                    </div>
                </div>
                <div class="custom-checkbox float-left" style="margin-left: 30px">
                    <input type="checkbox" class="custom-control-input" id="backup">
                    <label class="custom-control-label" for="backup">Show Backup</label>
                </div>
                <div class="col-lg-6 float-right">
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" onclick="create('/product/create')">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="product-list">
                @component('components.products.list', ['products' => $products])
                @endcomponent
            </div>
        </div>
    </div>
    <div>
        @component('components.products.add')
        @endcomponent
    </div>
    <div>
        @component('components.products.edit')
        @endcomponent
    </div>
    <script type="text/javascript">
        // $(document).on('click', '.product-list .page-link', function (e) {
        //     e.preventDefault();
        //     getProducts($(this).attr('href'));
        // });
        // function getProducts(url = '/product') {
        //     $.ajax({
        //         url: url,
        //         success: function (data) {
        //             $('.product-list').html(data.view);
        //         }
        //     });
        // };
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
                            Swal.fire("Deleted!", "Your products has been deleted.", "success");
                            $('.product-list').html(data.view)
                        },
                        error: function (data) {
                            alert("Delete fail!");
                        }
                    });
                }
            })
        }
        function create(url){
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('#formAdd').html(data);
                    $('#modalAdd').modal();
                },
                error: function (data) {
                    alert('Get catalogs fail!');
                }
            });
        }
        function edit(pid) {
            $.ajax({
                url: '/product/'+pid+'/edit',
                type: 'GET',
                success: function (data) {
                    $('#formEdit').html(data);
                    $('#modalEdit').modal();
                },
                error: function (data) {
                    alert('Get product fail!');
                }
            });
        }
        function loadImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#pimage').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(document).ready(function () {
            $('#backup').change(function(){
                var check=$(this).prop("checked");
                $.ajax({
                    url: '/product/backup',
                    type: 'GET',
                    data:{
                        check:check,
                    },
                    success: function (data) {
                        $('.product-list').html(data);
                    },
                    error: function (data) {
                        alert('Get backup fail!');
                    }
                });
            });
            $('#formAdd').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '/product',
                    type: 'POST',
                    data:formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#modalAdd').modal("hide");
                        $('.product-list').html(data.view);
                    },
                    error: function (data) {
                        //console.log(data);
                        errors = data.responseJSON.errors;
                        if (errors.name) {
                            $('#error-name-add').html(errors.name[0]);
                        }
                        if (errors.price) {
                            $('#error-price-add').html(errors.price[0]);
                        }
                        if (errors.quantity) {
                            $('#error-quantity-add').html(errors.quantity[0]);
                        }
                        if (errors.description) {
                            $('#error-description-add').html(errors.description[0]);
                        }
                        if (errors.image) {
                            $('#error-image-add').html(errors.image[0]);
                        }
                        if (errors.catalog_id) {
                            $('#error-catalog-add').html(errors.catalog_id[0]);
                        }
                    }
                });
            });

            $('#formEdit').submit(function (e) {
                e.preventDefault();
                var formData = new FormData($(this)[0]);
                $.ajax({
                    url: '/product/update',
                    type: 'POST',
                    //data: formInputs,
                    data:formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        $('#backup').prop('checked', false);
                        // if (data.status == 'success') {
                        $('#modalEdit').modal("hide");
                        //     $.notify(data.message, "success");
                        $('.product-list').html(data.view)
                        // } else if (data.status == 'fail') {
                        //     $('#modalEdit').modal("hide");
                        //     $.notify(data.message, "error")
                        // }
                    },
                    error: function (data) {
                        errors = data.responseJSON.errors;
                        if (errors.name) {
                            $('#error-name-add').html(errors.name[0]);
                        }
                        if (errors.price) {
                            $('#error-price-add').html(errors.price[0]);
                        }
                        if (errors.quantity) {
                            $('#error-quantity-add').html(errors.quantity[0]);
                        }
                        if (errors.description) {
                            $('#error-description-add').html(errors.description[0]);
                        }
                        if (errors.image) {
                            $('#error-image-add').html(errors.image[0]);
                        }
                        if (errors.catalog_id) {
                            $('#error-catalog-add').html(errors.catalog_id[0]);
                        }
                    }
                });
            });
            function delay(fn, ms) {
                let timer = 0;
                return function (...args) {
                    clearTimeout(timer);
                    timer = setTimeout(fn.bind(this, ...args), ms || 0)
                }
            }
            $('#search').keyup(delay(function () {
                console.log(123);
                var keyword = $('#search').val();
                $.ajax({
                    url: '/product/search',
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function (data) {
                        $('.product-list').html(data)
                    },
                    error: function (data) {
                    }
                });
            }, 500))
        })
    </script>
@endsection