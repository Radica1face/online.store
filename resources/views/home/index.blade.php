@extends('layouts.app_shop')

@section('title', 'Главная')

@section('content')
    <!-- Home -->

    <div class="home">

    </div>


    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="product_grid">
                    @foreach($products as $product)
                        <!-- Product -->
                        @php
                            $image = '';
                            if(count($product->images) > 0){
                                $image = $product->images[0]['image'];
                            } else {
                                $image = 'no_image.png';
                            }
                        @endphp
                        <div class="product">
                            <div class="product_image"><img src="/images/products/{{ $image }}" alt=""></div>
                            <div class="product_extra product_new">
                                <a href="{{ route('showCategory', $product->category->slug) }}">
                                    {{ $product->category->title }}</a></div>
                            <div class="product_content">
                                <div class="product_title"><a href="{{ route('showProduct', [$product->category->slug, $product->slug]) }}">{{ $product->title }}</a></div>
                                @if($product->new_price)
                                    <div class="details_price">{{ $product->new_price }} &#x20bd</div>
                                    <div class="details_discount">{{ $product->price }} &#x20bd</div>
                                @else
                                    <div class="details_price">{{ $product->price }} &#x20bd</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
