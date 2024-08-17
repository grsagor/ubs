<div class="col-12 col-xl-3 col-lg-3">
    <div id="sidebar" class="widget-title-bordered-full">
        <div id="woocommerce_product_categories-4"
            class="widget woocommerce widget_product_categories widget-toggle closed categories">
            <h2 class="widget-title">Categories</h2>
            <ul class="product-categories">
                @foreach ($jobsCategory as $category)
                    <li class="cat-item cat-parent">
                        <a href="{{ route('recruitment.list', ['category_id' => $category['id']]) }}">
                            <span
                                class="toggle-icon {{ Route::currentRouteName() === 'recruitment.list' && request()->category_id == $category['id'] ? 'text-danger' : '' }}">
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
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
