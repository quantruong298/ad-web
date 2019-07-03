<div style="height: 50vh" id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
        <li data-target="#carousel-example-1z" data-slide-to="3"></li>
        <li data-target="#carousel-example-1z" data-slide-to="4"></li>
        <li data-target="#carousel-example-1z" data-slide-to="5"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        @foreach($sliders as $key => $slider)
            <div class="carousel-item {{ ($key == 0) ? 'active' : ''}}">
                <a href="{{ $slider->link }}" onclick="clickSlider({{ $slider->id }})" target="_blank">
                    <div class="view"
                         style="background-image: url(&apos;{{ $slider->banner }}&apos;); background-repeat: no-repeat; background-size: cover;">
                        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">
                            <div class="text-center white-text mx-5 wow fadeIn">
                                <input class="campaign-id" value="{{$slider->id}}" hidden></p>
                                <h1 class="mb-4">
                                    <strong>Learn Bootstrap {{ $slider->id }} with MDB</strong>
                                </h1>
                                <p>
                                    <strong>Best &amp; free guide of responsive web design</strong>
                                </p>

                                <p class="d-none d-md-block">
                                    <strong>The most comprehensive tutorial for the Bootstrap 4. Loved by over 500 000
                                        users.
                                        Video and written versions
                                        available. Create your own, stunning website.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <script type="text/javascript">
        // $(document).ready(function () {
        //     disableSlider()
        //     $(window).scroll(function (event) {
        //         var elem = $('#carousel-example-1z');
        //         var isShow = checkVisible(elem, 'visible');
        //         if (isShow == false) {
        //             // disableSlider()
        //         }
        //     });

        //     function disableSlider() {
        //         console.log(45)
        //         $('#carousel-example-1z').carousel({
        //             pause: true,
        //             interval: false
        //         });
        //     }
        // })

        // function checkVisible(elm, evalType) {
        //     evalType = evalType || "visible";

        //     var vpH = $(window).height(),
        //         st = $(window).scrollTop(),
        //         y = $(elm).offset().top,
        //         elementHeight = $(elm).height();

        //     if (evalType === "visible") return ((y < (vpH + st)) && (y > (st - elementHeight)));
        //     if (evalType === "above") return ((y < (vpH + st)));
        // }

        function clickSlider(id) {
            $.ajax({
                url: 'campaign-detail/click',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (data) {

                },
                error: function (data) {

                }
            });
        }

        $('#carousel-example-1z').on('slide.bs.carousel', function () {
            id = $('.active .campaign-id').val()
            $.ajax({
                url: 'campaign-detail/view',
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function (data) {

                },
                error: function (data) {

                }
            });
        })
    </script>