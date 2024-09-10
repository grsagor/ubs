@extends('frontend.news.partial.app')
@section('title', 'News-list')
@section('css')
    @include('frontend.news.partial.css')
@endsection
@section('property_list_content')
    <div class="product-search-one search-bar mb-3">

        <form id="searchFormMain" class="search-form form-inline search-pill-shape bg-white"
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
        @include('frontend.news.partial.newsfeed')
    </div>
@endsection

@section('script')
    @include('frontend.news.partial.js')
@endsection
