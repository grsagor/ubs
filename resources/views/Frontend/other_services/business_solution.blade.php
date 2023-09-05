@extends('frontend.layouts.master_layout')

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">
            <h3 class="heading ">Business solutions:</h3>
            <p class="heading-details">Business solution is one of the great services that Unipuller is committed to provide.
                Sourcing raw
                materials, production, operations, marketing, sales, and so on are main parts of a businesses. A business
                needs to involve in all areas to become an independent and successful company. All those areas are very
                different in their nature and activities which all takes different skills and investments.
                To meet all those complexities and problems, Unipuller is working rigorously to bring a sustainable
                business system. Unipuller has introduced a unique and exceptional marketing and sales model which will
                give businesses ease of operations. In Unipuller’s business solutions, businesses do not need to focus on
                sales and marketing anymore. In our business solution sales and marketing are automated. Now
                businesses just need to fucus on their product development, production and operation system. Unipuller
                will sale their products and do marketing all over countries with free of cost.</p>

            <div class="row">
                <div class="col-md-7 m-auto text-center">
                    <p> Join us with our business solution to get an automated-
                        sales and marketing solutions.</p>
                    <a href="{{ route('login') }}" target="__blank">Click here</a>
                </div>
                <div class="col-md-5 mt-5">
                    <img src="{{ asset('assets/frontend/business-solutions.png') }}" alt="digital-marketing.png"
                        style="width: 100%">
                </div>
            </div>
        </div>

        <div class="body m-3 p-3">
            <h6 class="body-heading ">Facilities in Business solution:</h6>
            <ol>
                <li> Automated sales </li>
                <li> Automated marketing </li>
                <li> 24/7 customer service </li>
                <li> Free business management technology </li>
                <li> Free partner boarding solution </li>
                <li> Free sales agent sourcing </li>
                <li> Free partnership management dashboard </li>
                <li> Free CRM and Project management solution </li>
                <li> Free HRM and recruitment solution </li>
                <li> No extra costs </li>
                <li> Pay after only if you sold </li>
                <li> Full business control </li>
                <li> Fast business growth system </li>
            </ol>

            <h6 class="body-footer ">Business is nothing rather than managing it perfectly. A secured sales and
                marketing are main factors for a successful company. Join us and start selling instantly. No need to worry
                abut all those technology, sales, and marketing. We are here ready to go----</h6>
            <div class="footer-img mb-3 text-center">
                <img src="{{ asset('assets/frontend/business-solutions2.png') }}" alt="" style="width: 35%">
            </div>
        </div>
    </div>
@endsection
