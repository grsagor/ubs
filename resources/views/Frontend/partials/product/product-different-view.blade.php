@if (Session::has('view'))
@if (Session::get('view')=='list-view')
<div class="row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
   @foreach($prods as $product)
   <div class="col" >
      <div class="product type-product">
         <div class="product-wrapper">
            <div class="product-image">
               <a href="{{ route('front.product', $product->slug) }}" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="{{ $product->photo ? asset('assets/images/products/'.$product->photo):asset('assets/images/noimage.png') }}" alt="Product Image"></a>
               {{-- @if (round($product->offPercentage() )>0)
                    <div class="on-sale">- {{ round($product->offPercentage() )}}%</div>
               @endif --}}
               <div class="hover-area">
                  @if($product->product_type == "affiliate")
                  <div class="cart-button buynow">
                     <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                  </div>
                  @else
                  @if($product->emptyStock())
                  <div class="closed">
                     <a class="cart-out-of-stock button add_to_cart_button" href="#" title="{{ __('Out Of Stock') }}" ><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                  </div>
                  @else
                  <div class="cart-button">
                     <a href="javascript:;" data-href="{{ route('product.cart.add',$product->id) }}" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Add To Cart') }}" aria-label="{{ __('Add To Cart') }}"></a>
                  </div>

                  <div class="cart-button buynow">
                     <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                  </div>
                  @endif
                  @endif
                  @if(Auth::check())
                  <div class="wishlist-button">
                     <a class="add_to_wishlist  new button add_to_cart_button" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                  </div>
                  @else
                  <div class="wishlist-button">
                     <a class="add_to_wishlist button add_to_cart_button" href="{{ url('user_login') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                  </div>
                  @endif
                  <div class="compare-button">
                     <a class="compare button button add_to_cart_button" data-href="{{ route('product.compare.add',$product->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
                  </div>
               </div>
            </div>
            <div class="product-info">
               <h3 class="product-title"><a href="{{ route('front.product', $product->slug) }}">{{ $product->showName() }}</a></h3>
               <div class="product-price">
                  <div class="price">

                     <ins>{{ $product->setCurrency() }}</ins>
                     <del>{{ $product->showPreviousPrice() }}</del>
                  </div>
               </div>
               <div class="shipping-feed-back">
                  <div class="star-rating">
                     <div class="rating-wrap">
                        <p><i class="fas fa-star"></i><span> {{ App\Models\Rating::ratings($product->id) }} ({{ App\Models\Rating::ratingCount($product->id) }})</span></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>
@else

<div class="row row-cols-xl-4 row-cols-md-3 row-cols-sm-2 row-cols-1 product-style-1 e-title-hover-primary e-image-bg-light e-hover-image-zoom e-info-center">
   @foreach($prods as $product)
   <div class="col" >
      <div class="product type-product">
         <div class="product-wrapper">
            <div class="product-image">
               <a href="{{ route('front.product', $product->slug) }}" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="{{ $product->photo ? asset('assets/images/products/'.$product->photo):asset('assets/images/noimage.png') }}" alt="Product Image"></a>
               {{-- @if (round($product->offPercentage() )>0)
               <div class="on-sale">- {{ round($product->offPercentage() )}}%</div>
               @endif --}}
               <div class="hover-area">
                @if($product->product_type == "affiliate")
                <div class="cart-button buynow">
                   <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                </div>
                @else
                @if($product->emptyStock())
                <div class="closed">
                   <a class="cart-out-of-stock button add_to_cart_button" href="#" title="{{ __('Out Of Stock') }}" ><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                </div>
                @else
                <div class="cart-button">
                   <a href="javascript:;" data-href="{{ route('product.cart.add',$product->id) }}" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Add To Cart') }}" aria-label="{{ __('Add To Cart') }}"></a>
                </div>

                <div class="cart-button buynow">
                   <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                </div>
                @endif
                @endif
                @if(Auth::check())
                <div class="wishlist-button">
                   <a class="add_to_wishlist  new button add_to_cart_button" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                </div>
                @else
                <div class="wishlist-button">
                   <a class="add_to_wishlist button add_to_cart_button" href="{{ url('user_login') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                </div>
                @endif
                <div class="compare-button">
                   <a class="compare button button add_to_cart_button" data-href="{{ route('product.compare.add',$product->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
                </div>
             </div>




            </div>
            <div class="product-info">
               <h3 class="product-title"><a href="{{ route('front.product', $product->slug) }}">{{ $product->showName() }}</a></h3>
               <div class="product-price">
                  <div class="price">
                     <ins>{{ $product->setCurrency() }}</ins>
                     <del>{{ $product->showPreviousPrice() }}</del>
                  </div>
               </div>
               <div class="shipping-feed-back">
                  <div class="star-rating">
                     <div class="rating-wrap">
                        <p><i class="fas fa-star"></i><span> {{ App\Models\Rating::ratings($product->id) }} ({{ App\Models\Rating::ratingCount($product->id) }})</span></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>
@endif
@else
<div class="row row-cols-xxl-2 row-cols-md-2 row-cols-1 g-3 product-style-1 shop-list product-list e-bg-light e-title-hover-primary e-hover-image-zoom">
   @foreach($prods as $product)
   <div class="col" >
      <div class="product type-product">
         <div class="product-wrapper">
            <div class="product-image">
               <a href="{{ route('front.product', $product->slug) }}" class="woocommerce-LoopProduct-link"><img class="lazy" data-src="{{ $product->photo ? asset('assets/images/products/'.$product->photo):asset('assets/images/noimage.png') }}" alt="Product Image"></a>
               {{-- @if (round($product->offPercentage() )>0)
                    <div class="on-sale">- {{ round($product->offPercentage() )}}%</div>
               @endif --}}
               <div class="hover-area">
                  @if($product->product_type == "affiliate")
                  <div class="cart-button buynow">
                     <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                  </div>
                  @else
                  @if($product->emptyStock())
                  <div class="closed">
                     <a class="cart-out-of-stock button add_to_cart_button" href="#" title="{{ __('Out Of Stock') }}" ><i class="flaticon-cancel flat-mini mx-auto"></i></a>
                  </div>
                  @else
                  <div class="cart-button">
                     <a href="javascript:;" data-href="{{ route('product.cart.add',$product->id) }}" class="add-cart button add_to_cart_button" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Add To Cart') }}" aria-label="{{ __('Add To Cart') }}"></a>
                  </div>

                  <div class="cart-button buynow">
                     <a  class="add-to-cart-quick button add_to_cart_button" href="javascript:;" data-href="{{ route('product.cart.quickadd',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="{{ __('Buy Now') }}" aria-label="{{ __('Buy Now') }}"></a>
                  </div>
                  @endif
                  @endif
                  @if(Auth::check())
                  <div class="wishlist-button">
                     <a class="add_to_wishlist  new button add_to_cart_button" id="add-to-wish" href="javascript:;" data-href="{{ route('user-wishlist-add',$product->id) }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                  </div>
                  @else
                  <div class="wishlist-button">
                     <a class="add_to_wishlist button add_to_cart_button" href="{{ url('user_login') }}" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist">{{ __('Wishlist') }}</a>
                  </div>
                  @endif
                  <div class="compare-button">
                     <a class="compare button button add_to_cart_button" data-href="{{ route('product.compare.add',$product->id) }}" href="javascrit:;" data-bs-toggle="tooltip" data-bs-placement="right" title="" data-bs-original-title="Compare" aria-label="Compare">{{ __('Compare') }}</a>
                  </div>
               </div>
            </div>
            <div class="product-info">
               <h3 class="product-title"><a href="{{ route('front.product', $product->slug) }}">{{ $product->showName() }}</a></h3>
               <div class="product-price">
                  <div class="price">

                     <ins>{{ $product->setCurrency() }}</ins>
                     <del>{{ $product->showPreviousPrice() }}</del>
                  </div>
               </div>
               <div class="shipping-feed-back">
                  <div class="star-rating">
                     <div class="rating-wrap">
                        <p><i class="fas fa-star"></i><span> {{ App\Models\Rating::ratings($product->id) }} ({{ App\Models\Rating::ratingCount($product->id) }})</span></p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   @endforeach
</div>
@endif


