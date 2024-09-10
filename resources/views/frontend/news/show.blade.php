@extends('frontend.layouts.master_layout')
@section('title', $news->title)
@section('css')
    @include('frontend.news.partial.css_show')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <div class="row">
            <div class="col-md-12 mt-2 p-2">

                <div class="card card-design">
                    <div class="card-body">

                        <div class="row header">

                            <div class="col-md-12">
                                <div class="job-title">{{ $news->title }}</div>
                            </div>
                            <div class="col-md-8">

                                @php
                                    $result = '';

                                    if ($news->category && $news->category->name) {
                                        $result = $news->category->name;
                                    }

                                    if ($news->subCategory && $news->subCategory->name) {
                                        if ($result) {
                                            $result .= ', ' . $news->subCategory->name;
                                        } else {
                                            $result = $news->subCategory->name;
                                        }
                                    }

                                @endphp
                                <div class="card-text company-name color-black">
                                    {{ $result }}
                                </div>

                            </div>
                        </div>

                        <div class="apply-section mt-3">
                            <div class="apply-button">
                                {{-- Social Media Icons --}}
                                <div>
                                    @include('frontend.social_media_share.social_media')
                                </div>
                            </div>
                        </div>


                        @if ($news->region || $news->language || $news->special)
                            <div class="summary-section row mt-3">
                                <div class="col-sm-12 ">
                                    <div class="summary-card">
                                        <h3 class="sectitle">Information</h3>
                                        <div class="row">

                                            @if ($news->region->name)
                                                <div class="col-md-4">
                                                    Region: <span class="fw-bold">{{ $news->region->name ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if ($news->language->name)
                                                <div class="col-md-4">
                                                    Language: <span class="fw-bold">{{ $news->language->name ?? '' }}</span>
                                                </div>
                                            @endif

                                            @if (!is_null($news->special) && $news->special->name)
                                                <div class="col-md-4">
                                                    Special: <span class="fw-bold">{{ $news->special->name }}</span>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($news->thumbnail || $news->images)
                            <div class="requirements-section row mt-3">
                                <div class="col-sm-12 ">
                                    <div class="requirements-card">
                                        <div class="col-md-12 text-justify">
                                            <div class="row">
                                                @if ($news->thumbnail)
                                                    <div class="col-md-6 text-center">
                                                        <img src="{{ asset($news->thumbnail) }}" alt=""
                                                            style="width: 590px !important; height: 300px;">
                                                    </div>
                                                @endif

                                                @if ($news->images)
                                                    <div class="col-md-6 text-center">
                                                        <div id="imageSlider" class="carousel slide col-md-6 mobile_m_15"
                                                            data-bs-ride="carousel" style="width: 590px; height: 300px;">
                                                            <div class="carousel-inner">
                                                                @foreach (json_decode($news->images ?? '[]') as $index => $item)
                                                                    <div
                                                                        class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                        <img src="{{ asset($item) }}" class="d-block w-100"
                                                                            alt=""style="width: 590px !important; height: 300px;">
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            @if (count(json_decode($news->images ?? '[]')) > 1)
                                                                <button class="carousel-control-prev" type="button"
                                                                    data-bs-target="#imageSlider" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button"
                                                                    data-bs-target="#imageSlider" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                        @if ($news->video_url)
                            @php
                                $videoUrl = $news->video_url;
                                $videoId = '';
                                parse_str(parse_url($videoUrl, PHP_URL_QUERY), $query);
                                if (isset($query['v'])) {
                                    $videoId = $query['v'];
                                }
                                $embedCode = "<div style=\"width: 100%;\"><iframe width=\"100%\" height=\"375\" src=\"https://www.youtube.com/embed/$videoId\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe></div>";
                            @endphp

                            <div class="mt-4">
                                {!! $embedCode !!}
                            </div>
                        @endif

                        <div class="requirements-section row mt-3">
                            <div class="col-sm-12 ">
                                <div class="requirements-card">
                                    @if ($news->description)
                                        <h3 class="sectitle">Details</h3>
                                        <div class="col-md-12 text-justify details_page">
                                            {!! $news->description ?? '' !!}
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>

                        <div class="requirements-section row mt-3 d-flex align-items-stretch">
                            <div class="col-sm-6 d-flex justify-content-end">
                                <a href="{{ route('shop.service', $news->businessLocation->id) }}"
                                    class="text-decoration-none w-100">
                                    <div class="requirements-card d-flex flex-column align-items-center text-center h-100">
                                        <div class="card-text company-name color-black">
                                            <h3 class="sectitle">News Advertiser</h3>
                                            {{ $news->businessLocation->name }}
                                        </div>
                                        <img class="mt-3" src="{{ asset($news->businessLocation->logo) }}"
                                            alt="Business location logo" style="max-width: 100px; max-height: 100px;"
                                            onerror="this.onerror=null;this.src='https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';">
                                    </div>
                                </a>
                            </div>

                            <div class="col-sm-6 d-flex">
                                <a href="{{ $news->source_url }}" class="text-decoration-none w-100">
                                    <div class="requirements-card d-flex flex-column align-items-center text-center h-100">
                                        <div class="card-text company-name color-black">
                                            <h3 class="sectitle">News source</h3>
                                            {{ $news->source_name }}
                                        </div>
                                        <img class="mt-3" {{-- src='https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' --}}
                                            src='https://i0.wp.com/1.bp.blogspot.com/-OEDEZCgyo10/Wcz9mUDr3KI/AAAAAAAAhYE/LaqmMRgmItstf_hcRZHwPhXxI5tQi-VbQCLcBGAs/s1600/Go.jpg?ssl=1'
                                            alt="Business location logo" style="max-width: 100px; max-height: 100px;">
                                    </div>
                                </a>
                            </div>
                        </div>




                        <div class="report-section row mt-3">
                            <div class="col-sm-12">
                                <div class="report-card">
                                    <h3 class="reptitle">
                                        Report this news
                                        <button class="report-button"><i class="fas fa-flag"></i> Report</button>
                                    </h3>
                                    <div class="col-md-12 text-justify">
                                        <p>Your satisfaction is our priority. If you notice any news discrepancies or
                                            policy violations, please inform
                                            us immediately. We'll take swift action to address them. While Unipuler isn't
                                            directly responsible for any
                                            issue regarding this news, we're committed to upholding our standards. Note
                                            that Unipuler acts solely
                                            as a facilitator and is not liable for the quality or delivery of news
                                            provided by our partners. However,
                                            we hold our partners accountable to ensure your satisfaction.
                                        </p>
                                    </div>

                                    <div class="complain-information">
                                        <div class="complain-info-item">
                                            <span class="info-icon"><i class="fas fa-info-circle"></i></span>
                                            <span class="contact-phone">{!! $othersInfo['contact-us-phone'] ?? '' !!}</span>
                                        </div>
                                        <div class="complain-info-item">
                                            <span class="info-icon"><i class="fas fa-envelope"></i></span>
                                            <span class="contact-phone">{!! $othersInfo['contact-us-email-complain'] ?? '' !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
