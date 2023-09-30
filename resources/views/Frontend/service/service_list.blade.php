@extends('frontend.layouts.master_layout')
@push('css')
    <style>
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
    </style>
@endpush
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url(https://www.unipuller.com/assets/images/1678212738up-mailphp.php); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white"></h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Service</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="shop-list-page">

            {{-- There are two product page. you have to give condition here --}}
            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        {{-- Left Side --}}
                        <div class="col-xl-3 col-lg-3">
                            <div id="sidebar" class="widget-title-bordered-full">
                                <div class="dashbaord-sidebar-close d-xl-none d-lg-none">
                                    <i class="fas fa-times"></i>
                                </div>

                                {{--categories--}}
                                <div id="woocommerce_product_categories-4"
                                     class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Service Categories</h2>

                                    <ul>
                                        @foreach ($service_categories as $item)
                                            <li class="cat-item cat-parent">
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{--sub categories--}}
                                <div id="woocommerce_product_categories-4"
                                     class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Service Sub-Categories</h2>

                                    <ul>
                                        @foreach ($service_sub_categories as $item)
                                            <li class="cat-item cat-parent">
                                                {{--<a
                                                        href="{{ route('property.list', ['sub_category_id' => $sub_category_id, 'child_category_id' => $item->id]) }}">
                                                    <span
                                                            class="{{ Route::currentRouteName() === 'property.list' && request()->route('sub_category_id') == $sub_category_id && request()->route('child_category_id') == $item->id ? 'active_child_category' : '' }}">{{ $item->name }}</span>
                                                </a>--}}
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{--child categories--}}
                                <div id="woocommerce_product_categories-4"
                                     class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Service Child Categories</h2>

                                    <ul>
                                        @foreach ($service_child_categories as $item)
                                            <li class="cat-item cat-parent">
                                                {{--<a
                                                        href="{{ route('property.list', ['sub_category_id' => $sub_category_id, 'child_category_id' => $item->id]) }}">
                                                    <span
                                                            class="{{ Route::currentRouteName() === 'property.list' && request()->route('sub_category_id') == $sub_category_id && request()->route('child_category_id') == $item->id ? 'active_child_category' : '' }}">{{ $item->name }}</span>
                                                </a>--}}
                                                {{ $item }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                            {{--<select id="category" name="category">
                                <option value="">Select Category</option>
                                @foreach ($service_categories as $key=> $category)
                                    <option value="{{ $key }}">{{ $category }}</option>
                                @endforeach
                            </select>

                            <select id="subcategory" name="subcategory">
                                <option value="">Select Subcategory</option>
                            </select>--}}

                        </div>

                        {{-- Right Side --}}
                        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12">
                            <div class="product-search-one">
                                <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
                                    action="{{ route('education.list') }}" method="GET">

                                    {{-- Search box Country Name --}}

                                    {{-- <div class="select-appearance-none categori-container" id="countryForm">
                                        <select name="country" class="form-control categoris mx-2" id="country_select">
                                            <option selected="" value="">{{ __('Select Country') }}</option>
                                            @foreach (DB::table('countries')->where('status', 1)->orderby('id', 'desc')->get() as $data)
                                                <option value="{{ $data->country_name }}">
                                                    {{ $data->country_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <input type="text" id="shop_name" class="col form-control search-field"
                                        name="search" placeholder="Search course name or institution name"
                                        value="{{ request()->input('search') }}">

                                    <a type="submit" name="submit" class="search-submit"><i
                                            class="flaticon-search flat-mini text-white"></i>
                                    </a>
                                </form>
                            </div>


                            <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light" id="ajaxContent">
                                @if (count($education) > 0)
                                    <div class="row mb-4 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom"
                                         style="padding: 0px !important;">

                                        <div class="col-md-9">
                                            @foreach ($education as $item)
                                                <div class="col mb-5">

                                                    <div class="product type-product rounded ">

                                                        <div class=" row m-0">

                                                            <div
                                                                    class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center card-image">

                                                                @php
                                                                    $images = json_decode($item->images, true);
                                                                    $first_image = null;
                                                                    $img_count = null;

                                                                    if ($images) {
                                                                        $first_image = reset($images);
                                                                        $imagePath = public_path($first_image);
                                                                        $img_count = count($images);
                                                                    }

                                                                @endphp

                                                                @if ($first_image && File::exists($imagePath))
                                                                    <a href="{{ route('education_show', $item->id) }}" class="woocommerce-LoopProduct-link">
                                                                        <img class="lazy img-fluid rounded"
                                                                             data-src="{{ asset($first_image) }}"
                                                                             alt="Product Image">
                                                                    </a>
                                                                @else
                                                                    <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                                         class="swiper-lazy" alt="">
                                                                @endif

                                                            </div>

                                                            <div class=" col-lg-8 col-md-8 col-sm-12 p-0">

                                                                <div class="p-2">
                                                                    <h5 class="product-title">
                                                                        <a class="text-dark" href="{{ route('education_show', $item->id) }}">
                                                                            <span class="company-name">
                                                                                {{ Str::limit($item->course_name, $limit = 20, $end = '...') }}
                                                                            </span>
                                                                        </a>
                                                                    </h5>

                                                                    <hr class="mt-0">

                                                                    <p class="category_text text-dark"
                                                                       style="margin-bottom: 0rem; margin-top: -10px;">
                                                                        {{ Str::limit($item->description, $limit = 30, $end = '...') }}
                                                                    </p>

                                                                    <p class="category_text text-dark"
                                                                       style="margin-bottom: 0rem;">
                                                                        {{ Str::limit($item->institution_name, $limit = 30, $end = '...') }}
                                                                    </p>

                                                                </div>

                                                                <div class="d-flex text-center"
                                                                     style="background-color: whitesmoke; border-top: 3px solid var(--green);">

                                                                <span class=" flex-fill mb-0 text-white">
                                                                    <p class="lower-section-text mb-0  text-muted">
                                                                        Price
                                                                    </p>
                                                                    <p class="mb-0 text-muted">
                                                                       &pound; {{ $item->price }}
                                                                    </p>
                                                                </span>

                                                                {{--<span class=" flex-fill mb-0 text-white">
                                                                    <p class="lower-section-text mb-0  text-muted">
                                                                        Price
                                                                    </p>
                                                                    <p class="mb-0 text-muted">
                                                                        &pound; {{ $item->price }}
                                                                    </p>
                                                                </span>--}}
                                                                    <span class=" flex-fill mb-0 text-white">
                                                                    <p class="lower-section-text mb-0  text-muted">Start
                                                                        Date
                                                                    </p>
                                                                    <p class="mb-0 text-muted">
                                                                        {{ $item->start_date }}</p>
                                                                        </p>
                                                                </span>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-md-3">
                                            <div class="card">
                                                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                                                <div class="card-body">
                                                    <h5 class="card-title">Advertise your propertise</h5>
                                                    <p class="card-text">List your property unlimited and completely free.
                                                    </p>
                                                    <a href="{{ route('service-advertise.index') }}"
                                                       class="button-31">Add</a>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="card">
                                                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                                                <div class="card-body">
                                                    <h5 class="card-title">Can't find your propertise?</h5>
                                                    <p class="card-text">Advertise your requirements completely free.</p>
                                                    <a href="{{ route('property-wanted.index') }}"
                                                       class="button-31">Add</a>
                                                </div>
                                            </div>

                                            <br>

                                            <div class="card">
                                                {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                                                <div class="card-body">
                                                    <h5 class="card-title">Hire someone to find out your property.</h5>
                                                    <ol>
                                                        <li class="card-text">If you don't have time to find your property.
                                                        </li>
                                                        <li class="card-text">If you don't have idea how to deal property.
                                                        </li>

                                                    </ol>
                                                    <p class="card-text">Buy our property finding service. A completely
                                                        secure and
                                                        reliable property finding service tailored to your needs.</p>

                                                    <a href="#" class="button-31">Add</a>
                                                </div>
                                            </div>

                                            <br>
                                        </div>
                                    </div>
                                @else
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="page-center">
                                                <h4 class="text-center">{{ 'No Room Found.' }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-12 mt-3">
                                <div class="d-flex align-items-start pt-3" id="custom-pagination">
                                    <div class="pagination-style-one">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                {{ $education->links() }}
                                            </ul>
                                        </nav>
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


            // Listen for changes in the category dropdown
            $('#category').on('change', function () {
                var category_id = $(this).val();
                if (category_id) {
                    // Fetch subcategories based on the selected category
                    $.ajax({
                        url: '/get-subcategories/' + category_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            // Clear existing subcategory options
                            $('#subcategory').empty();
                            $('#subcategory').append('<option value="">Select Subcategory</option>');
                            // Populate the subcategory dropdown with retrieved data
                            $.each(data, function (key, value) {
                                $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                    });
                } else {
                    // If no category is selected, clear the subcategory dropdown
                    $('#subcategory').empty();
                    $('#subcategory').append('<option value="">Select Subcategory</option>');
                }
            });

            </script>
    @endsection
