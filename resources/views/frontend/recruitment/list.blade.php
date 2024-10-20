@extends('frontend.recruitment.partial.app')
@section('title', 'Jobs-list')
@section('css')
    @include('frontend.recruitment.partial.css')
@endsection

@section('property_list_content')
    <div class="product-search-one mb-3">
        <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
            action="{{ route('recruitment.list', array_merge(request()->except('page'), ['search' => strtolower(request()->input('search'))])) }}"
            method="GET">
            <input type="text" id="shop_name" class="col form-control search-field" name="search" placeholder="Search job"
                value="{{ request()->input('search') }}">
            <input type="hidden" name="category_id" value="{{ request()->input('category_id') }}">
            <button type="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i></button>
        </form>
    </div>

    @foreach ($jobs as $item)
        <div class="col mb-4 custom-card">
            <a href="{{ route('recruitment.details', ['id' => $item->short_id, 'slug' => $item->slug]) }}"
                class="text-decoration-none text-dark">
                <div class="product type-product rounded">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                            style="padding-right: 0px; height: 193px;">
                            <img class="lazy img-fluid w-100 mobile-view-image"
                                src="{{ $item->business_location && $item->business_location->logo ? asset($item->business_location->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                                alt="Product Image">
                            @if ($item->job_category_id)
                                <div class="category-wrapper">
                                    <div class="category-badge">
                                        <h6>{{ Str::limit($item->job_category->name ?? null, 50, '...') }}</h6>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column mobile_view_card_descripition"
                            style="padding-right: 15px !important; padding-left: 4px;">
                            <div class="p-1 flex-grow-1">
                                <h5 class="product-title" style="padding: 0; margin: 0;">
                                    <span style="font-weight: 600;">{{ Str::limit($item->title, 45, '...') }}</span>
                                </h5>
                                <p class="card-text mb-0 company-name color-black para-font" style="margin-top: 7px;">
                                    Employer: {{ $item->company_name }}
                                </p>
                                <p class="card-text mb-0 color-black para-font">Employee Status:
                                    {{ implode(', ', $item->hour_type) }}</p>
                                <p class="card-text mb-0 color-black para-font">Job Type:
                                    {{ implode(', ', $item->job_type) }}</p>
                                <p class="card-text mb-0 color-black para-font">Vacancies: {{ $item->vacancies }}</p>
                                <p class="card-text mb-0 color-black para-font">Location: {{ $item->location }}</p>
                                <p class="card-text mb-0 color-black para-font">Closing Date:
                                    {{ Carbon::parse($item->closing_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    @endforeach


    {{-- Pagination --}}
    @include('frontend.pagination.pagination', ['paginator' => $jobs])

@endsection

@section('script')
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
@endsection
