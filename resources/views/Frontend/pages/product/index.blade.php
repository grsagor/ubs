@extends('frontend.layouts.master_layout')

@section('content')
    <div class="products-page">
        @include('Frontend.partials.global.common-header')


        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url(https://www.unipuller.com/assets/front/images/product.jpg); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white">Product</h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="https://www.unipuller.com">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>


        <!-- breadcrumb -->
        {{-- There are two product page. you have to give condition here --}}
        <div class="full-row">
            <div class="container">
                <div class="row">

                    

                    @include('Frontend.partials.catalog.catalog')



                    @if (count($prods) > 0)
                        <div class="col-xl-9 col-lg-9">

                            <div class="products-header">

                                <div class=" d-flex justify-content-center py-3">
                                    <div class="product-search-one">
                                        <form id="searchForm" class="search-form form-inline search-pill-shape" action=""
                                            method="GET">
        
                                            <input type="text" id="prod_name" class="col form-control search-field"
                                                name="search" placeholder="Search For" value="">
        
        
                                            <button type="button" onclick="searchByProductName()"><i
                                                    class="flaticon-search flat-mini text-white"></i></button>
        
                                        </form>
                                    </div>
                                    <div class="autocomplete2">
                                        <div id="myInputautocomplete-list2" class="autocomplete-items"></div>
                                    </div>
                                </div>
                                <div
                                    class="products-header d-flex   align-items-center justify-content-between py-10 px-20 bg-light md-mt-30">
                                    <div class="d-flex align-items-center ">
                                        <div class="products-header-left px-2">
        
        
                                            <select name="country_id[]"
                                                class="form-control select2 country select2-hidden-accessible" id="country_id"
                                                onchange="countryChange(this)" tabindex="-1" aria-hidden="true"
                                                data-select2-id="select2-data-country_id">
                                                <option value="" disabled="" selected="">Select Country</option>
                                                <option data-href="https://www.unipuller.com/load/cities/18" value="18"
                                                    data-select2-id="select2-data-105-pguf">
                                                    Bangladesh</option>
                                                <option data-href="https://www.unipuller.com/load/cities/231" value="231">
                                                    United Kingdom</option>
                                            </select><span class="select2 select2-container select2-container--default"
                                                dir="ltr" data-select2-id="select2-data-104-7q55" style="width: 200px;"><span
                                                    class="selection"><span class="select2-selection select2-selection--single"
                                                        role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                        aria-disabled="false" aria-labelledby="select2-country_id-container"
                                                        aria-controls="select2-country_id-container"><span
                                                            class="select2-selection__rendered" id="select2-country_id-container"
                                                            role="textbox" aria-readonly="true"
                                                            title="
                                                        Bangladesh">
                                                            Bangladesh</span><span class="select2-selection__arrow"
                                                            role="presentation"><b
                                                                role="presentation"></b></span></span></span><span
                                                    class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                        <div class="city-div px-2" style="display: block;">
                                            <select name="city_id[]" id="citylist" class="select2 select2-hidden-accessible"
                                                multiple="" tabindex="-1" aria-hidden="true"
                                                data-select2-id="select2-data-citylist">
                                                <option data-href="" value="all">All City</option>
                                                <option value="14">Dhaka</option>
                                                <option value="15">Comilla</option>
                                            </select><span class="select2 select2-container select2-container--default"
                                                dir="ltr" data-select2-id="select2-data-109-pf6f"
                                                style="width: 109.188px;"><span class="selection"><span
                                                        class="select2-selection select2-selection--multiple" role="combobox"
                                                        aria-haspopup="true" aria-expanded="false" tabindex="-1"
                                                        aria-disabled="false">
                                                        <ul class="select2-selection__rendered" id="select2-citylist-container">
                                                        </ul><span class="select2-search select2-search--inline">
                                                            <textarea class="select2-search__field" type="search" tabindex="0" autocorrect="off" autocapitalize="none"
                                                                spellcheck="false" role="searchbox" aria-autocomplete="list" autocomplete="off" aria-label="Search"
                                                                aria-describedby="select2-citylist-container" placeholder="" style="width: 0.75em;"></textarea>
                                                        </span>
                                                    </span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
        
        
                                        </div>
                                    </div>
                                    <div>
                                        <form class="woocommerce-ordering" method="get">
                                            <select class="custom-select bg-dark text-white custom-select-sm" name="sortby"
                                                id="sortby">
                                                <option selected="">Sort By </option>
                                                <option value="date_desc">Latest Product</option>
                                                <option value="date_asc">Oldest Product</option>
                                                <option value="price_asc">Lowest Price</option>
                                                <option value="price_desc">Highest Price</option>
                                            </select>
                                            <input type="hidden" id="pageby" name="paged" value="12">
                                            <input type="hidden" name="shop-page-layout" value="left-sidebar">
                                        </form>
                                    </div>
                                </div>
                                <div class="products-header-right">
                                    <div class="products-view px-4">
        
        
                                    </div>
        
        
                                    <div class="products-view">
        
                                        <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light" id="ajaxContent"><div class="col-lg-12">
                                            <div class="row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
                                           <div class="col">
                                           <div class="product type-product">
                                              <div class="product-wrapper">
                                                 <div class="product-image">
                                                    <a href="https://www.unipuller.com/item/rw" class="woocommerce-LoopProduct-link"><img class="lazy" alt="Product Image" src="https://www.unipuller.com/assets/images/products/1685082739GzsRUYUg.png" style=""></a>
                                                    
                                                    <div class="hover-area">
                                                                                           <div class="cart-button">
                                                          <a href="javascript:;" data-href="https://www.unipuller.com/addcart/4" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                       </div>
                                     
                                                       <div class="cart-button buynow">
                                                          <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="https://www.unipuller.com/addtocart/4" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"></a>
                                                       </div>
                                                                                                             <div class="wishlist-button">
                                                          <a class="add_to_wishlist button add_to_cart_button" href="https://www.unipuller.com/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                       </div>
                                                                         <div class="compare-button">
                                                          <a class="compare button button add_to_cart_button" data-href="https://www.unipuller.com/item/compare/add/4" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                       </div>
                                                    </div>
                                                 </div>
                                                 <div class="product-info">
                                                    <h3 class="product-title"><a href="https://www.unipuller.com/item/rw">dhaka 1 product</a></h3>
                                                    <div class="product-price">
                                                       <div class="price">
                                     
                                                          <ins>£11,111.00</ins>
                                                          <del>£1.00</del>
                                                       </div>
                                                    </div>
                                                    <div class="shipping-feed-back">
                                                       <div class="star-rating">
                                                          <div class="rating-wrap">
                                                             <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                           <div class="col">
                                           <div class="product type-product">
                                              <div class="product-wrapper">
                                                 <div class="product-image">
                                                    <a href="https://www.unipuller.com/item/fruit-product-60l52002ur-1" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="https://www.unipuller.com/assets/images/products/16872131839xGAvwee.png" alt="Product Image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="></a>
                                                    
                                                    <div class="hover-area">
                                                                                           <div class="cart-button">
                                                          <a href="javascript:;" data-href="https://www.unipuller.com/addcart/16" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                       </div>
                                     
                                                       <div class="cart-button buynow">
                                                          <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="https://www.unipuller.com/addtocart/16" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"></a>
                                                       </div>
                                                                                                             <div class="wishlist-button">
                                                          <a class="add_to_wishlist button add_to_cart_button" href="https://www.unipuller.com/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                       </div>
                                                                         <div class="compare-button">
                                                          <a class="compare button button add_to_cart_button" data-href="https://www.unipuller.com/item/compare/add/16" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                       </div>
                                                    </div>
                                                 </div>
                                                 <div class="product-info">
                                                    <h3 class="product-title"><a href="https://www.unipuller.com/item/fruit-product-60l52002ur-1">Fruit product</a></h3>
                                                    <div class="product-price">
                                                       <div class="price">
                                     
                                                          <ins>£470.35</ins>
                                                          <del>£8.35</del>
                                                       </div>
                                                    </div>
                                                    <div class="shipping-feed-back">
                                                       <div class="star-rating">
                                                          <div class="rating-wrap">
                                                             <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                           <div class="col">
                                           <div class="product type-product">
                                              <div class="product-wrapper">
                                                 <div class="product-image">
                                                    <a href="https://www.unipuller.com/item/grapes-product-60l52002ur-1-1" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="https://www.unipuller.com/assets/images/products/1687213040tNfbI5WP.png" alt="Product Image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="></a>
                                                    
                                                    <div class="hover-area">
                                                                                           <div class="cart-button">
                                                          <a href="javascript:;" data-href="https://www.unipuller.com/addcart/17" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add To Cart" aria-label="Add To Cart"></a>
                                                       </div>
                                     
                                                       <div class="cart-button buynow">
                                                          <a class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="https://www.unipuller.com/addtocart/17" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Buy Now" aria-label="Buy Now"></a>
                                                       </div>
                                                                                                             <div class="wishlist-button">
                                                          <a class="add_to_wishlist button add_to_cart_button" href="https://www.unipuller.com/user/login" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">Wishlist</a>
                                                       </div>
                                                                         <div class="compare-button">
                                                          <a class="compare button button add_to_cart_button" data-href="https://www.unipuller.com/item/compare/add/17" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">Compare</a>
                                                       </div>
                                                    </div>
                                                 </div>
                                                 <div class="product-info">
                                                    <h3 class="product-title"><a href="https://www.unipuller.com/item/grapes-product-60l52002ur-1-1">Grapes product</a></h3>
                                                    <div class="product-price">
                                                       <div class="price">
                                     
                                                          <ins>£470.35</ins>
                                                          <del>£8.35</del>
                                                       </div>
                                                    </div>
                                                    <div class="shipping-feed-back">
                                                       <div class="star-rating">
                                                          <div class="rating-wrap">
                                                             <p><i class="fas fa-star"></i><span> 0 (0)</span></p>
                                                          </div>
                                                       </div>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        </div>
                                     
                                     
                                         </div>
                                     
                                     
                                     <script>
                                      lazy()
                                     
                                       $('[data-toggle="tooltip"]').tooltip({});
                                     
                                       $('[rel-toggle="tooltip"]').tooltip();
                                     
                                       $('[data-toggle="tooltip"]').on('click', function () {
                                         $(this).tooltip('hide');
                                       })
                                     
                                     
                                       $('[rel-toggle="tooltip"]').on('click', function () {
                                         $(this).tooltip('hide');
                                       })
                                     
                                       // Tooltip Section Ends
                                     </script>
                                     </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-4 d-xl-none d-lg-none">
                                <button class="dashboard-sidebar-btn btn bg-primary rounded">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                            @includeIf('frontend.category')
                            <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light"
                                id="ajaxContent">
                                @includeIf('partials.product.product-different-view')
                            </div>
                            {{-- @include('frontend.pagination.product') --}}
                        </div>
                    @else
                        <div class="col-lg-9">
                            <div class="mb-4 d-xl-none d-lg-none">
                                <button class="dashboard-sidebar-btn btn bg-primary rounded">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                            @includeIf('frontend.category')
                            <div class="card">
                                <div class="card-body">
                                    <div class="page-center">
                                        <h4 class="text-center">{{ __('No Product Found.') }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <!-- Modal -->
        <div id="overlay"></div>
        <div class="modal" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Select Country </h5>
                        {{-- <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <select name="country_id[]" class="form-control select2 country" id="country_id_modal"
                                onchange="countryChangeModal(this)" required>
                                <option value="" disabled selected>Select Country</option>
                                @foreach ($countries as $country)
                                    <option data-href="" value="{{ $country->id }}">
                                        {{ $country->country_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="city-div-modal" style="display:none">
                            <select name="city_id[]" id="citylist_modal" class="select2" multiple>
                                <option value="all">All City</option>

                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p class="text-left" id="search-modal-text"> </p>
                        {{-- <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button> --}}
                        <button type="button" class="btn btn-primary close" id="search_filter_modal_btn"
                            data-bs-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- @includeIf('partials.product.grid') --}}
        {{-- @includeIf('partials.global.common-footer') --}}
    </div>
@endsection
