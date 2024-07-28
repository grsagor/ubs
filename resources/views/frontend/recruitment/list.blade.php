@extends('frontend.layouts.master_layout')
@section('title', 'Jobs')
@section('css')
    <style>
        .color-black {
            color: black !important;
        }

        .para-font {
            font-size: 14px !important;
        }

        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card-body {
            padding: 20px;
        }

        .card-design {
            background-color: #dedede;
            color: #212529;
        }

        .card-title {
            color: #007bff;
            font-size: 18px;
        }

        .card-subtitle {
            color: #6c757d;
        }

        .card-text {
            color: #495057;
        }

        .mobile-view {
            display: none;
        }

        .laptop-view {
            display: block;
        }

        .type_select {
            width: 180px !important;
        }

        .product-search-one {
            padding: 9px;
        }

        @media (max-width: 767px) {
            .mobile-view {
                display: block;
            }

            .laptop-view {
                display: none;
            }

            .card-title {
                color: #007bff;
                font-size: 18px;
            }

            .select-appearance-none {
                display: block !important;
            }

            .type_select {
                width: 130px !important;
            }
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 all_list mb-0">

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-12 order-lg-2">
                    <div class="product-search-one">
                        <form id="searchForm" class="search-form form-inline search-pill-shape"
                            action="{{ route('recruitment.list') }}" method="GET">
                            <div class="select-appearance-none categori-container mx-2" id="typeSelectFormSticky">
                                <select name="selectCategory" id="selectTypeSticky" class="form-control type_select">
                                    <option value="">Select Category</option>
                                    @foreach ($jobsCategory as $jobCat)
                                        <option value="{{ $jobCat->id }}"
                                            {{ $jobCat->id == request('selectCategory') ? 'selected' : '' }}>
                                            {{ $jobCat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" id="prod_name2" class="col form-control search-field" name="search"
                                placeholder="Search For" value="{{ request('search') }}">
                            <button type="submit" class="search-submit"><i
                                    class="flaticon-search flat-mini text-white"></i></button>
                        </form>

                    </div>
                </div>

                {{-- Job List --}}
                @if (count($jobs) > 0)
                    @foreach ($jobs as $item)
                        <div class="col-md-12 mt-2 p-2">
                            <a href="{{ route('recruitment.details', ['id' => $item->short_id]) }}" target="_blank"
                                class="card-link">

                                {{-- Laptop view --}}
                                <div class="card custom-card card-design laptop-view">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <h4 class="card-title mb-0">{{ $item->title }}</h4>
                                                <p class="card-text mb-1 company-name color-black para-font">
                                                    {{ $item->company_name }}
                                                </p>
                                                <span>{{ $item->job_category->name ?? '' }}</span>

                                                <p class="card-text mb-0 color-black para-font">Employee Status:
                                                    {{ implode(', ', $item->hour_type) }}
                                                </p>
                                                <p class="card-text mb-0 color-black para-font">Job Type:
                                                    {{ implode(', ', $item->job_type) }}
                                                </p>


                                                <p class="card-text color-black para-font">
                                                    @if ($item->salary)
                                                        Salary:
                                                        {{ $item->salary }}/{{ $item->salary_type }}
                                                    @else
                                                        Salary: {{ $item->salary_type }}
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="col-md-3 text-center m-auto">
                                                @if ($item->businessLocation && $item->businessLocation->logo)
                                                    <img src="{{ asset($item->businessLocation->logo) }}" alt=""
                                                        style="height: 90px">
                                                @else
                                                    <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                        alt="" style="height: 90px">
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row mt-1">
                                            <div class="col-md-9">
                                                <p class="card-text color-black para-font">Location:
                                                    {{ $item->location }}</p>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <p class="card-text deadline color-black para-font">
                                                    Deadline:
                                                    {{ date('d.m.Y', strtotime($item->closing_date)) }}
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                {{-- Mobile view --}}
                                <div class="card custom-card card-design mobile-view">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 text-center m-auto">
                                                @if ($item->businessLocation && $item->businessLocation->logo)
                                                    <img src="{{ asset($item->businessLocation->logo) }}" alt=""
                                                        style="height: 110px">
                                                @else
                                                    <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                        alt="" style="width: 45% !important;">
                                                @endif
                                            </div>

                                            <div class="col-md-12 mt-2">
                                                <h4 class="card-title mb-0 para-font">{{ $item->title }}
                                                </h4>
                                                <p class="card-text company-name color-black para-font">
                                                    {{ $item->company_name }}
                                                </p>

                                                <p class="card-text mb-0 color-black para-font">Employee Status:
                                                    {{ implode(', ', $item->hour_type) }}
                                                </p>
                                                <p class="card-text mb-0 color-black para-font">Job Type:
                                                    {{ implode(', ', $item->job_type) }}
                                                </p>

                                                <p class="card-text color-black para-font">
                                                    @if ($item->salary)
                                                        Salary:
                                                        {{ $item->salary }}/{{ $item->salary_type }}
                                                    @else
                                                        Salary: {{ $item->salary_type }}
                                                    @endif
                                                </p>
                                                <p class="card-text mb-0 color-black para-font">Location:
                                                    {{ $item->location }}
                                                </p>
                                                <p class="card-text deadline color-black para-font">
                                                    Deadline:
                                                    {{ date('d.m.Y', strtotime($item->closing_date)) }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach

                    {{-- Pagination --}}
                    @include('frontend.pagination.pagination', ['paginator' => $jobs])
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="page-center">
                                <h4 class="text-center">{{ 'No Jobs Found.' }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
