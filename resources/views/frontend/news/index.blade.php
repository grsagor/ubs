@extends('frontend.news.partial.app')
@section('title', 'News-list')
@section('css')
    @include('frontend.news.partial.css')
@endsection
@section('property_list_content')
    <div class="product-search-one search-bar mb-3">

        <form id="searchForm" class="search-form form-inline search-pill-shape bg-white"
            action="{{ route('news', array_merge(request()->except('page'), ['search' => strtolower(request()->input('search'))])) }}"
            method="GET">
            <input type="text" id="shop_name" class="col form-control search-field" name="search" placeholder="Search News"
                value="{{ request()->input('search') }}">
            <input type="hidden" name="category_id" value="{{ request()->input('category_id') }}">
            <input type="hidden" name="sub_category_id" value="{{ request()->input('sub_category_id') }}">
            <input type="hidden" name="child_category_id" value="{{ request()->input('child_category_id') }}">
            <button type="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i></button>
        </form>

    </div>

    <div class="newsfeed-container" id="newsfeed-container">
        @foreach ($news as $item)
            <div class="newsfeed-card">
                <a href="{{ route('shop.service', $item->business_location_id) }}" class="card-header">
                    <img src="{{ $item->businessLocation->logo ? asset($item->businessLocation->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                        alt="Profile Picture" class="profile-pic">
                    <div class="user-info">
                        <h4 class="username">{{ $item->businessLocation->name }}</h4>
                        <p class="timestamp">{{ $item->created_at->diffForHumans() }}</p>
                    </div>
                </a>

                <a href="{{ route('news.show', $item->slug) }}" class="card-link">
                    <div class="card-body">
                        @php
                            $thumbnail =
                                $item->thumbnail && file_exists(public_path($item->thumbnail))
                                    ? asset($item->thumbnail)
                                    : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                        @endphp
                        <img src="{{ $thumbnail }}" alt="Post Image" class="post-image">
                        <p class="post-content" style="font-size: 18px; font-weight:bold; margin-top:10px;">
                            {{ $item->title }}</p>
                        <p class="post-content">{{ $item->define_this_item }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    @include('frontend.news.partial.js')
@endsection
