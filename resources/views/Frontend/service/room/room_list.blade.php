@extends('frontend.service.partial.app')
@section('property_list_content')

    {{-- Right Side --}}
    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12" style="padding: 0px !important;">
        <div class="product-search-one">
            <form id="searchForm" class="search-form form-inline search-pill-shape bg-white" action="{{ route('room.list') }}"
                method="GET">

                <input type="text" id="shop_name" class="col form-control search-field" name="search"
                    placeholder="Search title or room type or room address" value="{{ request()->input('search') }}">

                <a type="submit" name="submit" class="search-submit"><i class="flaticon-search flat-mini text-white"></i>
                </a>
            </form>
        </div>


        <div class="showing-products pt-30 pb-50 border-2 border-bottom border-light" id="ajaxContent">


            <div class="row row-cols-xxl-2 px-3 row-cols-md-2 mb-4 row-cols-1 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom"
                style="padding: 0px !important;">
                @if (count($rooms) > 0)
                    <div class="col-md-9">
                        @foreach ($rooms as $item)
                            <div class="col">
                                <div class="product type-product rounded ">

                                    <div class=" row m-0">

                                        <div class="  col-lg-4 col-md-4 col-sm-12 d-flex align-items-center card-image">

                                            @php
                                                $images = json_decode($item->advert_photos, true);
                                                $first_image = null;
                                                $img_count = null;
                                                
                                                if ($images) {
                                                    $first_image = reset($images);
                                                    $imagePath = public_path($first_image);
                                                    $img_count = count($images);
                                                }
                                                
                                            @endphp

                                            @if ($first_image && File::exists($imagePath))
                                                <a href="{{ route('room_show', $item->id) }}"
                                                    class="woocommerce-LoopProduct-link">
                                                    <img class="lazy img-fluid rounded" data-src="{{ asset($first_image) }}"
                                                        alt="Product Image">
                                                </a>
                                            @else
                                                <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                    class="swiper-lazy" alt="">
                                            @endif

                                        </div>

                                        <div class=" col-lg-8 col-md-8 col-sm-12 p-0">

                                            <div class="p-2">
                                                <h5 class="product-title mb-1">
                                                    <a class="text-dark" href="{{ route('room_show', $item->id) }}">
                                                        <span class="company-name">
                                                            {{ Str::limit($item->advert_title, $limit = 20, $end = '...') }}
                                                        </span>
                                                    </a>
                                                </h5>

                                                <hr class="mt-0">
                                                <p class="category_text text-dark"
                                                    style="margin-bottom: 0rem; margin-top: -10px;">
                                                    {{ Str::limit($item->advert_description, $limit = 30, $end = '...') }}
                                                </p>

                                            </div>


                                            @php
                                                $room_data = json_decode($item->room, true);
                                                
                                                $maxValue = null;
                                                $minValue = null;
                                                
                                                for ($i = 1; $i <= 3; $i++) {
                                                    $field = 'room_cost_of_amount' . $i;
                                                    if (isset($room_data[$field])) {
                                                        $amount = intval($room_data[$field]);
                                                        if ($maxValue === null || $amount > $maxValue) {
                                                            $maxValue = $amount;
                                                        }
                                                        if ($minValue === null || $amount < $minValue) {
                                                            $minValue = $amount;
                                                        }
                                                    }
                                                }
                                                if ($minValue == $maxValue) {
                                                    $room_rent = $maxValue;
                                                } else {
                                                    $room_rent = $minValue . ' - ' . $maxValue;
                                            } @endphp

                                            <div class="d-flex text-center"
                                                style="background-color: whitesmoke; border-top: 3px solid var(--green);">

                                                <span class=" flex-fill mb-0 text-white">
                                                    <p class="lower-section-text mb-0  text-muted">
                                                        Rent
                                                    </p>
                                                    <p class="mb-0 text-muted">
                                                        &pound;{{ $room_rent }} <abbr>pcm</abbr>
                                                    </p>
                                                </span>
                                                <span class=" flex-fill mb-0 text-white">
                                                    <p class="lower-section-text mb-0  text-muted">Type
                                                    </p>
                                                    <p class="mb-0 text-muted">
                                                        {{ $item->property_type }}</p>
                                                    </p>
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>
                            <br>
                        @endforeach
                    </div>


                    {{-- Right side Advertise widget --}}
                    <div class="col-md-3">

                        <div class="card">
                            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                            <div class="card-body">
                                <h5 class="card-title">Advertise your propertise</h5>
                                <p class="card-text">List your property unlimited and completely free.</p>
                                <a href="{{ route('service-advertise.index') }}" class="button-31">Add</a>
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                            <div class="card-body">
                                <h5 class="card-title">Can't find your propertise?</h5>
                                <p class="card-text">Advertise your requirements completely free.</p>
                                <a href="{{ route('property-wanted.index') }}" class="button-31">Add</a>
                            </div>
                        </div>

                        <br>

                        <div class="card">
                            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                            <div class="card-body">
                                <h5 class="card-title">Hire someone to find out your property.</h5>
                                <ol>
                                    <li class="card-text">If you don't have time to find your property.</li>
                                    <li class="card-text">If you don't have idea how to deal property.</li>

                                </ol>
                                <p class="card-text">Buy our property finding service. A completely secure and
                                    reliable property finding service tailored to your needs.</p>

                                <a href="#" class="button-31">Add</a>
                            </div>
                        </div>

                        <br>

                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="page-center">
                                <h4 class="text-center">{{ 'No Room Found.' }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

        </div>
        <div class="col-lg-12 mt-3">
            <div class="d-flex align-items-start pt-3" id="custom-pagination">
                <div class="pagination-style-one">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            {{ $rooms->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
@endsection
