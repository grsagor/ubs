<div class="col-lg-3 col-md-3 col-sm-12 left-side">
    <div id="sidebar" class="widget-title-bordered-full">

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <input type="date" name="date" id="dateSearch" style="width: 100%; box-sizing: border-box;">
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Category</h2>
            <ul class="product-categories">
                @foreach ($categories as $category)
                    <li class="cat-item cat-parent">
                        <a href="#"
                            @if (!empty($category['children']) && request()->category == $category['id']) class="toggle-category expanded"
                        @elseif (!empty($category['children']))
                            class="toggle-category" @endif
                            data-category-id="{{ $category['id'] }}"
                            data-children="{{ !empty($category['children']) ? json_encode($category['children']) : '' }}">
                            <span class="toggle-icon">
                                &nbsp;{{ $category['name'] }}
                                @if (!empty($category['children']))
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        viewBox="0 0 16 16" class="toggle-svg"
                                        style="{{ !empty($category['children']) && request()->category == $category['id'] ? 'transform: rotate(90deg);' : '' }}">
                                        <path fill="none" stroke="rgba(0,0,0,.5)" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-width="2" d="M5 14l6-6-6-6" />
                                    </svg>
                                @endif
                            </span>
                        </a>


                        <!-- Subcategories -->
                        @if (!empty($category['children']))
                            <ul class="children">
                                @foreach ($category['children'] as $subCategory)
                                    <li class="cat-item cat-parent">
                                        <a href="#" class="subCategory-link"
                                            data-subcategory-id="{{ $subCategory['id'] }}">
                                            {{ $subCategory['name'] }}
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
                        <a href="#" class="region-link" data-region-id="{{ $region->id }}">
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
                        <a href="#" class="language-link" data-language-id="{{ $lang->id }}">
                            {{ $lang->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="widget woocommerce widget_product_categories widget-toggle categories">
            <h2 class="widget-title">Special</h2>
            <ul class="product-categories">
                @foreach ($specials as $special)
                    <li class="cat-item cat-parent">
                        <a href="#" class="special-link" data-special-id="{{ $special->id }}">
                            {{ $special->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
