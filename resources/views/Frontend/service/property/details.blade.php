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
                                <li class="breadcrumb-item active" aria-current="page">Room Wanted</li>
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

                        <div class="row single-product-wrapper mt-3">
                            <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                                <div class="product-images overflow-hidden">
                                    <div class="images-inner">
                                        <div class="">

                                            @php
                                                $images = json_decode($info->advert_photos, true);
                                                $first_image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                                $img_count = null;
                                                $imagePath = null;
                                                
                                                if ($images) {
                                                    $first_image = reset($images);
                                                    $imagePath = public_path($first_image);
                                                    $img_count = count($images);
                                                }
                                                
                                            @endphp

                                            <figure class="woocommerce-product-gallery__wrapper">
                                                @if ($first_image && File::exists($imagePath))
                                                    <div class="bg-light">
                                                        <img id="single-image-zoom" src="{{ asset($first_image) }}">
                                                    </div>
                                                @else
                                                    <div class="bg-light">
                                                        <img id="single-image-zoom" src="{{ asset($first_image) }}">
                                                    </div>
                                                @endif
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

                            <div class="col-12 col-lg-5 col-md-8">
                                <div class="summary entry-summary">
                                    <div class="summary-inner">

                                        <h1 class="product_title entry-title">{{ $info->ad_title }}</h1>
                                        <p class="product-title">{{ $info->ad_text }}</p>

                                        <div class="pro-details">

                                            <div class="pro-info">
                                                <strong class="room-list__price">
                                                    {{ $info->room_size }}</strong>
                                            </div>

                                            <li class="addtocart m-1">
                                                <form method="POST"
                                                    action="{{ route('property.referenceNumberCheck', $info->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <button type="button" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"> Book Now
                                                        ${{ $info->combined_budget }}
                                                    </button>

                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Reference
                                                                        Number</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Please call <a href="callto:{{ $info->user->contact_no }}">{{ $info->user->contact_no }}</a> to get the reference id.</p>
                                                                    <div class="mb-3">
                                                                        <input type="text" class="form-control"
                                                                            id="inputName" name="reference_number"
                                                                            placeholder="Enter reference number"
                                                                            style="width: 100%;">

                                                                        <input type="hidden" name="bill"
                                                                            value={{ $info->combined_budget }}>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Buy</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Modal --}}

                                                </form>
                                            </li>

                                        </div>


                                        <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
                                            <div class="wishlist-button">
                                                <a class="add_to_wishlist" href="">Wishlist</a>
                                            </div>
                                            <div class="compare-button">
                                                <a class="compare button" href="">Compare</a>
                                            </div>

                                        </div>

                                        <div class="report-area">
                                            <a class="report-item" href="#"><i class="fas fa-flag"></i> Report
                                                This
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
                                                    <a class="twitter a2a_button_twitter" href="/#twitter"
                                                        target="_blank" rel="nofollow noopener">
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

                                        @if ($info->available_form)
                                            <p>
                                                <strong>Availability: </strong>
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->available_form)->format('M d') }}
                                            </p>
                                        @endif

                                        @if ($info->min_term)
                                            <p>
                                                <strong>Minimum term: </strong>
                                                {{ $info->min_term ?? '' }} months
                                            </p>
                                        @endif

                                        @if ($info->max_term)
                                            <p>
                                                <strong>Maximum term: </strong>
                                                {{ $info->max_term ?? '' }} months
                                            </p>
                                        @endif



                                        @php
                                            $aminities = json_decode($info->roomfurnishings, true);
                                            
                                            array_walk($aminities, function (&$amenity) {
                                                $amenity = ucfirst($amenity);
                                            });
                                        @endphp

                                        <p>
                                            <strong>Aminities: </strong>
                                            @foreach ($aminities as $item)
                                                <span>{{ $item }}, </span>
                                            @endforeach
                                        </p>

                                        <p>
                                            <strong>Age: </strong>
                                            {{ $info->age ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Occupation: </strong>
                                            {{ $info->occupation ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Smoker: </strong>
                                            {{ $info->smoking_current == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Pets: </strong>
                                            {{ $info->pets == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Nationality: </strong>
                                            {{ $info->nationality ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Gender: </strong>
                                            {{ $info->gender_req == 1 ? 'Male' : ($info->gender_req == 2 ? 'Female' : 'Others') }}
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-4">
                                <div class="pro-details-sidebar-item mb-4">
                                    <span> Contact </span>

                                    {{-- @php
                                        $imagePath = public_path('uploads/media/' . $user_info->file_name);
                                        $imageUrl = File::exists($imagePath) ? asset('uploads/media/' . $user_info->file_name) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                    @endphp --}}

                                    {{-- <div>
                                        @if ($user_info->file_name)
                                            <img class="" src="{{ $imageUrl }}" alt="" width="100"
                                                height="100">
                                        @else
                                            <img class="" src="{{ $first_image }}" alt="" width="100"
                                                height="100">
                                        @endif
                                    </div> --}}

                                    <strong>
                                        {{ $info->user->surname ?? '' }}
                                        {{ $info->user->first_name ?? '' }}
                                        {{ $info->user->last_name ?? '' }}
                                    </strong>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
