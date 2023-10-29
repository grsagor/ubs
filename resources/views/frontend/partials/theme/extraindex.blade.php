<style>
    .text-center {
        text-align: center !important;
    }

    .custom-service img {
        max-width: 150px;
        width: 100%;
        min-width: 120px;
    }

    .custom-service-title {
        font-weight: 500;
        font-size: 16px;
        margin-top: 5px;
    }
</style>


<div class="container container-sm py-4 main-features-section">
    <div class="row justify-content-center">
        <div class="col-12">
            <h2 class="text-dark text-center">Main Features</h2>
            <hr class="mx-auto">
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top Deal</h5>
                        <div class="row">

                            <div class="col-12">
                                <div class="card-img">
                                    <img class="lazy" data-src="{{ asset('assets/front/images/services/deal.png') }}"
                                        alt="" height="">
                                </div>
                                <span class="badge bg-danger text-white">Up to 37% off</span><span class="text-danger">
                                    Deal</span>
                                <p class="text-secondary card-text mb-2 ">we take pride in providing the best deals to our valued customers </p>
                            </div>
                        </div>
                        <a href="#" class="card-link mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Buy products</h5>
                        <div class="row">
                            @php
                                $index = 0;
                            @endphp

                            @foreach ($products as $category)
                            @php
                                $index++;
                                $currentimg = asset('assets/front/images/products/sample'.$index.'.png');
                            @endphp
                                <div class="col-6">
                                    <a href="{{ route('front.category') }}" class="text-decoration-none">
                                        <div class="card-item text-center">
                                            {{-- <img class="lazy"
                                                data-src="{{$currentimg }}"
                                                alt=""> --}}
                                        </div>
                                        <p class="text-secondary card-text mb-2 text-center">
                                            @if (strlen($category->name) > 30)
                                                {{ substr($category->name, 0, 30) . '...' }}
                                            @else
                                                {{ $category->name }}
                                            @endif
                                        </p>
                                    </a>

                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('front.categories') }}" class="card-link mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">

            <a href="">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Sell a product</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-img-sell-product">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/sell-product.png') }}"
                                        alt="" height="">
                                </div>
                            </div>
                        </div>
                        <a href="" class="card-link mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Study Support</h5>
                        <div class="row">
                            <div class="col-6">
                                <a href="{{route('front.service_category', 'tutoring')}}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/tutoring.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Tutoring
                                    </p>
                                </a>
                            </div>
                            <div class="col-6 ">
                                <a href="{{route('front.service_category', 'educational')}}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/elearning.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        E-learning
                                    </p>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('front.service_category', 'study-abroad-consultancy')}}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/study-abroad.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Study Abroad
                                    </p>
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('front.service_category', 'educational')}}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/books.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Purchase Books
                                    </p>
                                </a>
                            </div>
                        </div>
                        <a href="{{route('front.service_category', 'educational')}}" class="card-link mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Book a service</h5>
                        <div class="row">
                            <div class="col-6 ">
                                <a href="{{ route('front.service_category') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/doctor.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Doctor
                                    </p>
                                </a>

                            </div>
                            <div class="col-6 ">
                                <a href="{{ route('front.service_category') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/engineer.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Engineer
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.service_category') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/lawyer.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Lawyer
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="{{ route('front.service_category') }}" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/meison.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Meison
                                    </p>
                                </a>

                            </div>
                        </div>
                        <a href="{{ route('front.service_category') }}" class="card-link mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Technology services</h5>
                        <div class="row">
                            <div class="col-6 ">
                                <a href="https://slippa.unipuller.uk" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/app-dev.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Application Development
                                    </p>
                                </a>

                            </div>
                            <div class="col-6 ">
                                <a href="https://slippa.unipuller.uk" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/web-desiogn.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Web Designing
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="https://slippa.unipuller.uk" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/web-dev.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Web Development
                                    </p>
                                </a>

                            </div>
                            <div class="col-6">
                                <a href="https://slippa.unipuller.uk" class="text-decoration-none">
                                    <div class="card-item">
                                        <img class="lazy"
                                            data-src="{{ asset('assets/front/images/services/cyber.png') }}"
                                            alt="">
                                    </div>
                                    <p class="text-secondary card-text mb-2 text-center">
                                        Cyber Secuity
                                    </p>
                                </a>

                            </div>
                        </div>
                        <a href="https://slippa.unipuller.uk" class="card-link mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="https://slippa.unipuller.uk">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Domain Hosting</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card-img-sell-product">
                                    <img class="lazy"
                                        data-src="{{ asset('assets/front/images/services/domain-hosting.png') }}"
                                        alt="" height="">
                                </div>
                            </div>
                        </div>
                        <a href="https://slippa.unipuller.uk" class="card-link mt-2">Show more details</a>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3 col-xl-3 col-md-6 buy-sell py-2">
            <a href="#">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Search local companies</h5>
                        <div class="row">
                            
                                <div class="col-6">
                                    <a href="" class="text-decoration-none">
                                        <div class="card-item text-center">
                                                <img class="lazy img-fluid" data-src="{{ asset('assets/common_img/vendor_profile.jpeg') }}" alt="Product Image">
                                        </div>
                                        <p class="text-secondary card-text mb-2 text-center">
                                         
                                                Vendor Shop Name
                                      
                                        </p>
                                    </a>

                                </div>
                          

                        </div>
                        <a href="" class="card-link mt-2">Show more details</a>
                    </div>
                </div>

            </a>
        </div>

    </div>
</div>



