<div class="col-12 col-xl-9 col-lg-9 col-md-12 col-sm-12" style="padding: 0px !important;">

    <div class="showing-products border-2 border-bottom border-light" id="ajaxContent">

        <div class="row mb-4 g-3 product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom"
            style="padding: 0px !important;">

            {{-- Service part --}}
            <div class="col-md-9 laptop_view_card mobile_view_card">
                @if (count($products) > 0)
                    @yield('property_list_content')
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="page-center">
                                <h4 class="text-center text-danger">{{ 'No Product Found.' }}</h4>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Right side Advertise widget --}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Advertise your service</h5>
                        <p class="card-text">List your service unlimited and completely free.
                        </p>
                        <a href="{{ route('products.create') }}" class="button-31">Add</a>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Can't find your service?</h5>
                        <p class="card-text">Contact us to get what you need. We will connect
                            you with the right service provider who knows that solution.</p>
                        <a href="#" class="button-31">Add</a>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Software to run your business?</h5>
                        <p class="card-text">Use our complete business solution software package
                            completely free of charge. The most updated and latest technology to
                            serve your business needs.</p>
                        <a href="{{ url('business/register') }}" class="button-31">Add</a>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Find your favourite company.</h5>
                        <ol>
                            <li class="card-text">Company wise filter
                            </li>
                            <li class="card-text">Search by location
                            </li>
                        </ol>
                        <a href="{{ route('shop.list') }}" class="button-31">Details</a>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
