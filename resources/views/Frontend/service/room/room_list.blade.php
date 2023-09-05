@extends('frontend.service.partial.app')
@section('property_list_content')
    @foreach ($rooms as $item)
        <div class="col mb-5">
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
                            <a href="{{ route('room_show', $item->id) }}" class="woocommerce-LoopProduct-link">
                                <img class="lazy img-fluid rounded" data-src="{{ asset($first_image) }}" alt="Product Image">
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
                            <p class="category_text text-dark" style="margin-bottom: 0rem; margin-top: -10px;">
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
@endsection
