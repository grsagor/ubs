@extends('frontend.layouts.master_layout')

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">
        <div class="full-row bg-light overlay-dark py-5"
            style="background-image: url(https://www.unipuller.com/assets/images/1678212738up-mailphp.php); background-position: center center; background-size: cover;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        <h3 class="mb-2 text-white"></h3>
                    </div>
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-inline-flex bg-transparent p-0">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Service</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->
        <div class="shop-list-page">

            {{-- There are two product page. you have to give condition here --}}
            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        <div class="row single-product-wrapper">
                            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                                <div class="product-images overflow-hidden">
                                    <div class="images-inner">
                                        <div class="">
                                            <figure class="woocommerce-product-gallery__wrapper">
                                                <div class="bg-light">
                                                    <img id="single-image-zoom"
                                                        src="data:image/jpeg;base64,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">
                                                </div>

                                                <div id="gallery_09" class="product-slide-thumb">
                                                    <div
                                                        class="owl-carousel four-carousel dot-disable nav-arrow-middle owl-mx-5 owl-loaded owl-drag">
                                                        <div class="owl-stage-outer">
                                                            <div class="owl-stage"></div>
                                                        </div>
                                                        <div class="owl-nav disabled"><button type="button"
                                                                role="presentation" class="owl-prev">
                                                                <div class="nav-btn prev-slide"><i
                                                                        class="fas fa-chevron-left"></i><span>Prev</span>
                                                                </div>
                                                            </button><button type="button" role="presentation"
                                                                class="owl-next">
                                                                <div class="nav-btn next-slide"><span>Next</span><i
                                                                        class="fas fa-chevron-right"></i></div>
                                                            </button></div>
                                                        <div class="owl-dots disabled"></div>
                                                    </div>
                                                </div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-lg-8 col-md-8">
                                <div class="summary entry-summary">
                                    <div class="summary-inner">

                                        <h1 class="product_title entry-title">{{ $info->advert_title }}</h1>
                                        <p class="product-title">{{ $info->advert_description }}</p>

                                        <div class="pro-details">
                                            <div class="pro-info">
                                                <p class="price">
                                                    <span class="woocommerce-Price-amount amount mr-4">
                                                        <bdi><span class="woocommerce-Price-currencySymbol"
                                                                id="sizeprice">£130.15</span></bdi>
                                                    </span>
                                                </p>
                                            </div>


                                            <li class="addtocart m-1">
                                                <a id="qserviceaddcrt" href="javascript:;">
                                                    Book Now
                                                </a>
                                            </li>

                                        </div>
                                        <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                            <div class="wishlist-button">
                                                <a class="add_to_wishlist"
                                                    href="https://unipuller.com/user/login">Wishlist</a>
                                            </div>
                                            <div class="compare-button">
                                                <a class="compare button" href="javascrit:;">Compare</a>
                                            </div>

                                        </div>

                                        <div class="report-area">
                                            <a class="report-item" href="#"><i class="fas fa-flag"></i> Report This
                                                Item </a>
                                        </div>

                                        <div class="my-4 social-linkss social-sharing a2a_kit a2a_kit_size_32"
                                            style="line-height: 32px;">
                                            <h5 class="mb-2">Share Now</h5>
                                            <ul class="social-icons py-1 share-product social-linkss py-md-0">
                                                <li>
                                                    <a class="facebook a2a_button_facebook" href="/#facebook"
                                                        target="_blank" rel="nofollow noopener">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="twitter a2a_button_twitter" href="/#twitter" target="_blank"
                                                        rel="nofollow noopener">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="linkedin a2a_button_linkedin" href="/#linkedin"
                                                        target="_blank" rel="nofollow noopener">
                                                        <i class="fab fa-linkedin-in"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="pinterest a2a_button_pinterest" href="/#pinterest"
                                                        target="_blank" rel="nofollow noopener">
                                                        <i class="fab fa-pinterest-p"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="instagram a2a_button_whatsapp" href="/#whatsapp"
                                                        target="_blank" rel="nofollow noopener">
                                                        <i class="fab fa-whatsapp"></i>
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>

                                        <p><strong>Availability: </strong> Unavailable</p>
                                        <p><strong>Emergency: </strong> No</p>
                                        <script async="" src="https://static.addtoany.com/menu/page.js"></script>
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
