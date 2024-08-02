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
            <input type="text" id="shop_name" class="col form-control search-field" name="search"
                placeholder="Search service" value="{{ request()->input('search') }}">
            <input type="hidden" name="category_id" value="{{ request()->input('category_id') }}">
            <button type="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i></button>
        </form>

    </div>

    @foreach ($jobs as $item)
        <div class="col mb-4">
            <div class="product type-product rounded">
                <div class="row">

                    @if ($item->business_location && $item->business_location->logo)
                        <a href="{{ route('recruitment.details', ['id' => $item->short_id]) }}"
                            class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                            style="padding-right: 0px; height: 197px;">

                            <img class="lazy img-fluid w-100 mobile-view-image"
                                src="{{ asset($item->business_location->logo) }}" alt="Product Image">

                            @if ($item->job_category_id)
                                <div class="category-wrapper">
                                    <div class="category-badge">
                                        <h6>{{ Str::limit($item->job_category->name, $limit = 50, $end = '...') }}</h6>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('recruitment.details', ['id' => $item->short_id]) }}"
                            class="product-wrapperrrrr col-lg-4 col-md-4 col-sm-12 d-flex mobile-view-center"
                            style="padding-right: 0px; height: 197px;">

                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                class="lazy img-fluid rounded w-100 mobile-view-image" alt="" style="">

                            @if ($item->job_category_id)
                                <div class="category-wrapper">
                                    <div class="category-badge">
                                        <h6>{{ Str::limit($item->job_category->name, $limit = 50, $end = '...') }}</h6>
                                    </div>
                                </div>
                            @endif
                        </a>
                    @endif

                    <div class="col-lg-8 col-md-8 col-sm-12 d-flex flex-column  mobile_view_card_descripition"
                        style="padding-right: 15px !important; padding-left: 4px;">
                        <div class="p-1 flex-grow-1">
                            <h5 class="product-title" style="padding: 0; margin: 0;">
                                <a class="text-dark" href="{{ route('recruitment.details', ['id' => $item->short_id]) }}"
                                    style="font-weight: 600;">
                                    {{ Str::limit($item->title, $limit = 45, $end = '...') }}
                                </a>
                            </h5>
                            <hr style="color: #38b2ac; height: 1px; width: 100% !important; margin: 0rem 0">

                            <p class="card-text mb-1 company-name color-black para-font">
                                {{ $item->company_name }}
                            </p>
                            <p class="card-text mb-0 color-black para-font">Employee Status:
                                {{ implode(', ', $item->hour_type) }}
                            </p>
                            <p class="card-text mb-0 color-black para-font">Job Type:
                                {{ implode(', ', $item->job_type) }}
                            </p>
                            <p class="card-text mb-0 color-black para-font">Vacancies:
                                {{ $item->vacancies }}
                            </p>
                            <p class="card-text mb-0 color-black para-font">Location:
                                {{ $item->location }}
                            </p>

                        </div>

                        <div class="d-flex mr-10 text-center"
                            style="background-color: white; padding: 1px; margin-left: 12px; margin-right: 5px;">

                            <div class="col division" style="border: 1px  solid var(--green);">
                                {{ $item->closing_date }}
                            </div>
                            <div class="col division" style="border: 1px solid var(--green);">
                                <a href="#" style="color: inherit">
                                    <i class="fa-regular fa-heart mt-2"></i>
                                </a>
                            </div>
                            <a class="col division" style="border: 1px solid var(--green); color: inherit;"
                                href="{{ route('recruitment.details', ['id' => $item->short_id]) }}">Details
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Pagination --}}
    @include('frontend.pagination.pagination', ['paginator' => $jobs])

@endsection

@section('script')

@endsection
