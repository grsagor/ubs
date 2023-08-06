<!DOCTYPE html>
<html class="desktop uk logged_out no-js" lang="en-GB">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/advertise.css') }}">
</head>

<body>

    <main id="spareroom" class="wrap wrap--main">
        <div class="grid-12" id="mainheader">
            <div id="listing_heading">
                <h1> {{ $info->ad_title }} </h1>
            </div>
        </div>
        <div class="listing listing--property layoutrow">
            <div class="bold_listing">
                <div class="">

                    <div class="block block_simple detail_page_tab_content" style="padding: 15px;">
                        <div class=" detail_page_tab_content_inner">
                            <div id="listing_header">

                                <ul id="listing_tools">
                                    <li class="save"> <a href="#" rel="nofollow">Save</a> </li>
                                </ul>
                                <p id="listing_ref">
                                    <span class="new_today_listing">
                                        {{ $info->created_at->diffForHumans() }}
                                    </span>
                                </p>
                            </div>

                            <!-- main col section -->
                            <div class="listing__content grid-8-4-4">
                                <div class="property-intro">

                                    <div class="photos landscape">

                                        @php
                                            $images = json_decode($info->images, true);
                                            $first_image = 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                            
                                            if ($images) {
                                                $first_image = reset($images);
                                                $imagePath = public_path($first_image);
                                            }
                                            
                                        @endphp

                                        <dl class="landscape">
                                            <dt class="mainImage">

                                                <a href="#" title="" data-number="1"
                                                    class="photoswipe_me main img">
                                                    <img src="{{ asset($first_image) }}" alt="">
                                                </a>

                                            </dt>
                                            <dd class="caption">Private terrace</dd>
                                        </dl>

                                        <ul id="additional_photo_list" class="additional_photo_list--has-photos">

                                            @if ($images)
                                                @foreach ($images as $img)
                                                    <li>
                                                        <a href="#" title="" data-number="2"
                                                            class="photoswipe_me img">
                                                            <img src="{{ asset($img) }}" alt="">
                                                        </a>
                                                    </li>
                                                @endforeach
                                            @endif

                                        </ul>
                                    </div>

                                    <p class="detaildesc"> {{ $info->ad_text }} </p>

                                </div>
                                <div class="property-details">
                                    <section class="feature feature--details">
                                        <ul class="key-features">
                                            <li class="key-features__feature"> {{ $info->room_size }} </li>
                                        </ul>
                                    </section>

                                    <section class="feature feature--availability">

                                        <h3 class="feature__heading">Availability</h3>

                                        <dl class="feature-list">

                                            @if ($info->available_form)
                                                <dt class="feature-list__key">Available</dt>
                                                <dd class="feature-list__value">
                                                    {{ Carbon\Carbon::createFromFormat('Y-m-d', $info->available_form)->format('M d') }}
                                                </dd>
                                            @endif

                                            <dt class="feature-list__key">Minimum term</dt>
                                            <dd class="feature-list__value"> {{ $info->min_term ?? '' }} months
                                            </dd>

                                            <dt class="feature-list__key">Maximum term</dt>
                                            <dd class="feature-list__value">{{ $info->max_term ?? '' }} months
                                            </dd>
                                        </dl>

                                    </section>


                                    @php
                                        $aminities = json_decode($info->roomfurnishings, true);
                                        
                                        array_walk($aminities, function (&$amenity) {
                                            $amenity = ucfirst($amenity);
                                        });
                                    @endphp


                                    <section class="feature feature--amenities">
                                        <h3 class="feature__heading">Amenities</h3>
                                        <dl class="feature-list">

                                            @foreach ($aminities as $item)
                                                <dd class="feature-list__value">{{ $item }}</dd>
                                            @endforeach

                                        </dl>
                                    </section>

                                    {{-- <section class="feature feature--current-household">
                                        <h3 class="feature__heading">Current household</h3>
                                        <dl class="feature-list">

                                            <dt class="feature-list__key">Total &#35; rooms</dt>
                                            <dd class="feature-list__value"> {{ $data->property_room_quantity ?? '' }}
                                            </dd>

                                            <dt class="feature-list__key">Age</dt>
                                            <dd class="feature-list__value"> {{ $data->exiting_flatmate_age ?? '' }}
                                            </dd>

                                            <dt class="feature-list__key">Smoker?</dt>
                                            <dd class="feature-list__value">
                                                <span class="cross">
                                                    {{ $data->exiting_flatmate_smoking == 1 ? 'Yes' : 'No' }}
                                                </span>
                                            </dd>

                                            <dt class="feature-list__key">Any pets?</dt>
                                            <dd class="feature-list__value">
                                                <span class="cross">
                                                    {{ $data->exiting_flatmate_pets == 1 ? 'Yes' : 'No' }}
                                                </span>
                                            </dd>

                                            <dt class="feature-list__key">Language</dt>
                                            <dd class="feature-list__value">
                                                {{ $data->exiting_flatmate_language }}
                                            </dd>

                                            <dt class="feature-list__key">Occupation</dt>
                                            <dd class="feature-list__value"> {{ $data->exiting_flatmate_occupation }}
                                            </dd>

                                            <dt class="feature-list__key">Nationality</dt>
                                            <dd class="feature-list__value">{{ $data->exiting_flatmate_nationality }}
                                            </dd>


                                            <dt class="feature-list__key">Gender</dt>
                                            <dd class="feature-list__value">
                                                {{ $data->exiting_flatmate_gender == 1 ? 'Male' : ($data->exiting_flatmate_gender == 2 ? 'Female' : 'Others') }}
                                            </dd>

                                        </dl>
                                    </section> --}}



                                </div>


                                <aside>
                                    <div class="block block_bubble block_contact contact_the_advertiser">
                                        <div class="block_header">
                                            <h3>
                                                Contact <span>the advertiser</span>
                                            </h3>
                                        </div>
                                        <div class="block_content block_areas">

                                            <div class="block_area block_area_first">
                                                <div itemscope itemtype="http://schema.org/Person"
                                                    class="advertiser-info">

                                                    @php
                                                        $imagePath = public_path('uploads/media/' . $user_info->file_name);
                                                        $imageUrl = File::exists($imagePath) ? asset('uploads/media/' . $user_info->file_name) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                                                        
                                                    @endphp

                                                    <div class="profile-photo__wrap profile-photo__show-viewer advert-details__profile-photo-wrap"
                                                        id="">

                                                        @if ($user_info->file_name)
                                                            <img class="profile-photo advert-details__profile-photo"
                                                                src="{{ $imageUrl }}" alt="" width="100"
                                                                height="100">
                                                        @else
                                                            <img class="profile-photo advert-details__profile-photo"
                                                                src="{{ $first_image }}" alt="" width="100"
                                                                height="100">
                                                        @endif

                                                        <strong class="profile-photo__name" itemprop="name">
                                                            {{ $data->user->surname ?? '' }}
                                                            {{ $data->user->first_name ?? '' }}
                                                            {{ $data->user->last_name ?? '' }}
                                                        </strong>
                                                    </div>

                                                    <em> {{ $data->property_user_title ?? '' }} </em>

                                                    {{-- <span class="last-online">Last active:</span>
                                                    <span class="last-online light-grey">8 hours ago</span> --}}
                                                </div>
                                                {{-- <ul class="contact_methods">
                                                    <li class="emailadvertiser">
                                                        <a class="button button--wide" href=""
                                                            title="Email advertiser" rel="nofollow">
                                                            <span>
                                                                <i class="far fa-envelope"></i>
                                                                &nbsp;&nbsp;Message
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul> --}}
                                            </div>
                                            <!-- end block_area -->


                                            <div class="block_area hurry">
                                                <p class="hurry__text">
                                                    In a hurry?<a class="bluebuttontextlink" title="Show"
                                                        href="#" rel="nofollow"> Show interest </a>and we will
                                                    send the advertiser your profile
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <section class='tip-box tip-box--desktop'>
                                        <header class="tip-box__header">
                                            <h3 class="tip-box__heading"><i
                                                    class='far fa-shield-alt tip-box__icon'></i>Stay safe</h3>
                                        </header>
                                        <div class="tip-box__div">
                                            <div class='tip-box__tips'>
                                                <strong>TIP: </strong>Always view before you pay any money
                                                <div class="tip-box__links">
                                                    <button
                                                        class="button button--link report-ad-link report-ad-modal-link"><span
                                                            class="report-ad-link__icon"><i
                                                                class="far fa-exclamation-triangle"
                                                                aria-hidden="true"></i></span>Report this ad</button>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="block block_simple">
            <div class="block_content">
                <h3>Report this ad</h3>
                <div class="cols cols2" style="margin-bottom: 0px;">
                    <div class="col col_first">
                        <p>
                            We have staff moderating our ads 7 days per week, to keep quality high.
                            Please help us in our job and
                            <button class="button button--link report-ad-modal-link">let us know</button>
                            if there is any problem with this ad, for example:
                        </p>
                    </div>
                    <div class="col col_last">
                        <ul class="bulletlist">
                            <li>The photos are not of the room advertised</li>
                            <li>The description is misleading</li>
                            <li>The ad is generic rather than for a specific available room</li>
                            <li>The advertiser is not a live in landlord </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
