@extends('layouts.app_shop')

@section('title', $category->title)
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection

{{--@section('custom_js')--}}
{{--    <script src="/js/categories.js"></script>--}}
{{--@endsection--}}

@section('content')

    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/{{ $category->image }})"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{ $category->title }}<span>.</span></div>
                                <div class="home_text"><p>{{ $category->description }}</p></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Всего товаров: <span>{{ $category->products->count() }}</span></div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Сортировать</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn" data-order="price-low-high"><span>Цена: по-возрастанию</span></li>
                                            <li class="product_sorting_btn" data-order="price-high-low"><span>Цена: по-убыванию</span></li>
                                            <li class="product_sorting_btn" data-order="name-a-z"><span>Наименование: А-Я</span></li>
                                            <li class="product_sorting_btn" data-order="name-z-a"><span>Наименование: Я-А</span></li>

                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="product_content">
                                <div class="product_title"><a href="{{ route('showProduct', [$category->slug, $product->slug]) }}">{{ $product->title }}</a></div>
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
                    @if($products->total() > $products->count())
                        <div class="row justify-content-center">
                            <div class="col-3 product_pagination">
                            {{ $products->appends(request()->query())->links() }}
                            </div>
                        </div>
                    @endif
{{--                    <div class="product_pagination">--}}
{{--                        {{ $products->appends(request()->query())->links() }}--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function(){
            $('.product_sorting_btn').click(function(){
                let orderBy =$(this).data('order')
                $('.sorting_text').text($(this).find('span').text())

                $.ajax({
                    url: "{{ route('showCategory', $category->slug) }}",
                    type: "GET",
                    data: {
                        orderBy: orderBy,
                        page: {{ isset($_GET['page']) ? $_GET['page'] : 1 }}
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        let positionParametrs = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParametrs, location.pathname.length);
                        let newUrl = url + '?';
                        newUrl += 'orderBy=' + orderBy + "&page={{ isset($_GET['page']) ? $_GET['page'] : 1 }}";
                        history.pushState({}, '', newUrl);
                        $('.product_grid').html(data)

                        $('.product_grid').isotope('destroy')
                        $('.product_grid').imagesLoaded(function(){
                            var grid = $('.product_grid').isotope({
                                itemSelector: '.product',
                                layoutMode: 'fitRows',
                                fitRows: {
                                    gutter: 30
                                }
                            });
                        });
                    }
                });
            })
        })
    </script>
@endsection
