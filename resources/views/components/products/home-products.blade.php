@isset($products)
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3">
                <figure class="card card-product">
                    <div class="img-wrap zoom-effect-container" onclick="getProductById('/home-product/{{$product->id}}')"><img src="{{$product->image}}"></div>
                    <figcaption class="info-wrap">
                        <h4 class="title" onclick="getProductById('/home-product/{{$product->id}}')">{{$product->name}}</h4>
                        <p class="desc">{{$product->description}}</p>
                        <div class="price-wrap h5">
                            <span class="price-new">{{number_format($product->price) .' VND' }}</span>
                            {{--                    <del class="price-old">$1980</del>--}}
                        </div>
                    </figcaption>
                    <div class="bottom-wrap">
                        <a href="" class="btn btn-sm btn-primary float-right">Order Now</a>
                    </div>
                </figure>
            </div>
        @endforeach
    </div>
    <span class="home-paginate">
        {{$products->links()}}
    </span>
@endisset