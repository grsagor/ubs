@extends('frontend.layouts.master_layout')

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">
            <h3 class="heading ">Digital Marketing:</h3>
            <p class="heading-details">Digital marketing is one of the most needed services for companies to promote their
                products and services. To reach potential customers with your products/services, Unipuller offering you a
                marketplace. You can get all your marketing solutions from hundreds of service providers. </p>

            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <p> See all our marketing solutions just within a click.</p>
                    <a href="https://www.evoluted.net/" target="__blank">Click here</a>
                </div>
                <div class="col-md-6 mt-5">
                    <img src="{{ asset('assets/frontend/digital-marketing.png') }}" alt="digital-marketing.png"
                        style="width: 100%">
                </div>
            </div>
        </div>

        <div class="body m-3 p-3">
            <h6 class="body-heading ">All the marketing solutions that you need, can be found with us. Hundreds of service
                providers offering
                their best quality services. Our providers offering marketing solutions in</h6>
            <ol>
                <li> Email marketing </li>
                <li> Website designing </li>
                <li> Website development </li>
                <li> Logo design </li>
                <li> Banner design </li>
                <li> Content marketing </li>
                <li> Content writing </li>
                <li> SEO </li>
                <li> Photography </li>
                <li> Videography </li>
                <li> Video editing </li>
                <li> 3d and 2d works </li>
                <li> Virtual assistant </li>
                <li> E-commerce website maintenance and more </li>
            </ol>

            <h6 class="body-footer mb-5">Join us today to get our services and offers. We care businesses to grow more and
                get
                bigger. Our services coming with great offers for partners. You miss it you miss business!</h6>
        </div>
    </div>
@endsection
