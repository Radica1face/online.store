@extends('layouts.app_shop')

@section('title', 'Корзина')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/cart.css">
    <link rel="stylesheet" type="text/css" href="/styles/cart_responsive.css">
@endsection

@section('custom_js')
    <script src="/js/cart.js"></script>
    <script>

        function cartInc(id){
            // let id = $('.cart_item_name').data('id')
            let total_qty = parseInt($('.cart-qty').text())

            total_qty += 1

            $('.cart-qty').text(total_qty)


            $.ajax({
                url: "{{ route('cartInc') }}",
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#quantity_input_' + id).val(data[id].quantity)
                    $('.cart_item_total_' +id).text(data[id].quantity * data[id].price)
                }
            });
        }

        function cartDec(id){
            // let id = $('.cart_item_name').data('id')
            let total_qty = parseInt($('.cart-qty').text())

            total_qty -= 1

            $('.cart-qty').text(total_qty)


            $.ajax({
                url: "{{ route('cartDec') }}",
                type: "POST",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    $('#quantity_input_' + id).val(data[id].quantity)
                    $('.cart_item_total_' +id).text(data[id].quantity * data[id].price)
                }
            });
        }

    </script>
@endsection

@section('content')

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(images/cart.jpg)"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li><a href="/">Главная</a></li>
                                        <li>@yield('title')</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Cart Info -->

<div class="cart_info">
    <div class="container">
        @if(! Cart::session($_COOKIE['cartId'])->getTotalQuantity())
            <div class="row justify-content-center"></div>
            <div class="col-md-3">Ваша корзина пуста</div>
        @else
        <div class="row">
            <div class="col">
                <!-- Column Titles -->
                <div class="cart_info_columns clearfix">
                    <div class="cart_info_col cart_info_col_product">Наименование товара</div>
                    <div class="cart_info_col cart_info_col_price">Цена</div>
                    <div class="cart_info_col cart_info_col_quantity">Количество</div>
                    <div class="cart_info_col cart_info_col_total">Всего</div>
                </div>
            </div>
        </div>
        <div class="row cart_items_row">
            <div class="col">
                @foreach($productsInCart as $product)
                <!-- Cart Item -->
                    <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">

                        <!-- Name -->
                        <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                            <div class="cart_item_image">
                                <div><img src="/images/products/{{ $product->attributes->img }}" alt=""></div>
                            </div>
                            <div class="cart_item_name_container">
                                <div class="cart_item_name" data-id="{{ $product->id }}">
                                    <a href="{{ route('showProduct', [$product->attributes->c_slug, $product->attributes->p_slug]) }}">
                                        {{ $product->name }}
                                    </a>
                                </div>
                                {{--<div class="cart_item_edit"><a href="#">Edit Product</a></div>--}}
                            </div>
                        </div>
                        <!-- Price -->
                        <div class="cart_item_price">&#x20bd {{ $product->price }}</div>
                        <!-- Quantity -->
                        <div class="cart_item_quantity">
                            <div class="product_quantity_container">
                                <div class="product_quantity clearfix">
                                    <span>К-во:</span>
                                    <input id="quantity_input_{{ $product->id }}" type="text" pattern="[0-9]*" value="{{ $product->quantity }}">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button_{{ $product->id }}" class="quantity_inc quantity_control">
                                            <a href="#" onclick="cartInc({{ $product->id }}); return false;">
                                                <i class="fa fa-chevron-up" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <div id="quantity_dec_button_{{ $product->id }}" class="quantity_dec quantity_control">
                                            <a href="#" onclick="cartDec({{ $product->id }}); return false;">
                                                <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Total -->
                        <div class="cart_item_total cart_item_total_{{ $product->id }}">&#x20bd {{ Cart::session($_COOKIE['cartId'])->get($product->id)->getPriceSum()}}</div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="row row_cart_buttons">
            <div class="col">
                <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                    <div class="button continue_shopping_button"><a href="#">Вернуться к покупкам</a></div>
                    <div class="cart_buttons_right ml-lg-auto">
                        <div class="button update_cart_button">
                            <a href="#" onClick="window.location.reload(); return false;">Пересчитать</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row_extra">
            <div class="col-lg-4">

            </div>

            <div class="col-lg-6 offset-lg-2">
                <div class="cart_total">
                    <div class="section_title">Итого:</div>
                    <div class="section_subtitle">Общая сумма</div>
                    <div class="cart_total_container">
                        <ul>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Всего:</div>
                                <div class="cart_total_value ml-auto">&#x20bd {{ Cart::session($_COOKIE['cartId'])->getTotal()}}</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Скидка</div>
                                <div class="cart_total_value ml-auto">0</div>
                            </li>
                            <li class="d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_total_title">Итого:</div>
                                <div class="cart_total_value ml-auto">&#x20bd {{ Cart::session($_COOKIE['cartId'])->getTotal()}}</div>
                            </li>
                        </ul>
                    </div>
                    <div class="button checkout_button"><a href="#">Оформить заказ</a></div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection

