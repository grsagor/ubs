@extends('frontend.service.partial.app')
@section('property_list_content')
    @foreach ($rooms as $item)
        <div class="col mb-5">
            <div class="product type-product rounded ">
                <div class=" row m-0">
                    <div class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center card-image">
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
                            <a href="{{ route('property_show', $item->id) }}" class="woocommerce-LoopProduct-link">
                                <img class="lazy img-fluid rounded" data-src="{{ asset($first_image) }}" alt="Product Image"
                                    style="height: 270px;">
                            </a>
                        @else
                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                class="swiper-lazy" alt="" style="height: 270px;">
                        @endif
                    </div>
                    <div class=" col-lg-8 col-md-8 col-sm-12 p-0 d-flex flex-column">
                        <div class="p-2 flex-grow-1">
                            <h5 class="product-title" style="padding: 2px 2px 2px 2px;">
                                <a class="text-dark" href="{{ route('property_show', $item->id) }}">
                                    <span style="font-weight: 600;">
                                        {{ Str::limit($item->ad_title, $limit = 92, $end = '...') }}
                                    </span>
                                </a>
                            </h5>
                            <hr class="mt-0" style="height: 2px; width: 100% !important;">
                            <p class="category_text text-dark"
                                style="margin-bottom: 0rem; text-align: justify; padding: 0px 10px 0px 10px">
                                {{ Str::limit($item->ad_text, $limit = 375, $end = '...') }}
                            </p>
                        </div>
                        <div class="d-flex text-center"
                            style="background-color: whitesmoke; border-top: 3px solid var(--green);">
                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0" style="color: black; font-size: 15px;">
                                    Available From
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ $item->available_form }}
                                </p>
                            </span>

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

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0  text-muted"
                                    style="color: black !important; font-size: 15px;">
                                    Room Size
                                </p>
                                <p class="mb-0 text-muted">
                                    @if ($item->room_details !== 'null' && $item->room_details !== null)
                                        {{ $output }}
                                    @endif
                                </p>
                            </span>

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0  text-muted"
                                    style="color: black !important; font-size: 15px;">
                                    Service
                                </p>
                                <p class="mb-0 text-muted">
                                    @if ($item->plan)
                                        {{ $item->plan }}
                                    @else
                                        Free
                                    @endif
                                </p>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
