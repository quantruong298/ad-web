@extends('home')
@section('data-table')
    <div class="container">
        <div>
            <div>
                <div class="col-lg-6 float-left">
                    <div style="position: relative" class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." id="search" name="search"
                               value="">
                        <i style="position: absolute;top:10px;right:10px" class="fa fa-search"></i>
                    </div>
                </div>
{{--                <div class="custom-checkbox float-left" style="margin-left: 30px">--}}
{{--                    <input type="checkbox" class="custom-control-input" id="activec">--}}
{{--                    <label class="custom-control-label" for="activec">Active Campaigns</label>--}}
{{--                </div>--}}
                <div class="col-lg-6 float-right">
                    <a href="{{route('report.export')}}" class="btn btn-success float-right">
                        Export
                    </a>
                </div>
            </div>
            <div class="report-list">
                @component('components.reports.list', ['reports' => $reports])
                @endcomponent
            </div>
        </div>
    </div>
    <div>
        <div class="row d-flex justify-content-center modalWrapper">
            <div class="modal fade addNewInputs" id="modalChart" tabindex="-1" role="dialog"
                 aria-labelledby="modalChart"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header text-center">
                            <h4 class="modal-title w-100 font-weight-bold text-primary ml-5">Chart</h4>
                            <button type="button" class="close text-primary" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body mx-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    <div>--}}
    {{--        @component('components.products.edit')--}}
    {{--        @endcomponent--}}
    {{--    </div>--}}
    <script>
        function getChart(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    $('.modal-body').html(data);
                    $('#modalChart').modal();
                },
                error: function (data) {
                    alert('Get charts fail!');
                }
            });
        }
        function exportReport(url){
            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    Swal.fire("Success!", "Export completed.", "success");
                },
                error: function (data) {
                    alert('Export fail!');
                }
            });
        }
        $(document).ready(function () {
            $('#activec').change(function(){
                var check=$(this).prop("checked");
                $.ajax({
                    url: '/report/activec',
                    type: 'GET',
                    data:{
                        check:check,
                    },
                    success: function (data) {
                        $('.report-list').html(data);
                    },
                    error: function (data) {
                        alert('Get active campaigns fail!');
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
                    url: '/report/search',
                    type: 'GET',
                    data: {
                        keyword: keyword
                    },
                    success: function (data) {
                        $('.report-list').html(data)
                    },
                    error: function (data) {
                    }
                });
            }, 500))
        })
    </script>
@endsection