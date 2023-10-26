@extends('frontend.layouts.master_layout')
@section('css')
    <style>
        p,
        li {
            color: black;
            text-align: justify;
        }

        .font-black {
            color: black;
        }

        .margin_left_45 {
            margin-left: 45px;
        }

        .sub-details li {
            font-size: 15px;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">

            <div class="welcome">
                <p style="font-size: 16px;" class="fw-bold">
                    Unipuller, as a dedicated management consultancy firm, is committed to simplifying the landlord-tenant
                    connection process. We understand the unique needs of landlords and are devoted to making your
                    experience as seamless and stress-free as possible. Here's an in-depth look at the comprehensive
                    services that make Unipuller the ideal choice for landlords like you:

                </p>
            </div>

            <div class="why_choose_uit mt-4">
                <h4 class="fw-bold">
                    Service Introduction
                </h4>
                <div class="details">
                    <div class="margin_left_45">
                        <p>
                            <b>Free Tenant Referral Services:</b> Our complimentary tenant referral services are designed to
                            connect
                            you with potential tenants who are a perfect fit for your property. We understand
                            the importance of finding the right tenants to maintain the integrity of your
                            property.
                        </p>
                        <p>
                            <b>No Fees, No Hassles:</b> Unipuller never imposes any fees on landlords. Your property is your
                            priority, and we ensure you can focus on it without any financial burden.
                        </p>
                        <p>
                            <b>Respect for Privacy:</b> We hold your privacy and specific requirements in the highest
                            regard. Your needs are
                            central to our mission, and we handle them with the utmost care and confidentiality.
                        </p>

                    </div>

                </div>
            </div>

            <div class="why_choose_uit mt-4">
                <h4 class="fw-bold">
                    Complementary Services for a Seamless Experience
                </h4>
                <div class="details">
                    <div class="margin_left_45">
                        <p>
                            <b>Viewings Arrangements</b> We can seamlessly organize property viewings at no cost to you.
                            This convenience
                            ensures that potential tenants can easily explore your property.
                        </p>
                        <p>
                            <b>Online Property Advertising:</b> Your property will receive prominent visibility on our
                            website. This online presence
                            makes it effortless for potential tenants to discover and book viewings, increasing
                            your property's exposure.
                        </p>
                        <p>
                            <b>Emailing Booking Information:</b> Unipuller provides complete booking information directly to
                            your email. This keeps
                            you informed at all times and simplifies communication with potential tenants.
                        </p>
                        <p>
                            <b>Incentives for Landlords:</b> When you entrust Unipuller to manage the entire rental process,
                            you'll receive
                            financial incentives ranging from £50 to £300. It's our way of showing appreciation
                            for your trust in our services.
                        </p>
                    </div>
                </div>
            </div>


            <div class="discover mt-4">
                <h5 class="fw-bold"> Additional Partner Referral Services</h5>
                <p>
                    &nbsp; &nbsp; &nbsp;In addition to our core services, Unipuller offers a range of partner referral
                    services to cater to your diverse needs
                </p>
                <div class="details">
                    <div class="mt-2">
                        <div class="font-black margin_left_45">
                            <b>1. Guaranteed Rent to Rent Service</b>
                            <div class="sub-details mt-1 margin_left_45">
                                <ul>
                                    <li class="mt-1">
                                        This service offers you financial stability and peace of mind, allowing you to relax
                                        while your property is occupied.
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="font-black margin_left_45 mt-2">
                            <b>2. Property Management Services</b>
                            <div class="sub-details mt-1 margin_left_45">
                                <ul>
                                    <li class="mt-1">
                                        We take on property management responsibilities, ensuring your property is
                                        well-maintained and cared for, reducing your stress.
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="font-black margin_left_45 mt-2">
                            <b>3. Mortgage Service</b>
                            <div class="sub-details mt-1 margin_left_45">
                                <ul>
                                    <li class="mt-1">
                                        Our mortgage service options simplify any financing needs related to your property,
                                        making the process hassle-free.

                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="font-black margin_left_45 mt-2">
                            <b>4. Buy & Sell Services</b>
                            <div class="sub-details mt-1 margin_left_45">
                                <ul>
                                    <li class="mt-1">
                                        Whether you're considering expanding your property portfolio or selling a property,
                                        our expertise and efficiency will guide you through the entire process.
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p class="mt-3">
                            &nbsp; &nbsp; &nbsp; At Unipuller, we eagerly await the opportunity to work closely with you. We
                            are committed to
                            customizing our services to precisely match your specific needs, ensuring a rental process that
                            flows seamlessly and effortlessly. Your satisfaction is our priority, and we're here to support
                            you every step of the way. Choose Unipuller as your trusted partner in the landlord-tenant
                            connection process.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
