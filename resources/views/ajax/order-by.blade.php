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
        <div class="product_image"><img src="/images/{{ $image }}" alt=""></div>
        <div class="product_content">
            <div class="product_title"><a href="{{ route('showProduct', [$category->slug, $product->slug]) }}">{{ $product->title }}</a></div>
            @if($product->new_price)
                <div class="details_discount">&#x20bd {{ $product->price }}</div>
                <div class="details_price">&#x20bd {{ $product->new_price }}</div>
            @else
                <div class="details_price">&#x20bd {{ $product->price }}</div>
            @endif
        </div>
    </div>
@endforeach
