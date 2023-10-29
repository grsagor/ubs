<style>
    .footer-details-container {
        display: grid;
        grid-template-columns: 1fr 3fr;
        gap: 20px;
        padding: 0 20px;
        margin-top: 20px;
    }

    .footer-details-sidebar {
        border: 1px solid #ddd;
        padding: 20px !important;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #495057;
        background-color: #fff;
        border: none !important;
    }

    .nav-link {
        padding: 0 !important;
    }

    .footer-details-content {
        padding: 20px !important;
        border: 1px solid #ddd;
    }

    .footer-details-content {}

    .footer-details-title {}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
@extends('frontend.layouts.master_layout')
@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="footer-details-container">
        <div class="footer-details-sidebar nav nav-tabs flex-column" id="nav-tab" role="tablist">

            <ul class="{{ Route::is('footer.details.about') ? 'd-block' : 'd-none' }}">
                <li>
                    <h6>About</h6>
                </li>
                <li><button class="nav-link {{ Route::is('footer.details.about') ? 'active' : '' }}" id="nav-about-tab"
                        data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab"
                        aria-controls="nav-about" aria-selected="true">About us</button></li>

                <li><button class="nav-link" id="nav-statement-tab" data-bs-toggle="tab" data-bs-target="#nav-statement"
                        type="button" role="tab" aria-controls="nav-statement" aria-selected="false">Statement</button>
                </li>
                <li><button class="nav-link" id="nav-sustainibility-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-sustainibility" type="button" role="tab"
                        aria-controls="nav-sustainibility" aria-selected="false">Sustainability</button></li>
                <li><button class="nav-link" id="nav-unipuller-service-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-unipuller-service" type="button" role="tab"
                        aria-controls="nav-unipuller-service" aria-selected="false">Unipuller service</button></li>
            </ul>

            <ul class="{{ Route::is('footer.details.make.money') ? 'd-block' : 'd-none' }}">
                <li>
                    <h6>Make money with us</h6>
                </li>
                <li><button class="nav-link {{ Route::is('footer.details.make.money') ? 'active' : '' }}"
                        id="nav-sell-on-unipuller-tab" data-bs-toggle="tab" data-bs-target="#nav-sell-on-unipuller"
                        type="button" role="tab" aria-controls="nav-sell-on-unipuller" aria-selected="true">Sell on
                        unipuller</button></li>
                <li><button class="nav-link" id="nav-sell-on-unipuller-technology-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-sell-on-unipuller-technology" type="button" role="tab"
                        aria-controls="nav-sell-on-unipuller-technology" aria-selected="false">Sell on unipuller
                        technology</button></li>
                <li><button class="nav-link" id="nav-associate-program-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-associate-program" type="button" role="tab"
                        aria-controls="nav-associate-program" aria-selected="false">Associate program</button></li>
                <li><button class="nav-link" id="nav-delivery-partner-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-delivery-partner" type="button" role="tab"
                        aria-controls="nav-delivery-partner" aria-selected="false">Delivery partner</button></li>
            </ul>
            <ul class="{{ Route::is('footer.details.our.services') ? 'd-block' : 'd-none' }}">
                <li>
                    <h6>Our services</h6>
                </li>
                <li><button class="nav-link {{ Route::is('footer.details.our.services') ? 'active' : '' }}"
                        id="nav-advertising-tab" data-bs-toggle="tab" data-bs-target="#nav-advertising" type="button"
                        role="tab" aria-controls="nav-advertising" aria-selected="true">Advertising</button></li>
                <li><button class="nav-link" id="nav-marketing-tab" data-bs-toggle="tab" data-bs-target="#nav-marketing"
                        type="button" role="tab" aria-controls="nav-marketing" aria-selected="false">Marketing</button>
                </li>
                <li><button class="nav-link" id="nav-website-development-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-website-development" type="button" role="tab"
                        aria-controls="nav-website-development" aria-selected="false">Website Development</button></li>
                <li><button class="nav-link" id="nav-software-development-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-software-development" type="button" role="tab"
                        aria-controls="nav-software-development" aria-selected="false">Software Development</button></li>
                <li><button class="nav-link" id="nav-seo-tab" data-bs-toggle="tab" data-bs-target="#nav-seo"
                        type="button" role="tab" aria-controls="nav-seo" aria-selected="false">SEO</button></li>
                <li><button class="nav-link" id="nav-video-production-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-video-production" type="button" role="tab"
                        aria-controls="nav-video-production" aria-selected="false">Video Production</button></li>
                <li><button class="nav-link" id="nav-partner-boarding-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-partner-boarding" type="button" role="tab"
                        aria-controls="nav-partner-boarding" aria-selected="false">Partner Boarding</button></li>
            </ul>
            <ul class="{{ Route::is('footer.details.quick.links') ? 'd-block' : 'd-none' }}">
                <li>
                    <h6>Quick links</h6>
                </li>
                <li><button class="nav-link {{ Route::is('footer.details.quick.links') ? 'active' : '' }}"
                        id="nav-software-tab" data-bs-toggle="tab" data-bs-target="#nav-software" type="button"
                        role="tab" aria-controls="nav-software" aria-selected="true">Software</button></li>
                <li><button class="nav-link" id="nav-domain-n-hosting-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-domain-n-hosting" type="button" role="tab"
                        aria-controls="nav-domain-n-hosting" aria-selected="false">Domain & Hosting</button></li>
                <li><button class="nav-link" id="nav-ready-websites-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-ready-websites" type="button" role="tab"
                        aria-controls="nav-ready-websites" aria-selected="false">Ready Websites</button></li>
                <li><button class="nav-link" id="nav-form-generator-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-form-generator" type="button" role="tab"
                        aria-controls="nav-form-generator" aria-selected="false">Form Generator</button></li>
                <li><button class="nav-link" id="nav-qr-code-generator-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-qr-code-generator" type="button" role="tab"
                        aria-controls="nav-qr-code-generator" aria-selected="false">QR Code Generator</button></li>
                <li><button class="nav-link" id="nav-content-creator-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-content-creator" type="button" role="tab"
                        aria-controls="nav-content-creator" aria-selected="false">Content Creator</button></li>
            </ul>
            <ul class="{{ Route::is('footer.details.policies') ? 'd-block' : 'd-none' }}">
                <li>
                    <h6>Policies</h6>
                </li>
                <li><button class="nav-link {{ Route::is('footer.details.policies') ? 'active' : '' }}"
                        id="nav-privacy-tab" data-bs-toggle="tab" data-bs-target="#nav-privacy" type="button"
                        role="tab" aria-controls="nav-privacy" aria-selected="true">Privacy</button></li>
                <li><button class="nav-link" id="nav-cookies-tab" data-bs-toggle="tab" data-bs-target="#nav-cookies"
                        type="button" role="tab" aria-controls="nav-cookies" aria-selected="false">Cookies</button>
                </li>
                <li><button class="nav-link" id="nav-condition-of-sale-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-condition-of-sale" type="button" role="tab"
                        aria-controls="nav-condition-of-sale" aria-selected="false">Condition of sale</button></li>
                <li><button class="nav-link" id="nav-condition-of-use-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-condition-of-use" type="button" role="tab"
                        aria-controls="nav-condition-of-use" aria-selected="false">Condition of use</button></li>
                <li><button class="nav-link" id="nav-return-policies-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-return-policies" type="button" role="tab"
                        aria-controls="nav-return-policies" aria-selected="false">Return policies</button></li>
                <li><button class="nav-link" id="nav-refund-policies-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-refund-policies" type="button" role="tab"
                        aria-controls="nav-refund-policies" aria-selected="false">Refund policies</button></li>
                <li><button class="nav-link" id="nav-seller-statement-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-seller-statement" type="button" role="tab"
                        aria-controls="nav-seller-statement" aria-selected="false">Seller statement</button></li>
                <li><button class="nav-link" id="nav-payment-terms-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-payment-terms" type="button" role="tab"
                        aria-controls="nav-payment-terms" aria-selected="false">Payment terms</button></li>
            </ul>
            <ul class="mt-3">
                <li>
                    <h6>More Links</h6>
                </li>
                <li class="{{ Route::is('footer.details.about') ? 'd-none' : 'd-block' }}"><button class="nav-link"><a
                            href="{{ route('footer.details.about') }}">About</a></button></li>
                <li class="{{ Route::is('footer.details.make.money') ? 'd-none' : 'd-block' }}"><button
                        class="nav-link"><a href="{{ route('footer.details.make.money') }}">Make money with
                            us</a></button></li>
                <li class="{{ Route::is('footer.details.our.services') ? 'd-none' : 'd-block' }}"><button
                        class="nav-link"><a href="{{ route('footer.details.our.services') }}">Our services</a></button>
                </li>
                <li class="{{ Route::is('footer.details.quick.links') ? 'd-none' : 'd-block' }}"><button
                        class="nav-link"><a href="{{ route('footer.details.quick.links') }}">Quick links</a></button>
                </li>
                <li class="{{ Route::is('footer.details.policies') ? 'd-none' : 'd-block' }}"><button class="nav-link"><a
                            href="{{ route('footer.details.policies') }}">Policies</a></button></li>
            </ul>
        </div>


        <div class="footer-details-content tab-content" id="nav-tabContent">
            {{-- ========================= About ========================= --}}
            <div class="tab-pane fade show active {{ Route::is('footer.details.about') ? '' : 'd-none' }}" id="nav-about"
                role="tabpanel" aria-labelledby="nav-about-tab" tabindex="0">
                <h3 class="footer-details-title">About Us</h3>
                <p class="footer-details-content">Unipuller Limited is a registered Private Ltd. company with Company House
                    in the United Kingdom and Bangladesh, known for its commitment to excellence and innovation. With a
                    focus on providing high-quality solutions in various industries, we have established a strong reputation
                    for reliability. Our vision is to revolutionize industries by offering cutting-edge solutions that
                    enhance efficiency, productivity, and sustainability. Through our customer-centric approach and
                    dedication to continuous improvement, we aim to be the preferred choice for businesses seeking reliable
                    and innovative solutions. With a team of experts and a commitment to exceeding client expectations,
                    Unipuller Limited is dedicated to driving progress and delivering value-driven solutions.</p>
            </div>

            <div class="tab-pane fade" id="nav-statement" role="tabpanel" aria-labelledby="nav-statement-tab"
                tabindex="0">
                <h3 class="footer-details-title">Statement</h3>
                <p class="footer-details-content">At Unipuller Limited, our guiding statement is to "Empower Success
                    Through Innovation." We believe that innovation is the key to unlocking the potential for success in
                    today's rapidly evolving business landscape. We are committed to empowering our clients by providing
                    them with innovative solutions that enable them to stay ahead of the competition, adapt to changing
                    market dynamics, and achieve their business goals. We understand that every organization has unique
                    challenges and requirements, and we approach each project with a mindset of creativity and
                    problem-solving. By leveraging the latest technologies and our expertise, we strive to create
                    transformative solutions that drive growth, efficiency, and long-term success for our clients. With our
                    unwavering focus on innovation, Unipuller Limited is dedicated to being a catalyst for success in the
                    industries we serve.</p>
            </div>

            <div class="tab-pane fade" id="nav-sustainibility" role="tabpanel" aria-labelledby="nav-sustainibility-tab"
                tabindex="0">
                <h3 class="footer-details-title">Sustainability</h3>
                <p class="footer-details-content">
                    Sustainability is deeply ingrained in the values of Unipuller Limited. We understand the importance of
                    preserving our planet and are dedicated to making a positive impact on the environment, society, and
                    economy. Through the adoption of eco-friendly practices and the promotion of energy-efficient
                    technologies, we actively work to reduce our carbon footprint. We also prioritize sustainable
                    partnerships, collaborating with like-minded stakeholders to create a more responsible and inclusive
                    business ecosystem. In addition, we prioritize social sustainability by fostering a diverse and
                    inclusive workforce that promotes equality and respect. At Unipuller Limited, sustainability is not just
                    a buzzword; it is a fundamental principle that guides our actions and decisions, ensuring a better
                    future for generations to come.</p>
            </div>

            <div class="tab-pane fade" id="nav-unipuller-service" role="tabpanel"
                aria-labelledby="nav-unipuller-service-tab" tabindex="0">
                <h3 class="footer-details-title">Unipuller Service</h3>
                <p class="footer-details-content">Unipuller Limited offers a comprehensive range of services designed to
                    meet diverse client needs. Our expertise spans across various industries, enabling us to deliver
                    high-quality solutions. We specialize in advanced technological solutions, providing customized software
                    development, data analytics, and cloud computing services. Our consulting services offer strategic
                    guidance and implementation support, helping clients optimize operations and drive sustainable growth.
                    With a strong emphasis on project management, we ensure seamless execution and successful project
                    completion. Additionally, our dedicated support team provides prompt assistance and maintenance to
                    ensure uninterrupted operations. At Unipuller Limited, our goal is to be a trusted partner, delivering
                    exceptional services that empower our clients to succeed in their respective industries.</p>
            </div>

            {{-- ========================= Make Money ========================= --}}
            <div class="tab-pane fade show active {{ Route::is('footer.details.make.money') ? '' : 'd-none' }}"
                id="nav-sell-on-unipuller" role="tabpanel" aria-labelledby="nav-sell-on-unipuller-tab" tabindex="0">
                <h3 class="footer-details-title">Sell on unipuller</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-sell-on-unipuller-technology" role="tabpanel"
                aria-labelledby="nav-sell-on-unipuller-technology-tab" tabindex="0">
                <h3 class="footer-details-title">Sell on unipuller technology</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-associate-program" role="tabpanel"
                aria-labelledby="nav-associate-program-tab" tabindex="0">
                <h3 class="footer-details-title">Associate program</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-delivery-partner" role="tabpanel"
                aria-labelledby="nav-delivery-partner-tab" tabindex="0">
                <h3 class="footer-details-title">Delivery partner</h3>
                <p class="footer-details-content">Content</p>
            </div>

            {{-- ========================= Our Services ========================= --}}
            <div class="tab-pane fade show active {{ Route::is('footer.details.our.services') ? '' : 'd-none' }}"
                id="nav-advertising" role="tabpanel" aria-labelledby="nav-advertising-tab" tabindex="0">
                <h3 class="footer-details-title">Advertising</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-marketing" role="tabpanel" aria-labelledby="nav-marketing-tab"
                tabindex="0">
                <h3 class="footer-details-title">Marketing</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-website-development" role="tabpanel"
                aria-labelledby="nav-website-development-tab" tabindex="0">
                <h3 class="footer-details-title">Website Development</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-software-development" role="tabpanel"
                aria-labelledby="nav-software-development-tab" tabindex="0">
                <h3 class="footer-details-title">Software Development</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-seo" role="tabpanel" aria-labelledby="nav-seo-tab" tabindex="0">
                <h3 class="footer-details-title">SEO</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-video-production" role="tabpanel"
                aria-labelledby="nav-video-production-tab" tabindex="0">
                <h3 class="footer-details-title">Video Production</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-partner-boarding" role="tabpanel"
                aria-labelledby="nav-partner-boarding-tab" tabindex="0">
                <h3 class="footer-details-title">Partner Boarding</h3>
                <p class="footer-details-content">Content</p>
            </div>

            {{-- ========================= Quick Link ========================= --}}
            <div class="tab-pane fade show active {{ Route::is('footer.details.quick.links') ? '' : 'd-none' }}"
                id="nav-software" role="tabpanel" aria-labelledby="nav-software-tab" tabindex="0">
                <h3 class="footer-details-title">Software</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-domain-n-hosting" role="tabpanel"
                aria-labelledby="nav-domain-n-hosting-tab" tabindex="0">
                <h3 class="footer-details-title">Domain & Hosting</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-ready-websites" role="tabpanel" aria-labelledby="nav-ready-websites-tab"
                tabindex="0">
                <h3 class="footer-details-title">Ready Websites</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-form-generator" role="tabpanel" aria-labelledby="nav-form-generator-tab"
                tabindex="0">
                <h3 class="footer-details-title">Form Generator</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-qr-code-generator" role="tabpanel"
                aria-labelledby="nav-qr-code-generator-tab" tabindex="0">
                <h3 class="footer-details-title">QR Code Generator</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-content-creator" role="tabpanel"
                aria-labelledby="nav-content-creator-tab" tabindex="0">
                <h3 class="footer-details-title">Content Creator</h3>
                <p class="footer-details-content">Content</p>
            </div>

            {{-- ========================= Policies ========================= --}}
            <div class="tab-pane fade show active {{ Route::is('footer.details.policies') ? '' : 'd-none' }}"
                id="nav-privacy" role="tabpanel" aria-labelledby="nav-privacy-tab" tabindex="0">
                <h3 class="footer-details-title">Privacy</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-cookies" role="tabpanel" aria-labelledby="nav-cookies-tab"
                tabindex="0">
                <h3 class="footer-details-title">Cookies</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-condition-of-sale" role="tabpanel"
                aria-labelledby="nav-condition-of-sale-tab" tabindex="0">
                <h3 class="footer-details-title">Condition of sale</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-condition-of-use" role="tabpanel"
                aria-labelledby="nav-condition-of-use-tab" tabindex="0">
                <h3 class="footer-details-title">Condition of use</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-return-policies" role="tabpanel"
                aria-labelledby="nav-return-policies-tab" tabindex="0">
                <h3 class="footer-details-title">Return policies</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-refund-policies" role="tabpanel"
                aria-labelledby="nav-refund-policies-tab" tabindex="0">
                <h3 class="footer-details-title">Refund policies</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-seller-statement" role="tabpanel"
                aria-labelledby="nav-seller-statement-tab" tabindex="0">
                <h3 class="footer-details-title">Seller statement</h3>
                <p class="footer-details-content">Content</p>
            </div>

            <div class="tab-pane fade" id="nav-payment-terms" role="tabpanel" aria-labelledby="nav-payment-terms-tab"
                tabindex="0">
                <h3 class="footer-details-title">Payment terms</h3>
                <p class="footer-details-content">Content</p>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
