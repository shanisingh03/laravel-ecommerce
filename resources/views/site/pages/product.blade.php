@extends('site.app')
@section('title', $product->name)
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ $product->name }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap">
                                    @if ($product->images->count() > 0)
                                        <div class="img-big-wrap">
                                            <div class="padding-y">
                                                <a class="main-image-anchor" href="{{ asset('storage/'.$product->images->first()->full) }}" data-fancybox="">
                                                    <img class="main-image" src="{{ asset('storage/'.$product->images->first()->full) }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="img-big-wrap">
                                            <div>
                                                <a href="https://via.placeholder.com/176" data-fancybox=""><img src="https://via.placeholder.com/176"></a>
                                            </div>
                                        </div>
                                    @endif
                                     @if ($product->images->count() > 0)
                                        <div class="img-small-wrap">
                                            @foreach($product->images as $image)
                                                <div class="item-gallery">
                                                    <img class="item-gallery-small-img" src="{{ asset('storage/'.$image->full) }}" alt="{{$product->name}}">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            </aside>
                            <aside class="col-sm-7">
                                <article class="p-5">
                                    <h3 class="title mb-3">{{ $product->name }}</h3>
                                    <dl class="row">
                                        <dt class="col-sm-3">SKU</dt>
                                        <dd class="col-sm-9">{{ $product->sku }}</dd>
                                        <dt class="col-sm-3">Weight</dt>
                                        <dd class="col-sm-9">{{ $product->weight }} grams</dd>
                                    </dl>
                                    <div class="mb-3">
                                        <var class="price h3 text-danger">
                                            <span class="currency">{{ config('settings.currency_symbol') }}</span>
                                            @if($product->attributes->count() > 1)
                                                <span class="num" id="productPrice">{{ $product->attributes->min('price') }} - {{ $product->attributes->max('price') }}</span>
                                            @else
                                                <span class="num" id="productPrice">{{ $product->attributes->max('price') }}</span>
                                            @endif
                                        </var>
                                        
                                    </div>
                                    <hr>
                                    <form action="{{ route('product.add.cart') }}" method="POST" role="form" id="addToCart">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    @foreach($attributes as $attribute)
                                                        @php $attributeCheck = in_array($attribute->id, $product->attributes->pluck('attribute_id')->toArray()) @endphp
                                                        @if ($attributeCheck)
                                                            <dt>{{ $attribute->name }}: </dt>
                                                            <dd>
                                                                <select class="form-control form-control-sm option" style="width:180px;" name="{{ strtolower($attribute->name ) }}">
                                                                    <option data-price="0" value="0" disabled> Select a {{ $attribute->name }}</option>
                                                                    @foreach($product->attributes as $attributeIndex => $attributeValue)
                                                                        @if ($attributeValue->attribute_id == $attribute->id)
                                                                            <option
                                                                                data-price="{{ $attributeValue->price }}"
                                                                                {{$attributeIndex==0 ? 'selected' : ''}}
                                                                                value="{{ $attributeValue->value }}"> 
                                                                                {{ ucwords($attributeValue->value) . ' - ' . config('settings.currency_symbol').' '.$attributeValue->price }}
                                                                            </option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </dd>
                                                        @endif
                                                    @endforeach
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    <dt>Quantity: </dt>
                                                    <dd>
                                                        <input class="form-control" type="number" min="1" value="1" max="{{ $product->quantity }}" name="qty" style="width:70px;">
                                                        <input type="hidden" name="productId" value="{{ $product->id }}">
                                                        <input type="hidden" name="price" id="finalPrice" value="{{ $product->sale_price != '' ? $product->sale_price : $product->price }}">
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                    </form>
                                </article>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <article class="card mt-4">
                        <div class="card-body">
                            {!! $product->description !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>

    <section class="section-content padding-y-sm bg">
        <div class="container">

            <header class="section-heading heading-line">
                <h4 class="title-section bg">Related Products</h4>
            </header>
            <div class="row">
                @forelse($relevant_products as $product)
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

@stop
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#addToCart').submit(function (e) {
                if ($('.option').val() == 0) {
                    e.preventDefault();
                    alert('Please select a size.');
                }
            });
            $('.option').change(function () {
                $('#productPrice').html("{{ $product->sale_price != '' ? $product->sale_price : $product->price }}");
                let extraPrice = $(this).find(':selected').data('price');
                let price = parseFloat($('#productPrice').html());
                let finalPrice = (Number(extraPrice)).toFixed(2);
                $('#finalPrice').val(finalPrice);
                $('#productPrice').html(finalPrice);
            });

            $('.item-gallery-small-img').click( function (e){
                var imageSrc =  e.target.src;

                $('.main-image-anchor').attr("href", imageSrc);
                $('.main-image').attr("src", imageSrc);

            });

        });
    </script>
@endpush
