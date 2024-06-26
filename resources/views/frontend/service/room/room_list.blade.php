@extends('frontend.service.partial.app')
@section('css')
    <style>
        .image-carousel {
            position: relative;
        }

        /* .carousel-container {
                                                                                                                position: relative !important;
                                                                                                                display: flex;
                                                                                                                justify-content: center;
                                                                                                                align-items: center;
                                                                                                            } */

        .mySlides {
            display: none;
        }

        .demo {
            width: 100px;
            cursor: pointer;
        }


        .image-carousel {
            position: relative;
        }

        .carousel-container {
            position: relative !important;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .previous,
        .next {
            font-size: 24px;
            cursor: pointer;
            padding: 8px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 4px;
            position: absolute !important;
            top: 33%;
            z-index: 1;
        }

        .previous {
            left: 0;
        }

        .next {
            right: 0;
        }

        .image-slide {
            position: relative;
        }

        .image-slide img {
            max-width: 100%;
            height: auto;
            display: block;
        }

        /* .active {
                                                                                    background-color: #333;
                                                                                } */
    </style>
@endsection
@section('property_list_content')
    @foreach ($rooms as $index => $item)
        <div class="col mb-4">
            <div class="product type-product rounded ">
                <div class=" row m-0">
                    <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center card-image"
                        style="justify-content: center">
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
                            @if ($img_count == 1)
                                <a href="{{ route('room_show', $item->id) }}" class="woocommerce-LoopProduct-link">
                                    <img class="lazy img-fluid rounded" data-src="{{ asset($first_image) }}"
                                        alt="Product Image" style="height: 194px;">
                                </a>
                            @else
                                <div class="slideShow">
                                    <!-- Images in the slideshow -->
                                    <div class="image-carousel">
                                        <div class="carousel-container">
                                            @foreach ($images as $key => $val)
                                                <div>
                                                    <img class="mySlides mySlides-{{ $index }}"
                                                        src="{{ asset($val) }}" style="height: 194px;">
                                                </div>
                                            @endforeach
                                            <a class="previous"
                                                onclick="plusSlides(-1,'mySlides-{{ $index }}')">❮</a>
                                            <a class="next" onclick="plusSlides(1,'mySlides-{{ $index }}')"
                                                style="float: right;">❯</a>
                                        </div>
                                    </div>
                                </div>
                            @endif


                            <script>
                                var slideIndex = 1;
                                showDivs(slideIndex, 'mySlides-{{ $index }}');

                                function plusSlides(n, id) {
                                    showDivs(slideIndex += n, id);
                                }

                                function showDivs(n, id) {
                                    var i;
                                    var x = document.getElementsByClassName(id);
                                    var dots = document.getElementsByClassName("demo");
                                    console.log(id)

                                    if (n > x.length) {
                                        slideIndex = 1;
                                    }
                                    if (n < 1) {
                                        slideIndex = x.length;
                                    }

                                    for (i = 0; i < x.length; i++) {
                                        x[i].style.display = "none";
                                    }
                                    for (i = 0; i < dots.length; i++) {
                                        dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
                                    }

                                    x[slideIndex - 1].style.display = "block";
                                    dots[slideIndex - 1].className += " w3-opacity-off";
                                }
                            </script>
                        @else
                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                class="swiper-lazy" alt="" style="height: 200px;">
                        @endif
                    </div>
                    <div class=" col-lg-8 col-md-8 col-sm-12 p-0 d-flex flex-column">
                        <div class="p-2 flex-grow-1">
                            <h5 class="product-title" style="padding: 2px 2px 2px 2px;">
                                <a class="text-dark" href="{{ route('room_show', $item->id) }}">
                                    <span style="font-weight: 600;">
                                        {{ Str::limit($item->advert_title, $limit = 92, $end = '...') }}
                                    </span>
                                </a>
                            </h5>
                            <hr class="mt-0" style="height: 2px; width: 100% !important; margin-bottom: 10px;">
                            <p class="category_text text-dark"
                                style="margin-bottom: 0rem; text-align: justify; padding: 0px 10px 0px 10px">
                                {{ Str::limit($item->advert_description, $limit = 168, $end = '...') }}
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
                            }
                        @endphp


                        <div class="d-flex text-center"
                            style="background-color: whitesmoke; border-top: 3px solid var(--green);">

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0  text-muted"
                                    style="color: black !important; font-size: 15px;">
                                    Type
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ $item->child_category->name }}
                                </p>
                            </span>

                            @if ($item->child_category_id !== 9)
                                <span class=" flex-fill mb-0 text-white">
                                    <p class="lower-section-text mb-0  text-muted"
                                        style="color: black !important; font-size: 15px;">
                                        Bed
                                    </p>
                                    <p class="mb-0 text-muted">
                                        @if ($item->child_category_id == 1)
                                            {{ $item->property_room_quantity }}
                                        @elseif($item->child_category_id == 2 || $item->child_category_id == 6)
                                            {{ $item->property_size }}
                                        @endif
                                    </p>
                                </span>
                            @endif

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0  text-muted"
                                    style="color: black !important; font-size: 15px;">
                                    Toilet
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ $item->bathroom }}
                                </p>
                            </span>

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0  text-muted"
                                    style="color: black !important; font-size: 15px;">
                                    Max. Tenants
                                </p>
                                <p class="mb-0 text-muted">
                                    {{ $item->property_allow_people }}
                                </p>
                            </span>

                            <span class=" flex-fill mb-0 text-white">
                                <p class="lower-section-text mb-0" style="color: black; font-size: 15px;">
                                    Rent
                                </p>
                                <p class="mb-0 text-muted">
                                    &pound;
                                    @if ($item->child_category_id == 1)
                                        {{ $room_rent }}
                                    @else
                                        {{ $item->rent }}
                                    @endif <abbr>pcm</abbr>
                                </p>
                            </span>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Pagination --}}
    @include('frontend.pagination.pagination', ['paginator' => $rooms])

@endsection
@section('script')
@endsection
