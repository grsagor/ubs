@extends('frontend.product.partial.app')
@push('css')
    <style>
        .custom-border-color {
            border-color: #38b2ac;
        }
    </style>
@endpush
@section('property_list_content')
    @foreach ($products as $item)
        <div class="col mb-3">
            <div class="product type-product rounded ">
                <div class="row">
                    @if ($item->image)
                        <a href="{{ route('product.show', $item->slug) }}"
                            class="woocommerce-LoopProduct-link col-lg-4 col-md-4 col-sm-12 d-flex p-0">
                            <img class="lazy img-fluid rounded w-100" src="{{ asset('upload/' . $item->image) }}"
                                alt="Product Image">
                        </a>
                    @else
                        <a href="{{ route('product.show', $item->slug) }}"
                            class="woocommerce-LoopProduct-link col-lg-4 col-md-4 col-sm-12 d-flex">
                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                class="swiper-lazy" alt="" style="height: 270px;">
                        </a>
                    @endif
                    <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column">
                        <div class="p-1 flex-grow-1">
                            <h5 class="product-title" style="padding: 0; margin: 0;">
                                <a class="text-dark" href="{{ route('product.show', $item->slug) }}"
                                    style="font-weight: 600;">
                                    {{ Str::limit($item->name, $limit = 92, $end = '...') }}
                                </a>
                            </h5>
                            <div class="text-center">
                                <hr style="color: #38b2ac; height: 1px; width: 100% !important; margin: 0rem 0">
                                @if ($item->category)
                                    <div
                                        style="display: inline-block; padding: 6px 6px 3px 6px; background-color: #fff; border-radius: 6%; box-shadow: 0 0px 4px rgba(0, 0, 0, 0.2);">
                                        <h6 style="margin: 0;">
                                            {{ Str::limit($item->category ? $item->category->name : '', $limit = 375, $end = '...') }}
                                        </h6>
                                    </div>
                                @endif
                            </div>

                            <p class="text-dark" style="margin: 0; text-align: justify; padding: 0; line-height: 1.2;">
                                {!! Str::limit($item->product_description, $limit = 180, $end = '...') !!}
                            </p>
                        </div>
                        <div class="d-flex mr-10 text-center" style="background-color: white; padding: 1px">
                            <div class="col division" style="border: 1px  solid var(--green);">
                                <button type="button" class="btn-sm">Add to Cart</button>
                            </div>
                            <div class="col division" style="border: 1px solid var(--green);">
                                <a href="#" style="color: inherit">
                                    <i class="fa-regular fa-heart mt-2"></i>
                                </a>
                            </div>
                            <div class="col division" style="border: 1px solid var(--green);">Discount %</div>
                            <div class="col division" style="border: 1px solid var(--green);">Price &pound;</div>
                        </div>
                        {{-- <div class="d-flex text-center"
                                 style="background-color: whitesmoke; border-top: 2px solid var(--green); padding: 1px">
                                <span class="flex-fill mt-2">
                                    <button type="button" class="btn-outline-secondary btn-sm">Add to Cart</button>
                                </span>
                                <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-4">
                                    <div class="wishlist-button">
                                        <a class="add_to_wishlist" href=""></a>
                                    </div>
                                </div>
                                @if ($item->room_details !== 'null' && $item->room_details !== null)
                                    @php
                                        $roomDetails = json_decode($item->room_details, true);

                                        // Check if $roomDetails is not null and is an array
                                        if (is_array($roomDetails)) {
                                            $finalData = []; // Initialize an empty array to store the results

                                            foreach ($roomDetails as $key => $data) {
                                                if ($data == 1) {
                                                    $finalData[] = $key + 1 . '-Single'; // Concatenate key and value
                                                } elseif ($data == 2) {
                                                    $finalData[] = $key + 1 . '-Double'; // Concatenate key and value
                                                } elseif ($data == 3) {
                                                    $finalData[] = $key + 1 . '-Semi-double'; // Concatenate key and value
                                                } elseif ($data == 4) {
                                                    $finalData[] = $key + 1 . '-En-suit'; // Concatenate key and value
                                                }
                                            }

                                            // Join the elements of the array into a string using a comma and space as separators
                                            $output = implode(', ', $finalData);
                                        }
                                    @endphp
                                @endif
                                <span class="flex-fill mb-0 text-white">
                                    <p class="lower-section-text mb-0 text-muted"
                                       style="color: black !important; font-size: 15px;">
                                        Discount Price
                                    </p>
                                    <p class="mb-0 text-muted">
                                        &pound; {{ $item->price }}
                                    </p>
                                </span>
                                <span class="flex-fill mb-0 text-white">
                                    <p class="lower-section-text mb-0 text-muted"
                                       style="color: black !important; font-size: 15px;">
                                        Price
                                    </p>
                                    <p class="mb-0 text-muted">
                                       &pound; {{ $item->price }}
                                    </p>
                                </span>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="col-lg-12 mt-3 text-center">
        <div class="d-flex align-items-start pt-3" id="custom-pagination">
            <div class="pagination-style-one mx-auto">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        {{ $products->appends(['page' => $products->currentPage()])->links() }}
                    </ul>
                </nav>
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
    </script>
@endsection
