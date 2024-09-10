@extends('frontend.news.partial.app')
@section('title', 'News-list')
@section('css')
    @include('frontend.news.partial.css')
@endsection
@section('property_list_content')
    <div class="product-search-one search-bar mb-3" id="searchFormMain">
        <input type="text" id="search_Main" class="col form-control search-field" name="search" placeholder="Search News"
            value="{{ request()->input('search') }}" style="border: 1px solid #000 ; border-radius: 2rem ">
    </div>

    <div class="newsfeed-container" id="newsfeed-container">
        @include('frontend.news.partial.newsfeed')
    </div>
@endsection

@section('script')
    @include('frontend.news.partial.js')
@endsection
