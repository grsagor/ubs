<div class="col-12 col-xl-3 col-lg-3">
    <div id="sidebar" class="widget-title-bordered-full">

        <div id="woocommerce_product_categories-4"
            class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Categories</h2>
            <ul class="product-categories">
                @foreach ($nestedDataSets as $category)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('service.list', ['category_id' => $category['id']]) }}"
                            @if (!empty($category['children']) && request()->category_id == $category['id']) class="toggle-category expanded"
                            @elseif (!empty($category['children']))
                                class="toggle-category" @endif>
                            <span
                                class="toggle-icon {{ Route::currentRouteName() === 'service.list' && request()->category_id == $category['id'] ? 'text-danger' : '' }}">
                                &nbsp;{{ $category['name'] }}
                                @if (!empty($category['children']))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 16 16" class="toggle-svg"
                                        style="{{ !empty($category['children']) && request()->category_id == $category['id'] ? 'transform: rotate(90deg);' : '' }}">
                                        <path fill="none" stroke="rgba(0,0,0,.5)" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 14l6-6-6-6" />
                                    </svg>
                                @endif
                            </span>
                        </a>

                        <!-- Subcategories -->
                        @if (!empty($category['children']))
                            <ul class="children" @if (request()->category_id == $category['id']) style="display: block;" @endif>
                                @foreach ($category['children'] as $childCategory)
                                    <li class="cat-item cat-parent">
                                        <a href="{{ route('service.list', ['category_id' => $category['id'], 'sub_category_id' => $childCategory['id']]) }}"
                                            @if (!empty($childCategory['children']) && request()->sub_category_id == $childCategory['id']) class="toggle-category expanded"
                                            @elseif (!empty($childCategory['children']))
                                                class="toggle-category" @endif>
                                            <span
                                                class="toggle-icon {{ Route::currentRouteName() === 'service.list' && request()->sub_category_id == $childCategory['id'] ? 'text-danger' : '' }} toggle-icon">
                                                &nbsp;{{ $childCategory['name'] }}
                                                @if (!empty($childCategory['children']))
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                        height="12" viewBox="0 0 16 16" class="toggle-svg"
                                                        style="{{ !empty($childCategory['children']) && request()->sub_category_id == $childCategory['id'] ? 'transform: rotate(90deg);' : '' }}">
                                                        <path fill="none" stroke="rgba(0,0,0,.5)"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 14l6-6-6-6" />
                                                    </svg>
                                                @endif
                                            </span>
                                        </a>

                                        <!-- Sub child categories -->
                                        @if (!empty($childCategory['children']))
                                            <ul class="sub-children"
                                                @if (request()->sub_category_id == $childCategory['id']) style="display: block;" @else style="display: none;" @endif>
                                                @foreach ($childCategory['children'] as $subChildCategory)
                                                    <li class="cat-item cat-parent">
                                                        <a
                                                            href="{{ route('service.list', ['category_id' => $category['id'], 'sub_category_id' => $childCategory['id'], 'child_category_id' => $subChildCategory['id']]) }}">
                                                            <span
                                                                class="{{ Route::currentRouteName() === 'service.list' && request()->child_category_id == $subChildCategory['id'] ? 'text-danger' : '' }}">
                                                                &nbsp; &nbsp;
                                                                &nbsp;{{ $subChildCategory['name'] }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
