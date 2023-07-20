<div class="full-row pb-0">
  <div class="container">
    <div class="row single-product-wrapper">
      <div class="col-12 col-lg-4 mb-4 mb-lg-0">
        <div class="product-images overflow-hidden">
          <div class="images-inner">
            <div class="woocommerce-product-gallery woocommerce-product-gallery--with-images woocommerce-product-gallery--columns-4 images" data-columns="4" style="opacity: 1; transition: opacity 0.25s ease-in-out 0s;">
              <figure class="woocommerce-product-gallery__wrapper">
                <div class="bg-light">
                  <img id="single-image-zoom" src="{{filter_var($service->photo, FILTER_VALIDATE_URL) ?$service->photo:asset('assets/images/products/'.$service->photo)}}" alt="Thumb Image" data-zoom-image="{{filter_var($service->photo, FILTER_VALIDATE_URL) ?$service->photo:asset('assets/images/products/'.$service->photo)}}" />
                </div>

                <div id="gallery_09" class="product-slide-thumb">
                  <div class="owl-carousel four-carousel dot-disable nav-arrow-middle owl-mx-5">
                    @foreach($service->galleries as $gal)
                    <div class="item">
                      <a class="active" href="{{asset('assets/images/galleries/'.$gal->photo)}}" data-image="{{asset('assets/images/galleries/'.$gal->photo)}}" data-zoom-image="{{asset('assets/images/galleries/'.$gal->photo)}}">
                        <img src="{{asset('assets/images/galleries/'.$gal->photo)}}" alt="Thumb Image" />
                      </a>
                    </div>
                    @endforeach
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
            <div class="entry-breadcrumbs w-100">
              <nav class="breadcrumb-divider-slash" aria-label="breadcrumb">
                <ol class="breadcrumb pro-bread">
                  <li class="breadcrumb-item"><a href="{{route('front.index')}}">{{__('Home')}}</a></li>
                  <li class="breadcrumb-item"><a href="{{url('front/category',$service->category->slug)}}">{{$service->category->name}}</a></li>


                </ol>
              </nav>
            </div>
            <h1 class="product_title entry-title">{{ $service->name }}</h1>
            <p class="product-title">{{ strip_tags($service->short_description) }}</p>

            <div class="pro-details">
              <div class="pro-info">
                <div class="woocommerce-product-rating">
                  <div class="fancy-star-rating">
                    <div class="rating-wrap"> <span class="fancy-rating good">{{ App\Models\Rating::ratings($service->id) }} ★</span>
                    </div>
                    <div class="rating-counts-wrap">
                      <a href="#reviews" class="bigbazar-rating-review-link" rel="nofollow"> <span class="rating-counts"> ({{ App\Models\Rating::ratingCount($service->id) }}) </span> </a>
                    </div>
                  </div>
                </div>

                <p class="price">
                  <span class="woocommerce-Price-amount amount mr-4">
                    <bdi><span class="woocommerce-Price-currencySymbol" id="sizeprice">{{ $service->showPrice() }}</bdi>
                  </span>
                  <del class="ml-3"><small>{{ $service->showPreviousPrice() }}</small></del>

                </p>
              </div>
              
              <input type="hidden" id="service_price" value="{{ round($service->vendorPrice() * $curr->value,2) }}">
              <input type="hidden" id="service_id" value="{{ $service->id }}">
              <input type="hidden" id="curr_pos" value="{{ $gs->currency_format }}">
              <input type="hidden" id="curr_sign" value="{{ $curr->sign }}">

              

              <li class="addtocart m-1">
                <a id="qserviceaddcrt" href="javascript:;">
                  {{ __('Book Now') }}
                </a>
              </li>

              </ul>
            </div>
            <div class="yith-wcwl-add-to-wishlist wishlist-fragment mt-3">
              @if(Auth::check())
              <div class="wishlist-button">
                <a class="add_to_wishlist new" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$service->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
              </div>
              @else
              <div class="wishlist-button">
                <a class="add_to_wishlist" href="{{ url('user_login') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
              </div>
              @endif
              <div class="compare-button">
                <a class="compare button" data-href="{{ route('product.compare.add',$service->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
              </div>

            </div>

            
            @if(Auth::guard('web')->check())

            <div class="report-area">
              <a class="report-item" href="javascript:;" data-bs-toggle="modal" data-bs-target="#report-modal"><i class="fas fa-flag"></i> {{__('Report This Item')}}</a>
            </div>
            @else
            <div class="report-area">
              <a class="report-item" href="{{route('user.login')}}"><i class="fas fa-flag"></i> {{__('Report This Item')}} </a>
            </div>
            @endif

            <div class="my-4 social-linkss social-sharing a2a_kit a2a_kit_size_32">
              <h5 class="mb-2">{{ __('Share Now') }}</h5>
              <ul class="social-icons py-1 share-product social-linkss py-md-0">
                <li>
                  <a class="facebook a2a_button_facebook" href="">
                    <i class="fab fa-facebook-f"></i>
                  </a>
                </li>
                <li>
                  <a class="twitter a2a_button_twitter" href="">
                    <i class="fab fa-twitter"></i>
                  </a>
                </li>
                <li>
                  <a class="linkedin a2a_button_linkedin" href="">
                    <i class="fab fa-linkedin-in"></i>
                  </a>
                </li>
                <li>
                  <a class="pinterest a2a_button_pinterest" href="">
                    <i class="fab fa-pinterest-p"></i>
                  </a>
                </li>
                <li>
                  <a class="instagram a2a_button_whatsapp" href="">
                    <i class="fab fa-whatsapp"></i>
                  </a>
                </li>
              </ul>

            </div>

            @if($service->availability)
            <p><strong>Availability: </strong> {{$service->availability == '1' ? 'Available' : 'Unavailable'}}</p>
            @endif
            @if($service->is_emergency)
            <p><strong>Emergency: </strong> {{$service->is_emergency == '1' ? 'Yes' : 'No'}}</p>
            @endif
            @if($service->experience)
            <p><strong>Experience: </strong> {{$service->experience}}</p>
            @endif
            @if($service->note)
            <p><strong>Customer Note: </strong> {{$service->note}}</p>
            @endif
            @if($service->facilities)
            <p><strong>Facilities: </strong> {{$service->facilities}}</p>
            @endif
            @if($service->specializaiion)
            <p><strong>Specialization: </strong> {{$service->specialization}}</p>
            @endif
            <script async src="https://static.addtoany.com/menu/page.js"></script>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-4">
             <div class="pro-details-sidebar-item mb-4">
                <span>{{ __('Sold By') }}</span>
                <h5>@if( $service->user_id  != 0)

                  @if(isset($service->user))
                    {{ $service->user->shop_name }}
                  @endif
                  @if($service->user->checkStatus())
                  <br>
                  <a class="verify-link" href="javascript:;" data-toggle="tooltip" data-placement="top" title=""
                    data-original-title="{{ __('Verified') }}">
                    <i class="fas fa-check-circle"></i>
                  </a>
                  @endif
                @else
                {{ App\Models\Admin::find(1)->shop_name }}
                @endif</h5>
                @if( $service->user_id  != 0)
                <h3>{{ App\Models\UserService::where('user_id','=',$service->user_id)->get()->count() }}</h3>
                @else
                <h3>{{ App\Models\UserService::where('user_id','=',0)->get()->count() }}</h3>
                @endif
                <h6>{{ __('Total Services') }}</h6>

                @if( $service->user_id  != 0)
              <li class="{{ $gs->is_contact_seller == 0 ? 'contact_seller' : '' }} cnt-sell">
                <!-- <a href="{{ route('front.vendor',str_replace(' ', '-', $service->user->shop_name)) }}" class="view-stor btn--base">
                  <i class="icofont-ui-travel"></i>
                  {{ __('Visit Store') }}
                </a> -->
                <a href="{{ route('vendor.service',$service->user->id) }}" class="view-stor btn--base">
                  <i class="icofont-ui-travel"></i>
                  {{ __('Visit Store') }}
                </a>
            </li>
            @endif

            {{-- Visit Store Ends--}}

            @if($gs->is_contact_seller == 1)

              {{-- Contact Seller --}}

              @if(Auth::check())

                @if($service->user_id != 0)


                  <a class="view-stor btn--base" href="javascript:;" data-bs-toggle="modal" data-bs-target="#vendorform">
                    <i class="icofont-ui-chat"></i>
                    {{ __('Contact Seller') }}
                  </a>


                @else


                  <a class="view-stor btn--base" href="javascript:;" data-bs-toggle="modal" data-bs-target="#sendMessage">
                    <i class="icofont-ui-chat"></i>
                    {{ __('Contact Seller') }}
                  </a>


                @endif

              @else


              <a class="view-stor btn--base" href="{{ url('user_login') }}" >
                  <i class="icofont-ui-chat"></i>
                  {{ __('Contact Seller') }}
                </a>


              @endif

              {{-- Contact Seller Ends --}}

            @endif

            <br>
            @if($service->user_id != 0)
              @if(Auth::check())
                  @if(Auth::user()->favorites()->where('vendor_id','=',$service->user_id)->get()->count() > 0)

                  <a class="fvrt btn--base" href="javascript:;">
                      <i class="icofont-check"></i>
                      {{ __('Favorite') }}
                  </a>
                  @else
                  <a class="view-stor favorite-prod btn--base" href="javascript:;" data-href="{{ route('user-favorite',[Auth::user()->id,$service->user_id]) }}">
                      <i class="icofont-plus"></i>
                      {{ __('Add To Favorite Seller') }}
                  </a>
                  @endif

              @else

              <a class="view-stor btn--base" href="{{ url('user_login') }}" >
                <i class="icofont-plus"></i>
                {{ __('Add To Favorite Seller') }}
              </a>

              @endif
            @endif

            {{-- Favorite Seller Ends--}}
             </div>
    </div>

  </div>
</div>


{{-- MESSAGE MODAL --}}
{{-- MESSAGE MODAL --}}
<div class="message-modal">
  <div class="modal" id="vendorform" tabindex="-1" role="dialog" aria-labelledby="vendorformLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="vendorformLabel">{{ __('Send Message') }}</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form id="emailreply">
                    {{csrf_field()}}
                    <ul>

                      <li>
                        <input type="email" class="form-control border mb-1" id="eml" name="email" placeholder="{{ __('Email *') }}" required="">
                      </li>


                      <li>
                        <input type="text" class="form-control border mb-1" id="subj" name="subject" placeholder="{{ __('Subject *') }}" required="">
                      </li>

                      <li>
                        <textarea class="form-control textarea border mb-1" name="message" id="msg" placeholder="{{ __('Your Message *') }}" required=""></textarea>
                      </li>

                      <input type="hidden" name="name" value="{{ Auth::user() ? Auth::user()->name:'' }}">
                      <input type="hidden" name="user_id" value="{{ Auth::user() ? Auth::user()->id:'' }}">

                    </ul>
                    <button class="submit-btn" id="emlsub" type="submit">{{ __('Send Message') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- MESSAGE MODAL ENDS --}}

{{-- MESSAGE MODAL ENDS --}}

<div class="message-modal">
  <div class="modal show" id="sendMessage" tabindex="-1" role="dialog" aria-labelledby="sendMessageLabel" aria-modal="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sendMessageLabel">{{ __('Send Message') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid p-0">
            <div class="row">
              <div class="col-md-12">
                <div class="contact-form">
                  <form action="{{ route('user-send-message') }}" class="emailreply">
                    @csrf
                    <ul>
                      <li>
                        <input type="text" class="input-field" name="subject" placeholder="{{ __('Subject *') }}" required="">
                      </li>
                      <li>
                        <textarea class="input-field textarea" name="message" placeholder="{{ __('Your Message') }}" required=""></textarea>
                      </li>
                      <input type="hidden" name="type" value="Ticket">
                    </ul>
                    <button class="submit-btn" type="submit">{{ __('Send Message') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>