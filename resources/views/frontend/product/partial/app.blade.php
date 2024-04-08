@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        .hello {
            margin-top: 500px;
        }

        .category_text {
            color: #225db5;
        }

        .title_height {
            height: 60px;
        }

        .title_height2 {
            height: 40px;
        }

        .shop_about {
            margin-left: 15px;
            margin-right: 15px;
        }

        p.about_line {
            min-height: 40px;
            max-height: 40px;
        }

        p.category_text {
            /* min-height: 20px;
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            max-height: 20px; */
        }

        h5.product-title {
            min-height: 35px;
            max-height: 35px;
        }

        .product-info .product-title a {
            font-size: 18px !important;
        }

        .product-info p {
            font-size: 14px;
            line-height: 25px;
            margin-bottom: 2px;
        }

        .product-wrapper .product-info .product-title,
        .product-wrapper .product-info .product-title a {
            font-weight: 400;
            font-size: 22px;
        }

        .active_child_category {
            color: red !important;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">

        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row">

                        {{-- Left Side --}}
                        <div class="col-12 col-xl-3 col-lg-3">
                            <div id="sidebar" class="widget-title-bordered-full">

                                <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle">
                                    <h2 class="widget-title">Categories</h2>
                                    <ul class="product-categories">
                                        @foreach ($nestedDataSets as $category)
                                            <li class="cat-item cat-parent">
                                                <a href="{{ route('service.list', ['category_id' => $category['id']]) }}"
                                                    @if (!empty($category['children']) && request()->category_id == $category['id']) class="toggle-category expanded"
                                                @elseif (!empty($category['children']))
                                                    class="toggle-category" @endif>
                                                    <span
                                                        class="toggle-icon {{ Route::currentRouteName() === 'service.list' && request()->category_id == $category['id'] ? 'text-danger' : '' }}">
                                                        &nbsp;{{ $category['name'] }}
                                                        @if (!empty($category['children']))
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                height="16" viewBox="0 0 16 16" class="toggle-svg"
                                                                style="{{ !empty($category['children']) && request()->category_id == $category['id'] ? 'transform: rotate(90deg);' : '' }}">
                                                                <path fill="none" stroke="rgba(0,0,0,.5)"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M5 14l6-6-6-6" />
                                                            </svg>
                                                        @endif
                                                    </span>
                                                </a>

                                                <!-- Subcategories -->
                                                @if (!empty($category['children']))
                                                    <ul class="children"
                                                        @if (request()->category_id == $category['id']) style="display: block;" @endif>
                                                        @foreach ($category['children'] as $childCategory)
                                                            <li class="cat-item cat-parent">
                                                                <a href="{{ route('service.list', ['category_id' => $category['id'], 'sub_category_id' => $childCategory['id']]) }}"
                                                                    @if (!empty($childCategory['children']) && request()->sub_category_id == $childCategory['id']) class="toggle-category expanded"
                                                                @elseif (!empty($childCategory['children']))
                                                                    class="toggle-category" @endif>
                                                                    <span
                                                                        class="toggle-icon {{ Route::currentRouteName() === 'service.list' && request()->sub_category_id == $childCategory['id'] ? 'text-danger' : '' }} toggle-icon">
                                                                        &nbsp;{{ $childCategory['name'] }}
                                                                        @if (!empty($childCategory['children']))
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                width="16" height="16"
                                                                                viewBox="0 0 16 16" class="toggle-svg"
                                                                                style="{{ !empty($childCategory['children']) && request()->sub_category_id == $childCategory['id'] ? 'transform: rotate(90deg);' : '' }}">
                                                                                <path fill="none" stroke="rgba(0,0,0,.5)"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="M5 14l6-6-6-6" />
                                                                            </svg>
                                                                        @endif
                                                                    </span>
                                                                </a>

                                                                <!-- Sub child categories -->
                                                                @if (!empty($childCategory['children']))
                                                                    <ul class="sub-children"
                                                                        @if (request()->sub_category_id == $childCategory['id']) style="display: block;" @else style="display: none;" @endif>
                                                                        @foreach ($childCategory['children'] as $subChildCategory)
                                                                            <li class="cat-item cat-parent">
                                                                                <a
                                                                                    href="{{ route('service.list', ['category_id' => $category['id'], 'sub_category_id' => $childCategory['id'], 'child_category_id' => $subChildCategory['id']]) }}">
                                                                                    <span
                                                                                        class="{{ Route::currentRouteName() === 'service.list' && request()->child_category_id == $subChildCategory['id'] ? 'text-danger' : '' }}">
                                                                                        &nbsp; &nbsp;
                                                                                        &nbsp;{{ $subChildCategory['name'] }}
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>


                                {{-- <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Categories</h2>

                                    <ul class="product-categories">
                                        @foreach ($categories as $key => $item)
                                            <li class="cat-item cat-parent">
                                                <a href="{{ route('service.list', ['category_id' => @$key]) }}">
                                                    <span
                                                        class="{{ Route::currentRouteName() === 'service.list' && request()->category_id == $key ? 'text-danger' : '' }}">{{ $item }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Sub-Categories</h2>

                                    <ul>
                                        @if (@$sub_categories)
                                            @foreach ($sub_categories as $key => $item)
                                                <li class="cat-item cat-parent">
                                                    <a
                                                        href="{{ route('service.list', ['category_id' => @$category_id, 'sub_category_id' => @$key]) }}">
                                                        <span
                                                            class="{{ Route::currentRouteName() === 'service.list' && request()->sub_category_id == $key ? 'text-danger' : '' }}">{{ $item }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>

                                <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle mb-3 mb-lg-0">

                                    <h2 class="widget-title">Child-Categories</h2>

                                    <ul>
                                        @if (@$child_categories)
                                            @foreach ($child_categories as $key => $item)
                                                <li class="cat-item cat-parent">
                                                    <a
                                                        href="{{ route('service.list', ['category_id' => @$category_id, 'sub_category_id' => @request()->sub_category_id, 'child_category_id' => @$key]) }}">
                                                        <span
                                                            class="{{ Route::currentRouteName() === 'service.list' && request()->child_category_id == $key ? 'text-danger' : '' }}">{{ $item }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div> --}}

                            </div>
                        </div>

                        {{-- Right Side --}}
                        <div class="col-12 col-xl-9 col-lg-9 col-md-12 col-sm-12" style="padding: 0px !important;">
                            {{-- <div class="product-search-one">
                                <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
                                    action="{{ route('property.list') }}" method="GET">

                                    <input type="text" id="shop_name" class="col form-control search-field"
                                        name="search" placeholder="Search Product"
                                        value="{{ request()->input('search') }}">

                                    <a type="submit" name="submit" class="search-submit"><i
                                            class="flaticon-search flat-mini text-white"></i>
                                    </a>
                                </form>
                            </div> --}}


                            <div class="showing-products border-2 border-bottom border-light" id="ajaxContent">


                                <div class="row mb-4 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom"
                                    style="padding: 0px !important;">
                                    <div class="col-md-9 laptop_view_card mobile_view_card">
                                        @if (count($products) > 0)
                                            @yield('property_list_content')
                                        @else
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="page-center">
                                                        <h4 class="text-center text-danger">{{ 'No Product Found.' }}</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Right side Advertise widget --}}
                                    <div class="col-md-3">

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Advertise your service</h5>
                                                <p class="card-text">List your service unlimited and completely free.
                                                </p>
                                                <a href="{{ route('products.create') }}" class="button-31">Add</a>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Can't find your service?</h5>
                                                <p class="card-text">Contact us to get what you need. We will connect
                                                    you with the right service provider who knows that solution.</p>
                                                <a href="#" class="button-31">Add</a>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Software to run your business?</h5>
                                                <p class="card-text">Use our complete business solution software package
                                                    completely free of charge. The most updated and latest technology to
                                                    serve your business needs.</p>
                                                <a href="{{ url('business/register') }}" class="button-31">Add</a>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Find your favourite company.</h5>
                                                <ol>
                                                    <li class="card-text">Company wise filter
                                                    </li>
                                                    <li class="card-text">Search by location
                                                    </li>
                                                </ol>
                                                <a href="{{ route('shop.list') }}" class="button-31">Details</a>
                                            </div>
                                        </div>

                                        <br>

                                    </div>
                                </div>

                            </div>
                            {{-- <div class="col-lg-8 mt-3 text-center">
                                <div class="d-flex align-items-start pt-3" id="custom-pagination">
                                    <div class="pagination-style-one mx-auto">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $rooms->links() }}
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div> --}}

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        setTimeout(function() {
            if ($(window).width() < 1350) {
                $(".large_screen").css("display", "none");
                $(".small_screen").css("display", "block");
            } else {
                console.log("small");
                $(".large_screen").css("display", "block");
                $(".small_screen").css("display", "none");
            }
        }, 1000);


        document.addEventListener("DOMContentLoaded", function() {
            function adjustCompanyName() {
                var companyNames = document.getElementsByClassName('company-name');
                var maxLengths = [60, 30, 25, 40, 20]; // Maximum lengths for different screen widths

                for (var i = 0; i < companyNames.length; i++) {
                    var paragraph = companyNames[i];
                    var maxWidth = window.innerWidth;
                    var maxLength;

                    // Determine the maximum length based on the screen width
                    if (maxWidth < 768) {
                        maxLength = maxLengths[0];
                    } else if (maxWidth >= 768 && maxWidth < 992) {
                        maxLength = maxLengths[2];
                    } else if (maxWidth >= 992 && maxWidth < 1024) {
                        maxLength = maxLengths[1];
                    } else if (maxWidth >= 1024 && maxWidth < 1240) {
                        maxLength = maxLengths[4];
                    } else {
                        maxLength = maxLengths[0];
                    }

                    var text = paragraph.innerText; // Use innerText to retrieve the visible text
                    var truncatedText = text.length > maxLength ? text.substring(0, maxLength) + "..." : text;
                    paragraph.innerText = truncatedText; // Update the content of the paragraph
                }
            }

            function adjustCompanyDetail() {
                var details = document.getElementsByClassName('about_line');
                var maxLen = [90, 60, 80, 110, 50]; // Maximum lengths for different screen widths

                for (var i = 0; i < details.length; i++) {
                    var detail = details[i];
                    var maxWidth = window.innerWidth;
                    var max;

                    // Determine the maximum length based on the screen width
                    if (maxWidth < 768) {
                        max = maxLen[0];
                    } else if (maxWidth >= 768 && maxWidth < 992) {
                        max = maxLen[1];
                    } else if (maxWidth > 992 && maxWidth < 1024) {
                        max = maxLen[2];
                    } else if (maxWidth >= 1024 && maxWidth < 1240) {
                        max = maxLen[4];
                    } else if (maxWidth >= 1240 && maxWidth < 1440) {
                        max = maxLen[3];
                    } else {
                        max = maxLen[0];
                    }

                    var text = detail.innerText; // Use innerText to retrieve the visible text
                    var truncatedText = text.length > max ? text.substring(0, max) + "..." : text;
                    detail.innerText = truncatedText; // Update the content of the paragraph
                }
            }
            adjustCompanyName(); // Initial adjustment
            adjustCompanyDetail(); // Initial adjustment

            function resizeEventHandler() {
                adjustCompanyDetail();
                adjustCompanyName();
            }

            window.addEventListener('resize', resizeEventHandler);

        });


        function submitForm(categoryId) {
            console.log(categoryId);
            // Set the value of the hidden input field to the categoryId
            document.querySelector('#categoryForm input[name="search"]').value = parseInt(categoryId);

            // Submit the form
            document.querySelector('#categoryForm').submit();
        }
    </script>

    <script>
        function handleMinWidth992px() {
            if (window.innerWidth <= 992) {
                $('.widget-toggle').addClass('closed')
            } else {
                $('.widget-toggle').removeClass('closed')
            }
        }

        // Attach the event listener to the window's resize event
        window.addEventListener('resize', handleMinWidth992px);

        // Call the function initially to check the condition
        handleMinWidth992px();
    </script>
@endsection
