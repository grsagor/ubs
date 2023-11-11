@extends('frontend.layouts.master_layout')

@section('css')
    @include('frontend.service.partial.property_style')
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="shop-list-page">

        {{-- <div class="full-row bg-light overlay-dark py-5">
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
        </div> --}}


        <div class="full-row py-5" style="background: #4d6873;">
            <div class="container">
                <div class="row text-center text-white">
                    <div class="col-12">
                        @if ($info->plan && $info->payment_check)
                            <h3 class="mb-2 text-white" style="text-transform: capitalize;">
                                Find a property for this tenant and get 30% &#163;{{ $info->payment_check->amount * 0.3 }}
                            </h3>
                        @endif

                        @if ($info->upgraded !== 1)
                            <h3 class="mb-2 text-white" style="text-transform: capitalize;">
                                Help this tenant to get this property</h3>
                        @endif

                    </div>
                </div>
            </div>
        </div>

        <!-- breadcrumb -->
        <div class="shop-list-page">

            <div class="mt-2 content-circle">

                <div class="container">
                    <div class="row mobile-reverse">

                        <div class="row single-product-wrapper mt-3">
                            <div class="col-lg-5 mb-4 mb-lg-0">

                                @if ($info->images != null)
                                    <div class="slideShow">
                                        <!-- Images in the slideshow -->
                                        <div class="image-carousel">
                                            <div class="carousel-container">
                                                @foreach ($images as $key => $item)
                                                    <img class="mySlides" src="{{ asset($item) }}">
                                                @endforeach
                                                @if ($img_count > 1)
                                                    <a class="previous" onclick="plusSlides(-1)">❮</a>
                                                    <a class="next" onclick="plusSlides(1)" style="float: right;">❯</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if ($img_count > 1)
                                        <div class="row p-2">
                                            @foreach ($images as $key => $item)
                                                <div class="col-lg-{{ $div_value }} text-center p-2">
                                                    <img class="demo w3-opacity w3-hover-opacity-off"
                                                        src="{{ asset($item) }}" onclick="currentDiv({{ $key + 1 }})">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <figure class="woocommerce-product-gallery__wrapper">
                                        <div class="bg-light">
                                            <img id="single-image-zoom" src="{{ asset($first_image) }}">
                                        </div>
                                    </figure>
                                @endif

                            </div>

                            <div class="col-lg-7 col-md-8">
                                <div class="summary entry-summary">
                                    <div class="summary-inner">

                                        <h1 class="product_title entry-title">{{ $info->ad_title }}</h1>

                                        <div class="row">
                                            <div class="col-lg-5">
                                                <div class="pro-details">

                                                    @if ($info->room_details !== 'null' && $info->room_details !== null)
                                                        @php
                                                            $roomDetails = json_decode($info->room_details, true);
                                                            $countRoom = count($roomDetails);
                                                        @endphp

                                                        <div class="pro-info">
                                                            <strong class="room-list__price">
                                                                @foreach ($roomDetails as $item)
                                                                    @if ($item == 1)
                                                                        Single
                                                                    @elseif($item == 2)
                                                                        Double
                                                                    @elseif($item == 6)
                                                                        Semi-Double
                                                                    @elseif($item == 7)
                                                                        En-suit
                                                                    @endif
                                                                @endforeach
                                                                {{-- $info->child_category_id == 11 means child_categories table value Room check child_categories table --}}
                                                                @if ($info->child_category_id == 11)
                                                                    {{ $countRoom }}
                                                                @endif
                                                                {{ $info->child_category->name . ' Wanted' ?? '' }}
                                                            </strong>
                                                        </div>
                                                    @endif

                                                    {{-- <li class="addtocart m-1">
                                                        <form method="POST"
                                                            action="{{ route('property.referenceNumberCheck', $info->id) }}"
                                                            style="margin: 0px;">
                                                            @csrf
                                                            @method('PUT')
        
                                                            <button type="button" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                Send Message
                                                            </button>
        
                                                         
                                                            <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLabel">Reference
                                                                                Number</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Please call <a
                                                                                    href="callto:{{ $info->user->contact_no }}">{{ $info->user->contact_no }}</a>
                                                                                to get the reference id.</p>
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
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Buy</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
        
                                                        </form>
                                                    </li> --}}

                                                    <div class="call-button" style="display: flex; align-items: center;">
                                                        <a href="tel:{{ $info->tel }}" class="button-31"
                                                            id="call_button_id"
                                                            style="width: 130px; margin-left: 9px;">Call</a>
                                                        <span id="call_id"
                                                            style="display: none; margin-left: 10px;">{{ $info->tel }}</span>
                                                    </div>

                                                </div>

                                                @include('frontend.social_media_share.social_media')

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
                                            </div>

                                            <div class="col-lg-7 mt-3">
                                                <div class="pro-details-sidebar-item mb-4">
                                                    <span> Contact </span>

                                                    @php
                                                        $imageUrl = $user_info && $user_info->file_name && File::exists(public_path("uploads/media/{$user_info->file_name}")) ? asset("uploads/media/{$user_info->file_name}") : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                                    @endphp

                                                    <div>
                                                        <img class="" src="{{ $imageUrl }}" alt=""
                                                            width="100" height="100">
                                                    </div>

                                                    <strong>
                                                        {{ $info->user->surname ?? '' }}
                                                        {{ $info->user->first_name ?? '' }}
                                                        {{ $info->user->last_name ?? '' }}
                                                        @if ($info->plan)
                                                            ( {{ $info->plan }} )
                                                        @else
                                                            ( Free )
                                                        @endif
                                                    </strong>

                                                    <p style="background: #45606b; color: #fff">
                                                        {{ $info->why_is_searching }}</p>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                    <div class="row">
                        <div class="col-lg-12 table-container">

                            <table id="customers">
                                <tr>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Relationship</th>
                                    <th>Profession</th>
                                    <th>Job Type</th>
                                    <th>Nationality</th>
                                </tr>

                                @if ($occupantDetails != null)
                                    @foreach ($occupantDetails as $item)
                                        <tr>
                                            <td>{{ $item['occupant_name'] }}</td>
                                            <td>{{ $item['occupant_age'] }}</td>
                                            <td>
                                                @if ($item['occupant_gender_req'] == 1)
                                                    Male
                                                @elseif ($item['occupant_gender_req'] == 2)
                                                    Female
                                                @elseif ($item['occupant_gender_req'] == 3)
                                                    Others
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item['occupant_relationship'] == 1)
                                                    Family
                                                @elseif ($item['occupant_relationship'] == 2)
                                                    Relatives
                                                @elseif ($item['occupant_relationship'] == 3)
                                                    Friends
                                                @elseif ($item['occupant_relationship'] == 4)
                                                    Others
                                                @elseif ($item['occupant_relationship'] == 5)
                                                    Contact Person
                                                @endif
                                            </td>

                                            <td>
                                                @if ($item['occupant_occupation'] == 1)
                                                    Student
                                                    <span style="font-size: 12px;">
                                                        {{ $item['occupant_degree_name'] }}</span>
                                                @elseif ($item['occupant_occupation'] == 2)
                                                    Employee
                                                @elseif ($item['occupant_occupation'] == 3)
                                                    Others
                                                @endif

                                                @if (isset($item['occupant_designation']))
                                                    ({{ $item['occupant_designation'] }})
                                                @endif

                                            </td>

                                            <td>
                                                @if ($item['occupant_job_type'] == 1)
                                                    Part-time
                                                @elseif ($item['occupant_job_type'] == 2)
                                                    Full-time
                                                @elseif ($item['occupant_job_type'] == 3)
                                                    Self-employed
                                                @endif
                                            </td>

                                            <td>{{ $item['occupant_nationality'] }}</td>
                                        </tr>
                                    @endforeach
                                @endif


                            </table>

                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-7 p-4" style="text-align: justify">
                            <p class="product-title">{{ $info->ad_text }}</p>
                        </div>

                        <div class="col-lg-5 mt-3">

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Availability</h5>

                            @if ($info->available_form)
                                <p>
                                    <strong>Total Budget: </strong>
                                    £{{ $info->combined_budget }} {{ $info->per }}
                                </p>
                            @endif

                            <p>
                                <strong>Combined Income Before Tax: </strong>
                                £{{ $total_monthly_income_before_tax }} Per month
                            </p>

                            @if ($info->available_form)
                                <p>
                                    <strong>Available From: </strong>
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->available_form)->format('M d') }}
                                </p>
                            @endif

                            @if ($info->min_term)
                                <p>
                                    <strong>Minimum term: </strong>
                                    {{ $info->min_term ?? '' }}
                                </p>
                            @endif

                            @if ($info->max_term)
                                <p>
                                    <strong>Maximum term: </strong>
                                    {{ $info->max_term ?? '' }} months
                                </p>
                            @endif

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Preferred Area</h5>

                            @if ($info->wanted_living_area)
                                <p>
                                    <strong>Wanted Living Area: </strong>
                                    {{ $info->wanted_living_area }}
                                </p>
                            @endif

                            <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                            <h5>Preferred Amenities</h5>

                            @if ($info->roomfurnishings)
                                @php
                                    $amenities = json_decode($info->roomfurnishings, true);
                                @endphp

                                @if (is_array($amenities) && count($amenities) > 0)
                                    <p>
                                        <strong>Amenities: </strong>
                                        {{ implode(', ', array_map('ucfirst', $amenities)) }}
                                    </p>
                                @endif
                            @endif

                            {{-- $info->child_category_id == 11 means child_categories table value Room check child_categories table --}}
                            @if ($info->child_category_id == 11)

                                <hr class="mt-3 mb-3" style="width: 100%; height: 3px; margin: 0px;">

                                <h5>Household Preference</h5>

                                @if ($info->age !== null)
                                    @php
                                        $ageRange = json_decode($info->age, true);
                                    @endphp
                                    @if (is_array($ageRange) && count($ageRange) > 0)
                                        <p>
                                            <strong>Age Range: </strong>
                                            @foreach ($ageRange as $key => $item)
                                                {{ $item }}
                                                @if ($key === 0 && count($ageRange) > 1)
                                                    to
                                                @endif
                                            @endforeach
                                            Years
                                        </p>
                                    @endif
                                @endif

                                @if ($info->occupation)
                                    <p>
                                        <strong>Occupation: </strong>
                                        {{ $info->occupation ?? '' }}
                                    </p>
                                @endif

                                @if ($info->smoking_current)
                                    <p>
                                        <strong>Smoking: </strong>
                                        {{ $info->smoking_current == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->pets)
                                    <p>
                                        <strong>Pets: </strong>
                                        {{ $info->pets == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->pets)
                                    <p>
                                        <strong>Pets: </strong>
                                        {{ $info->pets == 1 ? 'Yes' : 'No' }}
                                    </p>
                                @endif

                                @if ($info->gay_lesbian)
                                    <p>
                                        <strong>Preferred Sex: </strong>
                                        {{ $info->gay_lesbian }}
                                    </p>
                                @endif

                                @if ($info->lang_id)
                                    <p>
                                        <strong>Preferred Language: </strong>
                                        {{ $info->lang_id }}
                                    </p>
                                @endif

                                @if ($info->nationality)
                                    <p>
                                        <strong>Preferred Nationality: </strong>
                                        {{ $info->nationality }}
                                    </p>
                                @endif

                            @endif

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('frontend.service.partial.property_script')
@endsection
