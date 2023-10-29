@extends('frontend.layouts.master_layout')

@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="container">
        <div class="header m-3 p-3">
            <h3 class="heading ">IT solutions:</h3>
            <p class="heading-details">Information and technology service that being provided by Unipuller is a part of its
                wide range consultancy
                business. Unipuller is providing all types of supports that a business needed. B2B is more sophisticated
                and special to manage its operations. Advanced technology to manage divergent industries taking place
                to a new era where advance Knowledge playing a key role in developing advanced technology for the
                future of businesses. In many cases, business demands are different from industry to industry. The
                complexity of businesses demanding higher technological solution. To adopt with the changing needs of
                businesses, and to meet with the advance technology requirements, unipuller is committed to bring new
                technologies through its informational and technology services. From data mining to big data, software
                architecture to software development, Unipuller providing cutting edge solutions. Unipuller offers is very
                user friendly and affordable solutions for all stakeholders. Unipuller develops software by its brilliant
                developing teams. Unipuller also giving options to other developers in selling their ready-made and read
                to use software through its marketplace. To see all ready made and ready to use softwires visit our
                software category.
            </p>

            <div class="row">
                <div class="col-md-6 m-auto">

                    <h6 class="body-heading" style="margin-left: 220px;">Benefits of ready-made software:</h6>
                    <ol style="margin-left: 220px;">
                        <li> Cost saving </li>
                        <li> Time saving </li>
                        <li> 24/7 days supports </li>
                        <li> Testified software </li>
                        <li> Error free software </li>
                        <li> Ease of use </li>
                    </ol>
                    <a href="https://shop.unipuller.com/" target="__blank" style="margin-left: 251px;">Click here</a>
                </div>
                <div class="col-md-6 mt-5">
                    <img src="{{ asset('assets/frontend/it-solutions.png') }}" alt="digital-marketing.png"
                        style="width: 75%">
                </div>
            </div>
        </div>

        <div class="body m-3 p-3">


            <h6 class="body-footer ">Industry to industry, business to business policy, strategy and operation always
                varies. To bring the right
                solution industries and businesses most frequently chose to make their custom softwires. Our developing
                teams are divergent in perspective of their knowledge, culture, and skills to bring right solutions for
                right
                industry. To meet our IT developing team click below, they will bring your required solutions withing your
                limits meeting right quality and quantity.
            </h6>


            <div class="row">
                <div class="col-md-6 m-auto">

                    <h6 class="body-heading" style="margin-left: 220px;">Benefits of custom software:</h6>
                    <ol style="margin-left: 220px;">
                        <li> Meets required features </li>
                        <li> Unique codes </li>
                        <li> Unique design </li>
                        <li> Easy to control </li>
                        <li> Best output </li>
                        <li> Industry friendly </li>
                    </ol>
                    <!-- This link forwarded to Contact us page -->
                    <a href="" target="__blank" style="margin-left: 251px;">Click here</a>
                </div>
                <div class="col-md-6 mt-5">
                    <img src="{{ asset('assets/frontend/it-solutions2.jpg') }}" alt="digital-marketing.png"
                        style="width: 75%">
                </div>
            </div>



        </div>
    </div>
@endsection
