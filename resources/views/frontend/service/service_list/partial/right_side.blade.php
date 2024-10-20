<div class="col-lg-6 col-md-6 col-sm-12 laptop_view_card mobile_view_card">

    <div class="showing-products border-2 border-bottom border-light" id="ajaxContent">

        <div class="product-style-1 shop-list product-list  e-title-hover-primary e-hover-image-zoom">

            {{-- Service part --}}
            @if (count($products) > 0)
                @yield('property_list_content')
            @else
                <div class="card">
                    <div class="card-body">
                        <div class="page-center">
                            <h4 class="text-center text-danger">{{ 'No Service Found.' }}</h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

{{-- Right side Advertise widget --}}
<div class="col-lg-3 col-md-3 col-sm-12">
    <div class="card">
        <img src="https://credcv.com/wp-content/uploads/2021/06/benefits-of-having-an-own-job-portal_033e017b0_3810.jpeg"
            class="card-img-top" alt="Card image">
        <div class="card-body">
            <h5 class="card-title">Advertise your service</h5>
            <p class="card-text">List your service unlimited and completely free.
            </p>
            <a href="{{ route('products.create') }}" class="button-31">Add</a>
        </div>
    </div>
    <br>
    <div class="card">
        <img src="https://dynamic.placementindia.com/blog_images/20220625113020_image1.jpg" class="card-img-top"
            alt="Card image">
        <div class="card-body">
            <h5 class="card-title">Can't find your service?</h5>
            <p class="card-text">Contact us to get what you need. We will connect
                you with the right service provider who knows that solution.</p>
            <a href="#" class="button-31">Add</a>
        </div>
    </div>
    <br>
    <div class="card">
        <img src="https://www.barraiser.com/wp-content/uploads/2024/06/best-job-website-in-usa.png" class="card-img-top"
            alt="Card image">
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
        <img src="https://blogimages.softwaresuggest.com/blog/wp-content/uploads/2023/04/14124110/Top-10-Job-Portals-in-India-That-Makes-Them-Good-min.jpg"
            alt="Card image">
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
