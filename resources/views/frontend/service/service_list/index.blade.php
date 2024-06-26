@extends('frontend.product.partial.app')
@section('title', 'Service-list')
@section('css')
    <style>
        .custom-border-color {
            border-color: #38b2ac;
        }

        button:focus {
            outline: none !important;
        }

        .laptop_view_card {
            margin-left: 10px;
            width: 72%;
            margin-right: 10px;
        }

        .product-wrapperrrrr {
            position: relative;
        }

        .category-wrapper {
            position: absolute;
            background-color: #fff;
            border-radius: 6%;
            box-shadow: 0 0px 4px rgba(0, 0, 0, 0.2);
            z-index: 1;
            background-color: #039f2d;
        }

        .category-badge h6 {
            margin: 0;
            padding: 3px;
            font-size: 13px;
            color: #fff;
        }

        .mobile_view_image {
            border-top-left-radius: 0.25rem !important;
            border-bottom-left-radius: 0.25rem !important;
        }


        @media (max-width: 767px) {
            .mobile_view_card {
                margin-top: 30px !important;
                width: 95% !important;
            }

            .mobile_view_image {
                width: 60% !important;
            }

            .mobile_view_center {
                justify-content: center !important;
            }

            .mobile_view_card_descripition {
                padding-left: 15px !important;
            }

            .mr-10 {
                margin-left: 10px !important;
            }
        }
    </style>
@endsection
@section('property_list_content')
    <div class="product-search-one mb-3">

        <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
            action="{{ route('service.list', array_merge(request()->except('page'), ['search' => strtolower(request()->input('search'))])) }}"
            method="GET">
            <input type="text" id="shop_name" class="col form-control search-field" name="search"
                placeholder="Search service" value="{{ request()->input('search') }}">
            <input type="hidden" name="category_id" value="{{ request()->input('category_id') }}">
            <input type="hidden" name="sub_category_id" value="{{ request()->input('sub_category_id') }}">
            <input type="hidden" name="child_category_id" value="{{ request()->input('child_category_id') }}">
            <button type="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i></button>
        </form>

    </div>

    @foreach ($products as $item)
        <div class="col mb-4">
            <div class="product type-product rounded">
                <div class="row">

                    @if ($item->thumbnail)
                        <a href="{{ route('product.show', ['id' => $item->id, 'name' => rawurlencode($item->name)]) }}"
                            class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                            style="padding-right: 0px; height: 188px;">

                            <img class="lazy img-fluid w-100 mobile-view-image" src="{{ asset($item->thumbnail) }}"
                                alt="Product Image">

                            @if ($item->category)
                                <div class="category-wrapper">
                                    <div class="category-badge">
                                        <h6>{{ Str::limit($item->category->name, $limit = 50, $end = '...') }}</h6>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('product.show', ['id' => $item->id, 'name' => rawurlencode($item->name)]) }}"
                            class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                            style="padding-right: 0px; height: 188px;">

                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                class="lazy img-fluid rounded w-100 mobile-view-image" alt="" style="">

                            @if ($item->category)
                                <div class="category-wrapper">
                                    <div class="category-badge">
                                        <h6>{{ Str::limit($item->category->name, $limit = 50, $end = '...') }}</h6>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @endif

                    <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column  mobile_view_card_descripition"
                        style="padding-right: 15px !important; padding-left: 4px;">
                        <div class="p-1 flex-grow-1">
                            <h5 class="product-title" style="padding: 0; margin: 0;">
                                <a class="text-dark"
                                    href="{{ route('product.show', ['id' => $item->id, 'name' => rawurlencode($item->name)]) }}"
                                    style="font-weight: 600;">
                                    {{ Str::limit($item->name, $limit = 45, $end = '...') }}
                                </a>
                            </h5>
                            <hr style="color: #38b2ac; height: 1px; width: 100% !important; margin: 0rem 0">


                            <p class="text-dark"
                                style="margin: 0; margin-top: 7px; text-align: justify; padding: 0; line-height: 1.5;">

                                {!! Str::limit($item->define_this_item, $limit = 285, $end = '...') !!}
                            </p>

                        </div>
                        <div class="d-flex mr-10 text-center"
                            style="background-color: white; padding: 1px; margin-left: 12px; margin-right: 5px;">
                            <div class="col division" style="border: 1px  solid var(--green);">
                                <button type="button" class="btn-sm">Add to Cart</button>
                            </div>
                            <div class="col division" style="border: 1px solid var(--green);">
                                <a href="#" style="color: inherit">
                                    <i class="fa-regular fa-heart mt-2"></i>
                                </a>
                            </div>
                            <a class="col division" style="border: 1px solid var(--green); color: inherit;"
                                href="{{ route('product.show', ['id' => $item->id, 'name' => rawurlencode($item->name)]) }}">Details
                            </a>
                            <div class="col division" style="border: 1px solid var(--green);">
                                @php
                                    $amount = 0;
                                    foreach ($item->variations as $variation_data) {
                                        $amount += $variation_data->default_sell_price;
                                    }
                                @endphp
                                &pound; {{ number_format($amount, 2) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    {{-- Pagination --}}
    @include('frontend.pagination.pagination', ['paginator' => $products])

@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.toggle-category').click(function() {
                $(this).siblings('ul').toggle();
                return false;
            });
        });
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
    </script>

    <script>
        $(document).ready(function() {
            $('.toggle-category').click(function() {
                var svg = $(this).find('.toggle-icon svg');
                var beforeRotation = svg.css('transform');
                console.log("Before rotation: " + beforeRotation);

                var currentRotation = (beforeRotation === 'none' || beforeRotation ===
                    'matrix(1, 0, 0, 1, 0, 0)') ? 0 : 90;
                var newRotation = (currentRotation === 0) ? 90 : 0;
                svg.toggleClass('rotate-90', newRotation === 90);
                svg.css('transform', 'rotate(' + newRotation + 'deg)');

                var afterRotation = svg.css('transform');
                console.log("After rotation: " + afterRotation);
            });
        });
    </script>

@endsection
