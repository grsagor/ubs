@extends('frontend.news.partial.app')
@section('title', 'News-list')
@section('css')
    @include('frontend.news.partial.css')
@endsection
@section('property_list_content')
    <div class="product-search-one mb-3">

        <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
            action="{{ route('service.list', array_merge(request()->except('page'), ['search' => strtolower(request()->input('search'))])) }}"
            method="GET">
            <input type="text" id="shop_name" class="col form-control search-field" name="search" placeholder="Search News"
                value="{{ request()->input('search') }}">
            <input type="hidden" name="category_id" value="{{ request()->input('category_id') }}">
            <input type="hidden" name="sub_category_id" value="{{ request()->input('sub_category_id') }}">
            <input type="hidden" name="child_category_id" value="{{ request()->input('child_category_id') }}">
            <button type="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i></button>
        </form>

    </div>
    {{-- 
    @foreach ($products as $item)
        <div class="col mb-4 custom-card">
            <a href="{{ route('product.show', $item->slug) }}" class="product-link-wrapper"
                style="display: block; text-decoration: none;">
                <div class="product type-product rounded">
                    <div class="row">
                        @if ($item->thumbnail)
                            <div class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                                style="padding-right: 0px; height: 188px;">
                                <img class="lazy img-fluid w-100 mobile-view-image" src="{{ asset($item->thumbnail) }}"
                                    alt="Product Image">
                                @if ($item->category)
                                    <div class="category-wrapper">
                                        <div class="category-badge">
                                            <h6>{{ Str::limit($item->category->name, 50, '...') }}</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                                style="padding-right: 0px; height: 188px;">
                                <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                    class="lazy img-fluid rounded w-100 mobile-view-image" alt="">
                                @if ($item->category)
                                    <div class="category-wrapper">
                                        <div class="category-badge">
                                            <h6>{{ Str::limit($item->category->name, 50, '...') }}</h6>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column mobile_view_card_descripition"
                            style="padding-right: 15px !important; padding-left: 4px;">
                            <div class="p-1 flex-grow-1">
                                <h5 class="product-title" style="padding: 0; margin: 0;">
                                    <span class="text-dark" style="font-weight: 600;">
                                        {{ Str::limit($item->name, 45, '...') }}
                                    </span>
                                </h5>

                                <p class="text-dark"
                                    style="margin: 0; margin-top: 7px; text-align: justify; padding: 0; line-height: 1.5;">
                                    {!! Str::limit($item->define_this_item, 285, '...') !!}
                                </p>
                            </div>
                            <div class="d-flex mr-10 text-center" style="padding: 0px 10px 7px 10px;">
                                <div class="col division fw-bold text-dark">
                                    @php
                                        $amount = 0;
                                        foreach ($item->variations as $variation_data) {
                                            $amount += $variation_data->default_sell_price;
                                        }
                                    @endphp
                                    &pound;{{ number_format($amount, 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach --}}


    {{-- Pagination --}}
    {{-- @include('frontend.pagination.pagination', ['paginator' => $products]) --}}

@endsection

@section('script')
    @include('frontend.news.partial.js')
@endsection
