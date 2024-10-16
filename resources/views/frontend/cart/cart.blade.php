@extends('frontend.layouts.master_layout')
@section('title', 'Carts')
@section('css')
    <style>
        .s_table {
            border: 1px solid var(--theme-gray-color);
            ;
        }

        .s_table tr th {
            background: var(--theme-light-color);
        }

        .cart-table {
            overflow-x: scroll;
        }

        .cart-table table * {
            text-wrap: nowrap;
        }

        .product-thumbnail img {
            object-fit: cover;
        }

        .remove-btn {
            font-family: 'Amazon Ember', sans-serif;
            position: relative;
            text-align: center;
            color: #0d6efd;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="load_cart">
        <div class="full-row cartpage">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-12">
                        <div class="cart-table">
                            <div class="gocover"
                                style="position: absolute; background: url({{ asset('assets/images/xloading.gif') }}) center center no-repeat scroll rgba(255, 255, 255, 0.5); display: none;">
                            </div>

                            <table class="s_table table table-responsive-sm">
                                <tr class="text-center">
                                    <th class="product-thumbnail">&nbsp;</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Subtotal</th>
                                    <th class="product-remove">&nbsp;</th>
                                </tr>

                                @foreach ($products as $product)
                                    <tr class="woocommerce-cart-form__cart-item cart_item text-center">
                                        <td class="product-thumbnail">
                                            <img width="120" height="80"
                                                src="{{ $product->thumbnail ? asset($product->thumbnail) : asset('assets/images/noimage.png') }}"
                                                alt="Product image">
                                        </td>
                                        <td class="product-name text-start">
                                            <a href="">{{ $product->name }}</a>
                                            @if (!empty($product['color']))
                                                <div class="d-flex mt-2 ml-1">

                                                    <b>{{ __('Colour') }}</b>: <span id="color-bar"
                                                        style="border: 10px solid #{{ $product['color'] == '' ? 'white' : $product['color'] }};"></span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="product-price">
                                            <span>£ {{ $product->price }}</span>
                                        </td>

                                        @if ($product->type == 'Physical' && $product->type != 'affiliate')
                                            <td class="product-quantity">
                                                <input type="hidden" class="prodid" value="{{ $product->id }}">
                                                <input type="hidden" class="itemid"
                                                    value="{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}">
                                                <input type="hidden" class="size_qty" value="{{ $product['size_qty'] }}">
                                                <input type="hidden" class="size_price"
                                                    value="{{ $product['size_price'] }}">
                                                <input type="hidden" class="minimum_qty"
                                                    value="{{ $product->minimum_qty == null ? '0' : $product->minimum_qty }}">
                                                <div class="quantity">
                                                    <input min="1"
                                                        id="qty{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}"
                                                        class="qttotal1" type="number" name="quantity"
                                                        value="{{ $product['qty'] }}">
                                                </div>
                                            </td>
                                        @else
                                            <td class="product-quantity">
                                                1
                                            </td>
                                        @endif
                                        @if ($product['size_qty'])
                                            <input type="hidden"
                                                id="stock{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}"
                                                value="{{ $product['size_qty'] }}">
                                        @elseif($product->type != 'Physical')
                                            <input type="hidden"
                                                id="stock{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}"
                                                value="1">
                                        @else
                                            <input type="hidden"
                                                id="stock{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}"
                                                value="{{ $product['stock'] }}">
                                        @endif
                                        <td class="product-subtotal">
                                            <p class="d-inline-block"
                                                id="prc{{ $product->id . $product['size'] . $product['color'] . str_replace(str_split(' ,'), '', $product['values']) }}">
                                                £ {{ $product->price }}
                                            </p>
                                            @if ($product['discount'] != 0)
                                                <strong>{{ $product['discount'] }} %{{ __('off') }}</strong>
                                            @endif

                                        </td>
                                        <td class="product-remove">
                                            <form action="{{ route('product.cart.remove') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $product->id }}">
                                                <button type="submit" class="remove-btn">x</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-12">
                        <div class="cart-collaterals">
                            <div class="cart_totals ">
                                <h2>{{ __('Cart totals') }}</h2>
                                <table>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>
                                            <span><b class="cart-total">£ {{ $total_price_excluding_tax }}</b>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Vat</th>
                                        <td>
                                            <span><b class="cart-total">£ {{ $total_vat }}</b>
                                            </span>
                                        </td>
                                    </tr>

                                    {{-- <tr>
                                        <th>{{ __('Discount') }}</th>
                                        <td>
                                            <span>
                                                <b class="discount">{{ App\Product::convertPrice(0) }}</b>
                                                <input type="hidden" id="d-val"
                                                    value="{{ App\Product::convertPrice(0) }}">
                                            </span>
                                        </td>
                                    </tr> --}}

                                    <tr class="order-total">
                                        <th>Total</th>
                                        <td><strong><span class="woocommerce-Price-amount amount main-total">£
                                                    {{ $total_price }}</span></strong>
                                        </td>
                                    </tr>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{ route('front.checkout') }}"
                                        class="checkout-button">{{ __('Proceed to checkout') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')

@endsection
