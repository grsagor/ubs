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

                                        <h1 class="product_title entry-title">{{ $info->advert_title }}</h1>
                                        <p class="product-title">{{ $info->advert_description }}</p>

                                        <div class="pro-details">

                                            @php
                                                $room_data = (object) json_decode($info->room, true);
                                            @endphp
                                            <div class="pro-info">

                                                <form method="POST"
                                                    action="{{ route('room.referenceNumberCheck', $info->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <ul class="room-list">
                                                        <li class="room-list__room">
                                                            @if ($room_data->room_cost_of_amount1)
                                                                <input type="radio" name="bill" id="room1"
                                                                    value="{{ $room_data->room_cost_of_amount1 }}">
                                                                <strong class="room-list__price">&pound;
                                                                    {{ $room_data->room_cost_of_amount1 }} pcm</strong>
                                                                <small>(Room 1)</small>
                                                            @endif
                                                        </li>
                                                        <li class="room-list__room">
                                                            @if ($room_data->room_cost_of_amount2)
                                                                <input type="radio" name="bill" id="room2"
                                                                    value="{{ $room_data->room_cost_of_amount2 }}">
                                                                <strong class="room-list__price">&pound;
                                                                    {{ $room_data->room_cost_of_amount2 }} pcm</strong>
                                                                <small>(Room 2)</small>
                                                            @endif
                                                        </li>
                                                        <li class="room-list__room">
                                                            @if ($room_data->room_cost_of_amount3)
                                                                <input type="radio" name="bill" id="room3"
                                                                    value="{{ $room_data->room_cost_of_amount3 }}">
                                                                <strong class="room-list__price">&pound;
                                                                    {{ $room_data->room_cost_of_amount3 }} pcm</strong>
                                                                <small>(Room 3)</small>
                                                            @endif
                                                        </li>
                                                    </ul>



                                                    <button type="button" class="mt-2" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal"> Book Now </button>



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

                                            </div>




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

                                        @if ($info->room_available_from)
                                            <p>
                                                <strong>Availability: </strong>
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->room_available_from)->format('M d') }}
                                            </p>
                                        @endif

                                        @if ($info->room_min_stay)
                                            <p>
                                                <strong>Minimum Stay: </strong>
                                                {{ $info->room_min_stay ?? '' }} months
                                            </p>
                                        @endif

                                        @if ($info->room_max_stay)
                                            <p>
                                                <strong>Maximum Stay: </strong>
                                                {{ $info->room_max_stay ?? '' }} months
                                            </p>
                                        @endif

                                        <p>
                                            <strong>Bills included: </strong>
                                            {{ $info->room_bills == 1 ? 'Yes' : 'No' }}
                                        </p>

                                        @php
                                            $aminities = json_decode($info->property_amenities, true);
                                            
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

                                        <h5>Current household</h5>
                                        <p>
                                            <strong>Total rooms: </strong>
                                            {{ $info->property_room_quantity ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Age: </strong>
                                            {{ $info->exiting_flatmate_age ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Smoker: </strong>
                                            {{ $info->exiting_flatmate_smoking == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Any pets: </strong>
                                            {{ $info->exiting_flatmate_pets == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Language: </strong>
                                            {{ $info->exiting_flatmate_language ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Occupation: </strong>
                                            {{ $info->exiting_flatmate_occupation ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Nationality: </strong>
                                            {{ $info->exiting_flatmate_nationality ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Gender: </strong>
                                            {{ $info->exiting_flatmate_gender == 1 ? 'Male' : ($info->exiting_flatmate_gender == 2 ? 'Female' : 'Others') }}
                                        </p>


                                        <h5>New flatmate preferences</h5>
                                        <p>
                                            <strong>Couples OK: </strong>
                                            {{ $info->new_flatmate_couples == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Smoking OK: </strong>
                                            {{ $info->new_flatmate_smoking == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Pets OK: </strong>
                                            {{ $info->new_flatmate_pets == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Occupation: </strong>
                                            {{ $info->new_flatmate_occupation ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Min age: </strong>
                                            {{ $info->new_flatmate_min_age ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Min age: </strong>
                                            {{ $info->new_flatmate_max_age ?? '' }}
                                        </p>
                                        <p>
                                            <strong>Gender: </strong>
                                            {{ $info->exiting_flatmate_gender == 1 ? 'Male' : ($info->exiting_flatmate_gender == 2 ? 'Female' : 'Others') }}
                                        </p>
                                        <p>
                                            <strong>Vegetarians: </strong>
                                            {{ $info->new_flatmate_vegetarians == 1 ? 'Yes' : 'No' }}
                                        </p>
                                        <p>
                                            <strong>Language: </strong>
                                            {{ $info->new_flatmate_language ?? '' }}
                                        </p>

                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 col-md-4">
                                <div class="pro-details-sidebar-item mb-4">
                                    <span> Contact </span>

                                    @php
                                        $imagePath = public_path('uploads/media/' . $user_info->file_name);
                                        $imageUrl = File::exists($imagePath) ? asset('uploads/media/' . $user_info->file_name) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                    @endphp

                                    <div>
                                        @if ($user_info->file_name)
                                            <img class="" src="{{ $imageUrl }}" alt="" width="100"
                                                height="100">
                                        @else
                                            <img class="" src="{{ $first_image }}" alt="" width="100"
                                                height="100">
                                        @endif
                                    </div>

                                    <strong>
                                        {{ $info->user->surname ?? '' }}
                                        {{ $info->user->first_name ?? '' }}
                                        {{ $info->user->last_name ?? '' }}
                                    </strong>

                                    <h6> {{ $info->property_user_title ?? '' }} </h6>

                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
