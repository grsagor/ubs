<!DOCTYPE html>
<html class="desktop uk logged_out no-js" lang="en-GB">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <link rel="stylesheet" href="{{ asset('assets/rough/root.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/rough/stack.css') }}">
</head>

<body>

    <main id="spareroom" class="wrap wrap--main" style="width: 1200px;">
        <div class="grid-4-8-4" id="mainheader">
            <div>&nbsp;</div>
            <div>
                {{-- <h1>Rooms for Rent in London</h1> --}}
            </div>
        </div>

        <div class="grid-4-8-4-ordered" style="display: flex; justify-content: center;">
            <div id="maincontent" class="cols-8 order-2">
                <div class="above_search_results">

                    @forelse ($rooms as $item)
                        <li class="listing-result" style="list-style: none;">

                            @if ($item->advert_type == 2)
                                <span class="featuredHeading">Featured Ad</span>
                            @endif

                            @php
                                $color1 = '#ffdf00';
                                $color2 = '#14c8f6';
                                
                                // Retrieve the current counter value from the session or cache
                                $counter = session('color_counter', 1);
                                
                                // Set the border color based on the counter value
                                $borderColor = $counter % 2 === 1 ? $color1 : $color2;
                                
                                // Increment the counter for the next rendering
                                $counter++;
                                
                                // Store the updated counter back into the session or cache
                                session(['color_counter' => $counter]);
                            @endphp

                            <article class="panel-listing-result listing-featured"
                                style="border-color: {{ $borderColor }};">

                                <header class="desktop">
                                    <a href="{{ route('property_show', $item->id) }}">
                                        <strong class="listingPrice"> {{ $item->room_size }} </strong>
                                        <h2> {{ $item->ad_title }}</h2>
                                    </a>
                                </header>

                                @php
                                    $images = json_decode($item->images, true);
                                    $first_image = null;
                                    $img_count = null;
                                    
                                    if ($images) {
                                        $first_image = reset($images);
                                        $imagePath = public_path($first_image);
                                        $img_count = count($images);
                                    }
                                @endphp

                                <figure>
                                    <a href="#">

                                        @if ($first_image && File::exists($imagePath))
                                            <img src="{{ asset($first_image) }}" srcset="{{ asset($first_image) }}"
                                                width="200" height="200" class="swiper-lazy" alt="">
                                        @else
                                            <img src="https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg"
                                                width="200" height="200" class="swiper-lazy" alt="">
                                        @endif

                                        <p class="media-details">

                                            @if ($img_count > 1)
                                                <span> <i class="fas fa-camera"></i> {{ $img_count }} </span>
                                            @endif

                                        </p>
                                    </a>
                                </figure>
                                <div class="infoLabels"><mark class="new-today">
                                        {{ $item->created_at->diffForHumans() }} </mark></div>

                                <div class="listing-results-content desktop">
                                    <a href="{{ route('property_show', $item->id) }}" class="advertDescription">
                                        <p class="description">
                                            {{ Str::limit($item->ad_text, $limit = 165, $end = '...') }}
                                        </p>

                                        @if ($item->available_form)
                                            <strong>
                                                {{ Carbon\Carbon::createFromFormat('Y-m-d', $item->available_form)->format('M d') }}
                                            </strong>
                                        @endif

                                    </a>
                                </div>


                                <!-- Footer -->
                                <footer class="status_container">
                                    <span class="freeContact status">
                                        <span> Free to Contact </span>
                                    </span>
                                    <span class="tooltip " tabindex="-1">
                                        <span class="tooltip_item">
                                            <a class="interaction-status--not-saved" href="#">
                                                <i class="far fa-heart"></i><span> Save</span>
                                            </a>
                                            <span class="tooltip_box"></span>
                                        </span>
                                        <span class="tooltip_background" tabindex="-1">
                                        </span></span>
                                    <a href="{{ route('property_show', $item->id) }}" class="more desktop"> More
                                        info</a>
                                </footer>

                            </article>
                        </li>

                        @php
                            $no_room = false;
                        @endphp
                    @empty
                        <div class="grid-4-8-4 " id="mainheader">
                            <div>&nbsp;</div>
                            <div>
                                <h1>No Room Available</h1>
                            </div>
                            <div>&nbsp;</div>
                        </div>
                        @php
                            $no_room = true;
                        @endphp
                    @endforelse



                    <!-- Display pagination only when there are no rooms to show or the total number of rooms is fewer than 10 -->
                    @if ($no_room != true && $rooms->total() > 10)
                        @include('rough.pagination', [
                            'data' => $rooms,
                            'pagination' => paginationInfo($rooms),
                        ])
                    @endif

                </div>
            </div>
        </div>
    </main>
</body>

</html>
