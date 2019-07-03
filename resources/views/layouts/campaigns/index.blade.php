@extends('home')
@section('data-table')
<div class="container">
    <div>
        <div>
            <div class="col-lg-6 float-left">
                <div class="input-group campaign-search">
                    <input type="text" class="form-control" placeholder="Search for..." id="search" name="search">
                </div>
            </div>
            @if(Auth::user()->role_id == \App\Enum\UserRoles::SHOP)
            <div class="col-lg-6 float-right">
                <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#modalAddCampaign">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
            @endif
        </div>
        <div class="campaign-list">
            <div class="campaign-list">
                @component('components.campaigns.list', ['campaigns' => $campaigns])
                @endcomponent
            </div>
        </div>
    </div>
</div>
<div class="campaign-add">
    @component('components.campaigns.add')
    @endcomponent
</div>
<div class="campaign-edit">
    @component('components.campaigns.edit')
    @endcomponent
</div>
<script type="text/javascript">
    function deleteCampaign(id) {
        Swal.fire({
            title: 'Are you sure delete it?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/campaign/delete',
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(data) {
                        if (data.status == 'success') {
                            $.notify(data.message, "success");
                            $('.campaign-list').html(data.view)
                        } else if (data.status == 'fail') {
                            $.notify(data.message, "error");
                        }
                    },
                    error: function(data) {}
                });
            }
        })
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image-wrap').removeAttr('hidden');
                $('#preview-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLEdit(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-image-wrap-edit').removeAttr('hidden');
                $('#preview-image-edit').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(document).ready(function() {
        var validateAdd = $("#formAdd").validate({
            rules: {
                name: {
                    required: true
                },
                budget: {
                    required: true,
                    number: true,
                    min: 0,
                },
                bid: {
                    required: true,
                    number: true,
                    min: 0,
                },
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                finalurl: {
                    required: true,
                    url: true
                },
                file: {
                    required: true
                }
            },
        });

        var validateEdit = $("#formEdit").validate({
            rules: {
                name: {
                    required: true
                },
                budget: {
                    required: true,
                    number: true,
                    min: 0,
                },
                bid: {
                    required: true,
                    number: true,
                    min: 0,
                },
                title: {
                    required: true
                },
                description: {
                    required: true
                },
                finalurl: {
                    required: true,
                    url: true
                },
            },
        });

        $("#formAdd").keyup(function() {
            $("#submitFormAdd").attr("disabled", false);
        });
        $('#formAdd').submit(function(e) {
            $('#error-bid-add').html('');
            $('#error-budget-add').html('');
            $('#error-description-add').html('');
            $('#error-final-url-add').html('');
            $('#error-name-add').html('');
            $('#error-title-add').html('');
            $('#error-start-day-add').html('');
            $('#error-end-day-add').html('');
            if ($('#formAdd').valid()) {
                e.preventDefault();
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('name', $('#campaign-name-add').val());
                formData.append('status', $('#campaign-status-add').val());
                formData.append('startday', $('#campaign-start-day-add').val());
                formData.append('endday', $('#campaign-end-day-add').val());
                formData.append('budget', $('#campaign-budget-add').val());
                formData.append('bid', $('#campaign-bid-add').val());
                formData.append('title', $('#campaign-title-add').val());
                formData.append('description', $('#campaign-description-add').val());
                formData.append('finalurl', $('#campaign-final-url-add').val());
                formData.append('file', $('#campaign-file-add')[0].files[0]);
                $.ajax({
                    url: '/campaign/store',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modalAddCampaign').modal("hide");
                        $.notify(data.message, "success");
                        $('.campaign-list').html(data.view)
                    },
                    error: function(data) {
                        errors = data.responseJSON.errors;
                        if (errors.bid) {
                            $('#error-bid-add').html(errors.bid[0]);
                        }
                        if (errors.budget) {
                            $('#error-budget-add').html(errors.budget[0]);
                        }
                        if (errors.description) {
                            $('#error-description-add').html(errors.description[0]);
                        }
                        if (errors.finalurl) {
                            $('#error-final-url-add').html(errors.finalurl[0]);
                        }
                        if (errors.name) {
                            $('#error-name-add').html(errors.name[0]);
                        }
                        if (errors.title) {
                            $('#error-title-add').html(errors.title[0]);
                        }
                        if (errors.startday) {
                            $('#error-start-day-add').html(errors.startday[0]);
                        }
                        if (errors.endday) {
                            $('#error-end-day-add').html(errors.endday[0]);
                        }
                        if (errors.starttime) {
                            $('#error-start-time-add').html(errors.starttime[0]);
                        }
                        if (errors.endtime) {
                            $('#error-end-time-add').html(errors.endtime[0]);
                        }
                        if (errors.file) {
                            $('#error-file-add').html(errors.file[0]);
                        }
                        $("#submitFormAdd").attr("disabled", true);
                    }
                });
            }
        });

        $("#formEdit").bind('keyup change', function() {
            $("#submitFormEdit").attr("disabled", false);
        });
        $('#formEdit').submit(function(e) {
            e.preventDefault();
            $('#error-bid-edit').html('');
            $('#error-budget-edit').html('');
            $('#error-description-edit').html('');
            $('#error-final-url-edit').html('');
            $('#error-name-edit').html('');
            $('#error-title-edit').html('');
            $('#error-start-day-edit').html('');
            $('#error-end-day-edit').html('');
            if ($('#formEdit').valid()) {
                var formData = new FormData();
                formData.append('_token', '{{ csrf_token() }}');
                formData.append('id', $('#campaign-id-edit').val());
                formData.append('name', $('#campaign-name-edit').val());
                formData.append('status', $('#campaign-status-edit').val());
                formData.append('startday', $('#campaign-start-day-edit').val());
                formData.append('endday', $('#campaign-end-day-edit').val());
                formData.append('budget', $('#campaign-budget-edit').val());
                formData.append('bid', $('#campaign-bid-edit').val());
                formData.append('title', $('#campaign-title-edit').val());
                formData.append('description', $('#campaign-description-edit').val());
                formData.append('finalurl', $('#campaign-final-url-edit').val());
                formData.append('file', $('#campaign-file-edit')[0].files[0]);
                $.ajax({
                    url: '/campaign/update',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#modalEditCampaign').modal("hide");
                        if (data.status == 'fail') {
                            $.notify(data.message, "error");
                            $("#submitFormEdit").attr("disabled", true);
                        } else if (data.status == 'success') {
                            $.notify(data.message, "success")
                            $('.campaign-list').html(data.view)
                            $("#submitFormEdit").attr("disabled", true);
                        }

                    },
                    error: function(data) {
                        errors = data.responseJSON.errors;
                        if (errors.bid) {
                            $('#error-bid-edit').html(errors.bid[0]);
                        }
                        if (errors.budget) {
                            $('#error-budget-edit').html(errors.budget[0]);
                        }
                        if (errors.description) {
                            $('#error-description-edit').html(errors.description[0]);
                        }
                        if (errors.finalurl) {
                            $('#error-final-url-edit').html(errors.finalurl[0]);
                        }
                        if (errors.name) {
                            $('#error-name-edit').html(errors.name[0]);
                        }
                        if (errors.title) {
                            $('#error-title-edit').html(errors.title[0]);
                        }
                        if (errors.startday) {
                            $('#error-start-day-edit').html(errors.startday[0]);
                        }
                        if (errors.endday) {
                            $('#error-end-day-edit').html(errors.endday[0]);
                        }
                        if (errors.starttime) {
                            $('#error-start-time-edit').html(errors.starttime[0]);
                        }
                        if (errors.endtime) {
                            $('#error-end-time-edit').html(errors.endtime[0]);
                        }
                        if (errors.file) {
                            $('#error-file-edit').html(errors.file[0]);
                        }
                        $("#submitFormEdit").attr("disabled", true);
                    }
                });
            }
        });

        $('#modalAddCampaign').on('hidden.bs.modal', function() {
            $('#formAdd')[0].reset();
            validateAdd.resetForm();
            $('#error-bid-add').html('');
            $('#error-budget-add').html('');
            $('#error-description-add').html('');
            $('#error-final-url-add').html('');
            $('#error-name-add').html('');
            $('#error-title-add').html('');
            $('#error-start-day-add').html('');
            $('#error-end-day-add').html('');
        })

        $('#modalEditCampaign').on('hidden.bs.modal', function() {
            $('#formEdit')[0].reset();
            validateEdit.resetForm();
            $('#error-bid-edit').html('');
            $('#error-budget-edit').html('');
            $('#error-description-edit').html('');
            $('#error-final-url-edit').html('');
            $('#error-name-edit').html('');
            $('#error-title-edit').html('');
            $('#error-start-day-edit').html('');
            $('#error-end-day-edit').html('');
        })

        function delay(fn, ms) {
            let timer = 0;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(fn.bind(this, ...args), ms || 0)
            }
        }

        $('#search').keyup(delay(function() {
            var keyword = $('#search').val();
            $.ajax({
                url: '/campaign',
                type: 'GET',
                data: {
                    keyword: keyword
                },
                success: function(data) {
                    $('.campaign-list').html(data)
                },
                error: function(data) {}
            });
        }, 500))
    })

    function getInfoCampaignById(id) {
        $.ajax({
            url: '/campaign/get-info-campaign-by-id',
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#campaign-id-edit').val(data[0]['id']);
                $('#campaign-name-edit').val(data[0]['name']);
                $('#campaign-status-edit').val(data[0]['status']);
                $('#campaign-start-day-edit').val(data[0]['start_day']);
                $('#campaign-end-day-edit').val(data[0]['end_day']);
                $('#campaign-budget-edit').val(data[0]['budget']);
                $('#campaign-bid-edit').val(data[0]['bid_amount']);
                $('#campaign-title-edit').val(data[0]['title']);
                $('#campaign-description-edit').val(data[0]['description']);
                $('#campaign-final-url-edit').val(data[0]['link']);
                $('#campagin-image-edit').attr("src", data[0]['banner']);
                $('#modalEditCampaign').modal()
            },
            error: function(data) {}
        });
    }
</script>
@endsection