{{-- <div class="col-lg-3 col-md-3 col-sm-12" style="background-color: white;">
    <div id="sidebar" class="widget-title-bordered-full">

        <div style="margin-top: 50px;" class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Category </h2>
            <ul class="product-categories">
                @foreach ($categories as $category)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', ['category' => $category['slug']]) }}"
                            @if (!empty($category['children']) && request()->category_id == $category['slug']) class="toggle-category expanded"
                        @elseif (!empty($category['children']))
                            class="toggle-category" @endif>
                            <span
                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->category_id == $category['slug'] ? 'text-danger' : '' }}">
                                &nbsp;{{ $category['name'] }}
                                @if (!empty($category['children']))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 16 16" class="toggle-svg"
                                        style="{{ !empty($category['children']) && request()->category_id == $category['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                        <path fill="none" stroke="rgba(0,0,0,.5)" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 14l6-6-6-6" />
                                    </svg>
                                @endif
                            </span>
                        </a>

    
                        @if (!empty($category['children']))
                            <ul class="children" @if (request()->category_id == $category['slug']) style="display: block;" @endif>
                                @foreach ($category['children'] as $childCategory)
                                    <li class="cat-item cat-parent">
                                        <a href="{{ route('news', ['category' => $category['slug'], 'sub_category' => $childCategory['slug']]) }}"
                                            @if (!empty($childCategory['children']) && request()->sub_category_id == $childCategory['slug']) class="toggle-category expanded"
                                        @elseif (!empty($childCategory['children']))
                                            class="toggle-category" @endif>
                                            <span
                                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->sub_category_id == $childCategory['slug'] ? 'text-danger' : '' }} toggle-icon">
                                                &nbsp;{{ $childCategory['name'] }}
                                                @if (!empty($childCategory['children']))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                        height="12" viewBox="0 0 16 16" class="toggle-svg"
                                                        style="{{ !empty($childCategory['children']) && request()->sub_category_id == $childCategory['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                                        <path fill="none" stroke="rgba(0,0,0,.5)"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 14l6-6-6-6" />
                                                    </svg>
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Region </h2>
            <ul class="product-categories">
                @foreach ($regions as $region)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', ['region' => $region['slug']]) }}">
                            {{ $region->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Language </h2>
            <ul class="product-categories">
                @foreach ($languages as $lang)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', ['lang' => $lang['slug']]) }}">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Special </h2>
            <ul class="product-categories">
                @foreach ($specials as $special)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', ['special' => $special['slug']]) }}">
                            {{ $special->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div> --}}


{{-- <div class="col-lg-3 col-md-3 col-sm-12" style="background-color: white;">
    <div id="sidebar" class="widget-title-bordered-full">

        <div style="margin-top: 50px;" class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Category </h2>
            <ul class="product-categories">
                @foreach ($categories as $category)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['category' => $category['slug']])) }}"
                            @if (!empty($category['children']) && request()->category == $category['slug']) class="toggle-category expanded"
                        @elseif (!empty($category['children']))
                            class="toggle-category" @endif>
                            <span
                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->category == $category['slug'] ? 'text-danger' : '' }}">
                                &nbsp;{{ $category['name'] }}
                                @if (!empty($category['children']))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 16 16" class="toggle-svg"
                                        style="{{ !empty($category['children']) && request()->category == $category['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                        <path fill="none" stroke="rgba(0,0,0,.5)" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 14l6-6-6-6" />
                                    </svg>
                                @endif
                            </span>
                        </a>

                        <!-- Subcategories -->
                        @if (!empty($category['children']))
                            <ul class="children" @if (request()->category == $category['slug']) style="display: block;" @endif>
                                @foreach ($category['children'] as $childCategory)
                                    <li class="cat-item cat-parent">
                                        <a href="{{ route('news', array_merge(request()->query(), ['sub_category' => $childCategory['slug']])) }}"
                                            @if (!empty($childCategory['children']) && request()->sub_category == $childCategory['slug']) class="toggle-category expanded"
                                        @elseif (!empty($childCategory['children']))
                                            class="toggle-category" @endif>
                                            <span
                                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->sub_category == $childCategory['slug'] ? 'text-danger' : '' }} toggle-icon">
                                                &nbsp;{{ $childCategory['name'] }}
                                                @if (!empty($childCategory['children']))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                        height="12" viewBox="0 0 16 16" class="toggle-svg"
                                                        style="{{ !empty($childCategory['children']) && request()->sub_category == $childCategory['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                                        <path fill="none" stroke="rgba(0,0,0,.5)"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 14l6-6-6-6" />
                                                    </svg>
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Region </h2>
            <ul class="product-categories">
                @foreach ($regions as $region)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['region' => $region['slug']])) }}">
                            {{ $region->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Language </h2>
            <ul class="product-categories">
                @foreach ($languages as $lang)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['lang' => $lang['slug']])) }}">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Special </h2>
            <ul class="product-categories">
                @foreach ($specials as $special)
                    <li class="cat-item cat-parent">
                        <a
                            href="{{ route('news', array_merge(request()->query(), ['special' => $special['slug']])) }}">
                            {{ $special->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div> --}}



<div class="col-lg-3 col-md-3 col-sm-12">
    <div id="sidebar" class="widget-title-bordered-full">

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Category </h2>
            <ul class="product-categories">
                @foreach ($categories as $category)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['category' => $category['slug']])) }}"
                            @if (!empty($category['children']) && request()->category == $category['slug']) class="toggle-category expanded"
                        @elseif (!empty($category['children']))
                            class="toggle-category" @endif>
                            <span
                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->category == $category['slug'] ? 'text-danger' : '' }}">
                                &nbsp;{{ $category['name'] }}
                                @if (!empty($category['children']))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 16 16" class="toggle-svg"
                                        style="{{ !empty($category['children']) && request()->category == $category['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                        <path fill="none" stroke="rgba(0,0,0,.5)" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 14l6-6-6-6" />
                                    </svg>
                                @endif
                            </span>
                        </a>

                        <!-- Subcategories -->
                        @if (!empty($category['children']))
                            <ul class="children" @if (request()->category == $category['slug']) style="display: block;" @endif>
                                @foreach ($category['children'] as $childCategory)
                                    <li class="cat-item cat-parent">
                                        <a href="{{ route('news', array_merge(request()->query(), ['sub_category' => $childCategory['slug']])) }}"
                                            @if (!empty($childCategory['children']) && request()->sub_category == $childCategory['slug']) class="toggle-category expanded"
                                        @elseif (!empty($childCategory['children']))
                                            class="toggle-category" @endif>
                                            <span
                                                class="toggle-icon {{ Route::currentRouteName() === 'news' && request()->sub_category == $childCategory['slug'] ? 'text-danger' : '' }} toggle-icon">
                                                &nbsp;{{ $childCategory['name'] }}
                                                @if (!empty($childCategory['children']))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                        height="12" viewBox="0 0 16 16" class="toggle-svg"
                                                        style="{{ !empty($childCategory['children']) && request()->sub_category == $childCategory['slug'] ? 'transform: rotate(90deg);' : '' }}">
                                                        <path fill="none" stroke="rgba(0,0,0,.5)"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 14l6-6-6-6" />
                                                    </svg>
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Region</h2>
            <ul class="product-categories">
                @foreach ($regions as $region)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['region' => $region['slug']])) }}">
                            {{ $region->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Language</h2>
            <ul class="product-categories">
                @foreach ($languages as $lang)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('news', array_merge(request()->query(), ['lang' => $lang['slug']])) }}">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Special </h2>
            <ul class="product-categories">
                @foreach ($specials as $special)
                    <li class="cat-item cat-parent">
                        <a
                            href="{{ route('news', array_merge(request()->query(), ['special' => $special['slug']])) }}">
                            {{ $special->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
