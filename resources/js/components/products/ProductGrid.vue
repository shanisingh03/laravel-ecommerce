<template>
    <div class="col-md-4 product-list-image">
        <figure class="card card-product">
            <div class="img-wrap">
                @if(!empty($product->images))
                <img class="p-2" src="{{ asset('storage/'.$product->images->first()->full) }}" alt="{{$product->name}}"
                    height="100%">
                @else
                <img src="https://via.placeholder.com/240" alt="{{$product->name}}">
                @endif
            </div>
            <figcaption class="info-wrap">
                <h4 class="title">{{$product->name}}</h4>
                <p class="desc">
                    {{$product->brand->name}} - {{$product->categories->first()->name}}
                </p>
            </figcaption>
            <div class="bottom-wrap">
                <a href="" class="btn btn-sm btn-primary float-right">Add To Cart</a>
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
</template>

<script>
    export default {
        props:{
            product:{
                type: Object,
                required: true
            }
        }
    }

</script>

<style>

</style>
