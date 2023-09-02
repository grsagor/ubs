@extends('frontend.layouts.master_layout')

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">
            <h3 class="heading ">Partner boarding: </h3>
            <p class="heading-details">Partnering with other businesses and joining with more sales agent becomes most easier
                work with
                Unipuller. Partnership and boarding more sales agents are not hard task anymore. Hundreds of sales
                agents can join you instantly if you just simply have products and services.</p>

            <div class="row">
                <div class="col-md-7 m-auto text-center">
                    <p> Join as partner </p>
                    <a href="{{ route('login') }}" target="__blank">Click here</a>
                </div>
                <div class="col-md-5 mt-5">
                    <img src="{{ asset('assets/frontend/partner-boarding.png') }}" alt="digital-marketing.png"
                        style="width: 100%">
                </div>
            </div>
        </div>

        <div class="body m-3 p-3">
            <h6 class="body-heading ">Join as sales agent :</h6>

            <h6 class="body-footer mb-5">To be sales agent you just need to join with Unipuller. Contacting with companies,
                doing negotiations
                and making agreement for partnership is obsolete in Unipuller. With us, you just choose your preferred
                company and click on join button. Instantly you’ll become sales partner of that company while Unipuller
                will maintain all the process on behalf of you</h6>

        </div>
    </div>
@endsection
