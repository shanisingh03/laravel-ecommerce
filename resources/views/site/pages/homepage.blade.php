@extends('site.app')
@section('title', 'Homepage')

@section('content')
   <!-- ========================= SECTION MAIN ========================= -->
    <section class="section-main bg padding-top-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <!-- ================= main slide ================= -->
                    <div class="owl-init slider-main owl-carousel" data-items="1" data-dots="false" data-nav="true">
                        <div class="item-slide">
                            <img src="{{asset('frontend/images/banners/slide1.jpg')}}">
                        </div>
                        <div class="item-slide rounded">
                            <img src="{{asset('frontend/images/banners/slide2.jpg')}}">
                        </div>
                        <div class="item-slide rounded">
                            <img src="{{asset('frontend/images/banners/slide3.jpg')}}">
                        </div>
                    </div>
                    <!-- ============== main slidesow .end // ============= -->
                </div>
                <!-- col.// -->

                {{--  Top Products  --}}
                <div class="col-md-3">
                    {{--  Products Card  --}}
                    @forelse($top_products as $product)
                        <div class="card mt-2 mb-2">
                            <figure class="itemside">
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right">
                                        @if(!empty($product->images))
                                            <img src="{{ asset('storage/'.$product->images->first()->full) }}" alt="{{$product->name}}" height="100%">
                                        @else
                                            <img src="https://via.placeholder.com/176">
                                        @endif
                                    </div>
                                </div>
                                <figcaption class="p-3">
                                    <h6 class="title"><a href="{{ route('product.show', $product->slug) }}">{{$product->name}}</a></h6>
                                    <div class="price-wrap">
                                        
                                        <span class="price-new b">
                                            <span class="currency">{{ config('settings.currency_symbol') }}</span>
                                            @if($product->attributes->count() > 1)
                                                <span class="num" id="productPrice">{{ $product->attributes->min('price') }}</span>
                                                -
                                                <span class="num" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                            @else
                                                <span class="num" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                            @endif
                                        </span>

                                        {{--  <del class="price-old text-muted">$1980</del>  --}}
                                    </div>
                                    <!-- price-wrap.// -->
                                </figcaption>
                            </figure>
                        </div>
                    @empty
                        <div class="card mt-2 mb-2">
                            <figure class="itemside">
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right">
                                        <img src="https://via.placeholder.com/176">
                                    </div>
                                </div>
                                <figcaption class="p-3">
                                    <h6 class="title"><a href="#">Some name of item goes here nice</a></h6>
                                    <div class="price-wrap">
                                        <span class="price-new b">$1280</span>
                                        <del class="price-old text-muted">$1980</del>
                                    </div>
                                    <!-- price-wrap.// -->
                                </figcaption>
                            </figure>
                        </div>
                        <div class="card mt-2 mb-2">
                            <figure class="itemside">
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right">
                                            <img src="https://via.placeholder.com/176">
                                    </div>
                                </div>
                                <figcaption class="p-3">
                                    <h6 class="title"><a href="#">Some name of item goes here nice</a></h6>
                                    <div class="price-wrap">
                                        <span class="price-new b">$1280</span>
                                        <del class="price-old text-muted">$1980</del>
                                    </div>
                                    <!-- price-wrap.// -->
                                </figcaption>
                            </figure>
                        </div>
                        <div class="card mt-2 mb-2">
                            <figure class="itemside">
                                <div class="aside">
                                    <div class="img-wrap img-sm border-right">
                                            <img src="https://via.placeholder.com/176">
                                    </div>
                                </div>
                                <figcaption class="p-3">
                                    <h6 class="title"><a href="#">Some name of item goes here nice</a></h6>
                                    <div class="price-wrap">
                                        <span class="price-new b">$1280</span>
                                        <del class="price-old text-muted">$1980</del>
                                    </div>
                                    <!-- price-wrap.// -->
                                </figcaption>
                            </figure>
                        </div>
                    @endforelse
                </div>
                
            </div>
        </div>
        <!-- container .//  -->
    </section>
    <!-- ========================= SECTION MAIN END// ========================= -->

    <!-- ========================= Featured Categories ========================= -->
    <section class="section-content padding-y-sm bg">
        <div class="container">
            <header class="section-heading heading-line">
                <h4 class="title-section bg">Featured Categories</h4>
            </header>
            <div class="row">
                @forelse($featured_categories as $categoryIndex => $category)
                    <div class="col-md-4">
                        <div class="card-banner" style="height:250px; background-image: url('frontend/images/posts/{{$categoryIndex+11}}.jpg');">
                            <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <h5 class="card-title">{{$category->name}}</h5>
                                    <a href="{{ route('category.show', $category->slug) }}" class="btn btn-warning btn-sm"> View All </a>
                                </div>
                            </article>
                        </div>
                        <!-- card.// -->
                    </div>
                @empty
                    <div class="col-md-4">
                        <div class="card-banner" style="height:250px; background-image: url('https://via.placeholder.com/240');">
                            <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <h5 class="card-title">Primary text as title</h5>
                                    <a href="#" class="btn btn-warning btn-sm"> View All </a>
                                </div>
                            </article>
                        </div>
                        <!-- card.// -->
                    </div>
                    <div class="col-md-4">
                        <div class="card-banner" style="height:250px; background-image: url('https://via.placeholder.com/240');">
                            <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <h5 class="card-title">Primary text as title</h5>
                                    <a href="#" class="btn btn-warning btn-sm"> View All </a>
                                </div>
                            </article>
                        </div>
                        <!-- card.// -->
                    </div>
                    <div class="col-md-4">
                        <div class="card-banner" style="height:250px; background-image: url('https://via.placeholder.com/240');">
                            <article class="overlay overlay-cover d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <h5 class="card-title">Primary text as title</h5>
                                    <a href="#" class="btn btn-warning btn-sm"> View All </a>
                                </div>
                            </article>
                        </div>
                        <!-- card.// -->
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- ========================= Blog .END// ========================= -->

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y-sm bg">
        <div class="container">

            <header class="section-heading heading-line">
                <h4 class="title-section bg">FEATURED PRODUCTS</h4>
            </header>
            <div class="row">
                @forelse($featured_products as $product)
                    <div class="col-md-4 product-list-image">
                        <figure class="card card-product">
                            <div class="img-wrap">
                                @if(!empty($product->images))
                                    <img class="p-2" src="{{ asset('storage/'.$product->images->first()->full) }}" alt="{{$product->name}}" height="100%">
                                @else
                                    <img src="https://via.placeholder.com/240" alt="{{$product->name}}">
                                @endif
                            </div>
                            <figcaption class="info-wrap">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h4 class="title">{{$product->name}}</h4>
                                </a>
                                <p class="desc">
                                    {{$product->brand->name}} - {{$product->categories->first()->name}}
                                </p>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-primary float-right">
                                    <span class="fa fa-eye"></span>
                                    View
                                </a>
                                <div class="price-wrap h5">
                                    <span class="currency">{{ config('settings.currency_symbol') }}</span>
                                    @if($product->attributes->count() > 1)
                                        <span class="price-new" id="productPrice">{{ $product->attributes->min('price') }}</span>
                                        -
                                        <span class="price-new" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                    @else
                                        <span class="price-new" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                    @endif
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                @empty
                    <div class="col-md-4">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"></div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Another name of item</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">
                                    <span class="fa fa-eye"></span>
                                    View
                                </a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                    
                    <div class="col-md-4">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"> </div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Good product</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                    
                    <div class="col-md-4">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"></div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Product name goes here</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                @endforelse
            </div>
            <!-- row.// -->

        </div>
        <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y-sm bg">
        <div class="container">

            <header class="section-heading heading-line">
                <h4 class="title-section bg">RECENTLY ADDED</h4>
            </header>
            <div class="row">
                @forelse($new_products as $product)
                    <div class="col-md-3 product-list-image">
                        <figure class="card card-product">
                            <div class="img-wrap">
                                @if(!empty($product->images))
                                    <img class="p-2" src="{{ asset('storage/'.$product->images->first()->full) }}" alt="{{$product->name}}" height="100%">
                                @else
                                    <img src="https://via.placeholder.com/240" alt="{{$product->name}}">
                                @endif
                            </div>
                            <figcaption class="info-wrap">
                                <a href="{{ route('product.show', $product->slug) }}">
                                    <h4 class="title">{{$product->name}}</h4>
                                </a>
                                <p class="desc">
                                    {{$product->brand->name}} - {{$product->categories->first()->name}}
                                </p>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="{{ route('product.show', $product->slug) }}" class="btn btn-sm btn-primary float-right">
                                    <span class="fa fa-eye"></span>
                                    View
                                </a>
                                <div class="price-wrap h5">
                                    <span class="currency">{{ config('settings.currency_symbol') }}</span>
                                    @if($product->attributes->count() > 1)
                                        <span class="price-new" id="productPrice">{{ $product->attributes->min('price') }}</span>
                                        -
                                        <span class="price-new" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                    @else
                                        <span class="price-new" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                    @endif
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                @empty
                    <div class="col-md-3">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"></div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Another name of item</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                    
                    <div class="col-md-3">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"> </div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Good product</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                    
                    <div class="col-md-3">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"></div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Product name goes here</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>

                    <div class="col-md-3">
                        <figure class="card card-product">
                            <div class="img-wrap"><img src="https://via.placeholder.com/240"></div>
                            <figcaption class="info-wrap">
                                <h4 class="title">Product name goes here</h4>
                                <p class="desc">Some small description goes here</p>
                                <div class="rating-wrap">
                                    <ul class="rating-stars">
                                        <li style="width:80%" class="stars-active">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </li>
                                    </ul>
                                    <div class="label-rating">132 reviews</div>
                                    <div class="label-rating">154 orders </div>
                                </div>
                                <!-- rating-wrap.// -->
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
                                <div class="price-wrap h5">
                                    <span class="price-new">$1280</span> <del class="price-old">$1980</del>
                                </div>
                                <!-- price-wrap.// -->
                            </div>
                            <!-- bottom-wrap.// -->
                        </figure>
                    </div>
                @endforelse
            </div>

        </div>
        <!-- container .//  -->
    </section>

    

    <!-- ========================= Subscribe ========================= -->
    <section class="section-subscribe bg-primary padding-y-lg">
        <div class="container">

            <p class="pb-2 text-center white">Delivering the latest product trends and industry news straight to your inbox</p>

            <div class="row justify-content-md-center">
                <div class="col-lg-4 col-sm-6">
                    <form class="row-sm form-noborder">
                        <div class="col-8">
                            <input class="form-control" placeholder="Your Email" type="email">
                        </div>
                        <!-- col.// -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-block btn-warning"> <i class="fa fa-envelope"></i> Subscribe </button>
                        </div>
                        <!-- col.// -->
                    </form>
                    <small class="form-text text-white-50">We’ll never share your email address with a third-party. </small>
                </div>
                <!-- col-md-6.// -->
            </div>

        </div>
        <!-- container // -->
    </section>
    <!-- ========================= Subscribe .END// ========================= -->
@stop