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
    @includeIf('Frontend.partials.global.common-header')

    <div class="shop-list-page">

        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        {{-- Left Side --}}
                        <div class="col-xl-3 col-lg-3">
                            <div id="sidebar" class="widget-title-bordered-full">
                                <div class="dashbaord-sidebar-close d-xl-none d-lg-none">
                                    <i class="fas fa-times"></i>
                                </div>

                                <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Service categories</h2>

                                    <ul class="product-categories">

                                        <li class="cat-item cat-parent">
                                            <a href="{{ route('room.list') }}" class="category-link" id="cat"><span
                                                    class="text-danger">Properties To
                                                    Rent </span></a>
                                        </li>

                                        <li class="cat-item cat-parent">
                                            <a href="{{ route('property.list') }}" class="category-link"
                                                id="cat">Properties
                                                Wanted </a>
                                        </li>

                                    </ul>
                                </div>




                                <div id="woocommerce_product_categories-4"
                                    class="widget woocommerce widget_product_categories widget-toggle">

                                    <h2 class="widget-title">Property Type</h2>

                                    <ul>
                                        @foreach ($categories as $item)
                                            <li class="cat-item cat-parent">
                                                <form action="{{ route('room.list.category') }}" method="GET">
                                                    {{-- @csrf --}}
                                                    <button type="submit" class="category-link">
                                                        @if (request()->input('search') == $item->id)
                                                            <span class="text-danger"> {{ $item->name }}</span>
                                                        @else
                                                            {{ $item->name }}
                                                        @endif

                                                    </button>
                                                    <input type="hidden" name="search" value="{{ $item->id }}">
                                                </form>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>

                        @yield('property_list_content')


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
@endsection