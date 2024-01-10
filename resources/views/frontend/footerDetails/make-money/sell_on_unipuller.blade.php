@extends('frontend.layouts.master_layout')
@section('css')
    @include('frontend.footerDetails.css')
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">

        <h4 class="footer-details-title mt-4"><u>Sell on unipuller</u></h4>

        <div class="header mv">
            <div class="welcome">
                {!! $data->description ?? '' !!}
            </div>
        </div>
        {{-- <div class="header mv">

            <div class="welcome">
                <h5 class="fw-bold">
                    Unipuller: Your Gateway to Business Partnerships and Growth
                </h5>
                <p>
                    Are you looking to expand your business, establish partnerships, and
                    accelerate
                    your growth without the need for substantial investment, extensive knowledge, or a significant
                    time
                    commitment? Unipuller is here to transform your business journey with our comprehensive
                    consultancy
                    services and innovative Unipuller Business Solution technology.
                </p>
            </div>

            <div class="welcome">
                <h5 class="fw-bold">
                    Why Choose Unipuller?
                </h5>

                <h5 class="fw-bold">
                    1. Partnership Made Easy:
                </h5>

                <p>
                    Unipuller specializes in bringing businesses together under our
                    partnership
                    network. We simplify the complex process of finding and forming partnerships, saving you
                    valuable time and resources.

                </p>
                <h5 class="fw-bold">
                    2. Partnership:
                </h5>
                <p>
                    With Unipuller, you can connect with sales agents and partners
                    effortlessly. Our platform enables smooth communication and collaboration, ensuring that
                    your
                    business thrives through effective partnerships.

                </p>
                <h5 class="fw-bold">
                    3. Low Barriers to Entry:
                </h5>
                <p>
                    Unipuller's revolutionary approach to business allows anyone to
                    start a
                    business venture with minimal investment and prior knowledge. We've eliminated the
                    traditional
                    obstacles that often hinder aspiring entrepreneurs.
                </p>
                <h5 class="fw-bold">
                    4. Cutting-Edge Technology:
                </h5>
                <p>
                    Our Unipuller Business Solution technology is at the heart of our
                    success.
                    This innovative platform empowers users with the tools they need to grow their
                    businesses
                    efficiently. From managing partnerships to accessing valuable resources, our technology
                    has you
                    covered.

                </p>
            </div>

            <div class="welcome">
                <h5 class="fw-bold">
                    Services Offered by Unipuller
                </h5>
                <h5 class="fw-bold">
                    1. Business Consultancy:
                </h5>

                <p>
                    Our experienced consultants are ready to guide you through the
                    process of
                    forming successful partnerships and expanding your business. Whether you're a seasoned
                    entrepreneur or new to the business world, we provide tailored advice to suit your
                    needs.
                </p>
                <h5 class="fw-bold">
                    2. Partner Matching:
                </h5>
                <p>
                    Unipuller excels in pairing your business with the right partners
                    to help
                    you thrive. Our network includes a diverse range of sales agents and businesses, making
                    it easy
                    to find the perfect fit for your goals.
                </p>
                <h5 class="fw-bold">
                    3. Training and Support:
                </h5>
                <p>
                    Unipuller offers comprehensive training and ongoing support to help
                    you
                    make the most of your partnerships. We ensure you have the tools and knowledge you need
                    to
                    succeed.
                </p>
                <h5 class="fw-bold">
                    4. Unipuller Business Solution Technology:
                </h5>

                <p>
                    Our user-friendly platform is designed to simplify and streamline
                    your
                    business operations. Manage partnerships, access resources, and grow your business with
                    ease,
                    all in one place.
                </p>
            </div>

            <div class="welcome">
                <h5 class="fw-bold">
                    5. Get Started with Unipuller Today!
                </h5>

                <p>
                    Unipuller is your key to unlocking business growth and forming valuable
                    partnerships. Whether you're a seasoned business owner or just starting your entrepreneurial
                    journey,
                    we're here to make it easier for you. Join Unipuller, and let's shape a more prosperous future
                    for your
                    business, together.

                </p>

                <p class="mt-4">
                    Ready to get started? Visit our website, contact our team, and embark on a new journey of business
                    success
                    with Unipuller today.
                </p>
            </div>
        </div> --}}
    </div>
@endsection
