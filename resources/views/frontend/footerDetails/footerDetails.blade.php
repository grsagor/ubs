@include('frontend.footerDetails.partial.style')

@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        .mobile_tab {
            display: none;
        }

        @media (max-width: 767px) {
            .laptop_view {
                display: none !important;
            }

            .mobile_tab {
                display: block;
                /* or display: inline; depending on your layout */
            }

            .footer-details-container {
                display: grid;
                grid-template-columns: auto;
                gap: 0px;
                padding: 0 3px;
                margin-top: 3px;

            }

            .footer-details-content {
                padding: 10px !important;
                border: 1px solid #ddd;
            }

            .mv {
                margin: 0rem !important;
                padding: 0px !important;
            }
        }
    </style>
@endsection

@section('content')
    @includeIf('frontend.partials.global.common-header')
    <div class="footer-details-container">








        <div class="footer-details-sidebar nav nav-tabs flex-column laptop_view" id="nav-tab" role="tablist">

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
            <ul class="mt-3 laptop_view">
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
            @include('frontend.footerDetails.about-us.aboutUs')

            {{-- ========================= Make Money ========================= --}}
            @include('frontend.footerDetails.make-money.makeMoney')

            {{-- ========================= Our Services ========================= --}}
            @include('frontend.footerDetails.our-services.ourServices')

            {{-- ========================= Quick Link ========================= --}}
            @include('frontend.footerDetails.quick-link.quickLink')

            {{-- ========================= Policies ========================= --}}
            @include('frontend.footerDetails.policies.policies')

        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
