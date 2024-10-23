@extends('frontend.layouts.master_layout')
@section('title', 'Checkout - ')
@section('css')
    <style>
        .print_section {
            display: none;
        }

        .invoice {
            position: relative;
            background: #fff;
            border: 1px solid #f4f4f4;
            padding: 20px;
            margin: 10px 25px;
        }

        #card-element {
            background-color: #fff;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        /* Additional styles for input fields */
        input[type="text"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        @media print {

            #page_wrapper> :not(.print_section),
            footer,
            #toast-container {
                display: none;
            }

            .print_section {
                display: block;
            }
        }

        .acceepted_cards_container {
            display: flex;
            margin-bottom: 20px;
        }

        .acceepted_cards_container img {
            width: 50px;
            height: 20px;
            object-fit: cover;
        }

        #stripeModal,
        #stripeModal .modal-title,
        #stripeModal .stripe-proceed-btn {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif !important;
        }

        /* .StripeElement>div>iframe {
                                height: 32px !important;
                            } */

        .stripe-element-container {
            padding: 4px;
            margin-bottom: 8px;
            border: 1px solid gray;
            border-radius: 8px;
        }

        button.btn.btn-primary.stripe-proceed-btn {
            background: #00afe1;
            font-size: 18px;
            width: 100%;
        }

        .stripe-proceed-btn:hover,
        .stripe-proceed-btn:active {
            background: #0183a9 !important;
            color: #fff !important;
            border: none !important;
        }

        #stripe-error-container {
            color: red;
        }

        .stripe_checkbox_container {
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 14px;
        }

        .stripe_checkbox_container label {
            width: fit-content;
        }

        #open_stripe_modal--btn {
            background: #00afe1;
        }

        #open_stripe_modal--btn:hover {
            color: #fff !important;
            background: #0183a9 !important;
            border: none !important;
        }

        /* #payment_animation_container {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: #EBEBEB;
                    z-index: 99999999;
                } */

        #payment_animation_container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        /* #payment_success_container {
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: #EBEBEB;
                    z-index: 999999999;
                } */

        #payment_success_container .modal-body {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-size: 84px;
            padding: 36px;
        }

        #payment_thanks_container .modal-body {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 36px;
        }

        #payment_thanks_container .btn {
            background: #7abad3 !important;
            color: white !important;
        }

        #payment_thanks_container .btn:hover {
            background: #61a0b9 !important;
            color: white !important;
        }

        #payment_thanks_container .btn {
            width: 130px !important;
        }

        .last_back_btn {
            padding: 0 25px;
            line-height: 45px;
        }

        .btn-primary:hover {
            border: none !important;
        }

        .swal2-title {
            font-size: 16px !important;
        }
    </style>
@endsection
@section('content')
    @includeIf('frontend.partials.global.common-header')

    <div class="load_cart content no-print">
        <section class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="checkout-area mb-0 pb-0">
                            <div class="checkout-process">
                                <ul class="nav" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-step1-tab" data-toggle="pill"
                                            href="#pills-step1" role="tab" aria-controls="pills-step1"
                                            aria-selected="true">
                                            <span>1</span> Address
                                            <i class="far fa-address-card"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="pills-step2-tab" data-toggle="pill"
                                            href="#pills-step2" role="tab" aria-controls="pills-step2"
                                            aria-selected="false">
                                            <span>2</span> Orders
                                            <i class="fas fa-dolly"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link disabled" id="pills-step3-tab" data-toggle="pill"
                                            href="#pills-step3" role="tab" aria-controls="pills-step3"
                                            aria-selected="false">
                                            <span>3</span> Payment
                                            <i class="far fa-credit-card"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <form class="checkoutform" id="checkout_form">
                            @csrf
                            <div class="checkout-area">
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-step1" role="tabpanel"
                                        aria-labelledby="pills-step1-tab">
                                        <div class="content-box">
                                            <div class="content">
                                                <div class="submit-loader" style="display: none;">
                                                    <img src="//geniusocean.com/demo/geniuscart/default/assets/images/loading_large.gif"
                                                        alt="">
                                                </div>
                                                <div class="billing-address">
                                                    <h5 class="title">
                                                        Billing Details
                                                    </h5>
                                                    <div class="row">

                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="customer_name"
                                                                placeholder="Full Name" required="" value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="customer_email"
                                                                placeholder="Email" required="" value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="customer_phone"
                                                                placeholder="Phone Number" required="" value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text"
                                                                name="customer_address" placeholder="Address" required=""
                                                                value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="customer_city"
                                                                placeholder="City" required="" value="">
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="customer_zip"
                                                                placeholder="Postal Code" required="" value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <select class="form-control" id="select_country"
                                                                name="customer_country" required="">
                                                                <option value="" disabled="" selected="">
                                                                    Select Country</option>
                                                                <option value="Afghanistan" data="1" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/1">
                                                                    Afghanistan</option>
                                                                <option value="Albania" data="2" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/2">
                                                                    Albania</option>
                                                                <option value="Algeria" data="3" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/3">
                                                                    Algeria</option>
                                                                <option value="American Samoa" data="4"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/4">
                                                                    American Samoa</option>
                                                                <option value="Andorra" data="5" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/5">
                                                                    Andorra</option>
                                                                <option value="Angola" data="6" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/6">
                                                                    Angola</option>
                                                                <option value="Anguilla" data="7" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/7">
                                                                    Anguilla</option>
                                                                <option value="Antarctica" data="8" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/8">
                                                                    Antarctica</option>
                                                                <option value="Antigua and Barbuda" data="9"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/9">
                                                                    Antigua and Barbuda</option>
                                                                <option value="Argentina" data="10" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/10">
                                                                    Argentina</option>
                                                                <option value="Armenia" data="11" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/11">
                                                                    Armenia</option>
                                                                <option value="Aruba" data="12" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/12">
                                                                    Aruba</option>
                                                                <option value="Australia" data="13" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/13">
                                                                    Australia</option>
                                                                <option value="Austria" data="14" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/14">
                                                                    Austria</option>
                                                                <option value="Azerbaijan" data="15" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/15">
                                                                    Azerbaijan</option>
                                                                <option value="Bahamas" data="16" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/16">
                                                                    Bahamas</option>
                                                                <option value="Bahrain" data="17" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/17">
                                                                    Bahrain</option>
                                                                <option value="Bangladesh" data="18" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/18">
                                                                    Bangladesh</option>
                                                                <option value="Barbados" data="19" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/19">
                                                                    Barbados</option>
                                                                <option value="Belarus" data="20" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/20">
                                                                    Belarus</option>
                                                                <option value="Belgium" data="21" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/21">
                                                                    Belgium</option>
                                                                <option value="Belize" data="22" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/22">
                                                                    Belize</option>
                                                                <option value="Benin" data="23" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/23">
                                                                    Benin</option>
                                                                <option value="Bermuda" data="24" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/24">
                                                                    Bermuda</option>
                                                                <option value="Bhutan" data="25" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/25">
                                                                    Bhutan</option>
                                                                <option value="Bolivia" data="26" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/26">
                                                                    Bolivia</option>
                                                                <option value="Bosnia and Herzegovina" data="27"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/27">
                                                                    Bosnia and Herzegovina</option>
                                                                <option value="Botswana" data="28" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/28">
                                                                    Botswana</option>
                                                                <option value="Bouvet Island" data="29"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/29">
                                                                    Bouvet Island</option>
                                                                <option value="Brazil" data="30" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/30">
                                                                    Brazil</option>
                                                                <option value="British Indian Ocean Territory"
                                                                    data="31" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/31">
                                                                    British Indian Ocean Territory</option>
                                                                <option value="Brunei Darussalam" data="32"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/32">
                                                                    Brunei Darussalam</option>
                                                                <option value="Bulgaria" data="33" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/33">
                                                                    Bulgaria</option>
                                                                <option value="Burkina Faso" data="34"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/34">
                                                                    Burkina Faso</option>
                                                                <option value="Burundi" data="35" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/35">
                                                                    Burundi</option>
                                                                <option value="Cambodia" data="36" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/36">
                                                                    Cambodia</option>
                                                                <option value="Cameroon" data="37" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/37">
                                                                    Cameroon</option>
                                                                <option value="Canada" data="38" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/38">
                                                                    Canada</option>
                                                                <option value="Cape Verde" data="39" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/39">
                                                                    Cape Verde</option>
                                                                <option value="Cayman Islands" data="40"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/40">
                                                                    Cayman Islands</option>
                                                                <option value="Central African Republic" data="41"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/41">
                                                                    Central African Republic</option>
                                                                <option value="Chad" data="42" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/42">
                                                                    Chad</option>
                                                                <option value="Chile" data="43" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/43">
                                                                    Chile</option>
                                                                <option value="China" data="44" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/44">
                                                                    China</option>
                                                                <option value="Christmas Island" data="45"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/45">
                                                                    Christmas Island</option>
                                                                <option value="Cocos (Keeling) Islands" data="46"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/46">
                                                                    Cocos (Keeling) Islands</option>
                                                                <option value="Colombia" data="47" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/47">
                                                                    Colombia</option>
                                                                <option value="Comoros" data="48" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/48">
                                                                    Comoros</option>
                                                                <option value="Democratic Republic of the Congo"
                                                                    data="49" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/49">
                                                                    Democratic Republic of the Congo</option>
                                                                <option value="Republic of Congo" data="50"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/50">
                                                                    Republic of Congo</option>
                                                                <option value="Cook Islands" data="51"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/51">
                                                                    Cook Islands</option>
                                                                <option value="Costa Rica" data="52" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/52">
                                                                    Costa Rica</option>
                                                                <option value="Croatia (Hrvatska)" data="53"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/53">
                                                                    Croatia (Hrvatska)</option>
                                                                <option value="Cuba" data="54" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/54">
                                                                    Cuba</option>
                                                                <option value="Cyprus" data="55" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/55">
                                                                    Cyprus</option>
                                                                <option value="Czech Republic" data="56"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/56">
                                                                    Czech Republic</option>
                                                                <option value="Denmark" data="57" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/57">
                                                                    Denmark</option>
                                                                <option value="Djibouti" data="58" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/58">
                                                                    Djibouti</option>
                                                                <option value="Dominica" data="59" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/59">
                                                                    Dominica</option>
                                                                <option value="Dominican Republic" data="60"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/60">
                                                                    Dominican Republic</option>
                                                                <option value="East Timor" data="61" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/61">
                                                                    East Timor</option>
                                                                <option value="Ecuador" data="62" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/62">
                                                                    Ecuador</option>
                                                                <option value="Egypt" data="63" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/63">
                                                                    Egypt</option>
                                                                <option value="El Salvador" data="64" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/64">
                                                                    El Salvador</option>
                                                                <option value="Equatorial Guinea" data="65"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/65">
                                                                    Equatorial Guinea</option>
                                                                <option value="Eritrea" data="66" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/66">
                                                                    Eritrea</option>
                                                                <option value="Estonia" data="67" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/67">
                                                                    Estonia</option>
                                                                <option value="Ethiopia" data="68" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/68">
                                                                    Ethiopia</option>
                                                                <option value="Falkland Islands (Malvinas)" data="69"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/69">
                                                                    Falkland Islands (Malvinas)</option>
                                                                <option value="Faroe Islands" data="70"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/70">
                                                                    Faroe Islands</option>
                                                                <option value="Fiji" data="71" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/71">
                                                                    Fiji</option>
                                                                <option value="Finland" data="72" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/72">
                                                                    Finland</option>
                                                                <option value="France" data="73" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/73">
                                                                    France</option>
                                                                <option value="France, Metropolitan" data="74"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/74">
                                                                    France, Metropolitan</option>
                                                                <option value="French Guiana" data="75"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/75">
                                                                    French Guiana</option>
                                                                <option value="French Polynesia" data="76"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/76">
                                                                    French Polynesia</option>
                                                                <option value="French Southern Territories" data="77"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/77">
                                                                    French Southern Territories</option>
                                                                <option value="Gabon" data="78" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/78">
                                                                    Gabon</option>
                                                                <option value="Gambia" data="79" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/79">
                                                                    Gambia</option>
                                                                <option value="Georgia" data="80" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/80">
                                                                    Georgia</option>
                                                                <option value="Germany" data="81" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/81">
                                                                    Germany</option>
                                                                <option value="Ghana" data="82" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/82">
                                                                    Ghana</option>
                                                                <option value="Gibraltar" data="83" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/83">
                                                                    Gibraltar</option>
                                                                <option value="Guernsey" data="84" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/84">
                                                                    Guernsey</option>
                                                                <option value="Greece" data="85" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/85">
                                                                    Greece</option>
                                                                <option value="Greenland" data="86" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/86">
                                                                    Greenland</option>
                                                                <option value="Grenada" data="87" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/87">
                                                                    Grenada</option>
                                                                <option value="Guadeloupe" data="88" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/88">
                                                                    Guadeloupe</option>
                                                                <option value="Guam" data="89" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/89">
                                                                    Guam</option>
                                                                <option value="Guatemala" data="90" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/90">
                                                                    Guatemala</option>
                                                                <option value="Guinea" data="91" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/91">
                                                                    Guinea</option>
                                                                <option value="Guinea-Bissau" data="92"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/92">
                                                                    Guinea-Bissau</option>
                                                                <option value="Guyana" data="93" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/93">
                                                                    Guyana</option>
                                                                <option value="Haiti" data="94" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/94">
                                                                    Haiti</option>
                                                                <option value="Heard and Mc Donald Islands" data="95"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/95">
                                                                    Heard and Mc Donald Islands</option>
                                                                <option value="Honduras" data="96" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/96">
                                                                    Honduras</option>
                                                                <option value="Hong Kong" data="97" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/97">
                                                                    Hong Kong</option>
                                                                <option value="Hungary" data="98" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/98">
                                                                    Hungary</option>
                                                                <option value="Iceland" data="99" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/99">
                                                                    Iceland</option>
                                                                <option value="India" data="100" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/100">
                                                                    India</option>
                                                                <option value="Isle of Man" data="101" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/101">
                                                                    Isle of Man</option>
                                                                <option value="Indonesia" data="102" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/102">
                                                                    Indonesia</option>
                                                                <option value="Iran (Islamic Republic of)" data="103"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/103">
                                                                    Iran (Islamic Republic of)</option>
                                                                <option value="Iraq" data="104" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/104">
                                                                    Iraq</option>
                                                                <option value="Ireland" data="105" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/105">
                                                                    Ireland</option>
                                                                <option value="Israel" data="106" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/106">
                                                                    Israel</option>
                                                                <option value="Italy" data="107" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/107">
                                                                    Italy</option>
                                                                <option value="Ivory Coast" data="108" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/108">
                                                                    Ivory Coast</option>
                                                                <option value="Jersey" data="109" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/109">
                                                                    Jersey</option>
                                                                <option value="Jamaica" data="110" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/110">
                                                                    Jamaica</option>
                                                                <option value="Japan" data="111" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/111">
                                                                    Japan</option>
                                                                <option value="Jordan" data="112" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/112">
                                                                    Jordan</option>
                                                                <option value="Kazakhstan" data="113" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/113">
                                                                    Kazakhstan</option>
                                                                <option value="Kenya" data="114" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/114">
                                                                    Kenya</option>
                                                                <option value="Kiribati" data="115" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/115">
                                                                    Kiribati</option>
                                                                <option value="Korea, Democratic People's Republic of"
                                                                    data="116" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/116">
                                                                    Korea, Democratic People's Republic of</option>
                                                                <option value="Korea, Republic of" data="117"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/117">
                                                                    Korea, Republic of</option>
                                                                <option value="Kosovo" data="118" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/118">
                                                                    Kosovo</option>
                                                                <option value="Kuwait" data="119" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/119">
                                                                    Kuwait</option>
                                                                <option value="Kyrgyzstan" data="120" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/120">
                                                                    Kyrgyzstan</option>
                                                                <option value="Lao People's Democratic Republic"
                                                                    data="121" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/121">
                                                                    Lao People's Democratic Republic</option>
                                                                <option value="Latvia" data="122" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/122">
                                                                    Latvia</option>
                                                                <option value="Lebanon" data="123" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/123">
                                                                    Lebanon</option>
                                                                <option value="Lesotho" data="124" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/124">
                                                                    Lesotho</option>
                                                                <option value="Liberia" data="125" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/125">
                                                                    Liberia</option>
                                                                <option value="Libyan Arab Jamahiriya" data="126"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/126">
                                                                    Libyan Arab Jamahiriya</option>
                                                                <option value="Liechtenstein" data="127"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/127">
                                                                    Liechtenstein</option>
                                                                <option value="Lithuania" data="128" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/128">
                                                                    Lithuania</option>
                                                                <option value="Luxembourg" data="129"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/129">
                                                                    Luxembourg</option>
                                                                <option value="Macau" data="130" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/130">
                                                                    Macau</option>
                                                                <option value="North Macedonia" data="131"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/131">
                                                                    North Macedonia</option>
                                                                <option value="Madagascar" data="132"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/132">
                                                                    Madagascar</option>
                                                                <option value="Malawi" data="133" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/133">
                                                                    Malawi</option>
                                                                <option value="Malaysia" data="134" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/134">
                                                                    Malaysia</option>
                                                                <option value="Maldives" data="135" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/135">
                                                                    Maldives</option>
                                                                <option value="Mali" data="136" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/136">
                                                                    Mali</option>
                                                                <option value="Malta" data="137" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/137">
                                                                    Malta</option>
                                                                <option value="Marshall Islands" data="138"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/138">
                                                                    Marshall Islands</option>
                                                                <option value="Martinique" data="139"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/139">
                                                                    Martinique</option>
                                                                <option value="Mauritania" data="140"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/140">
                                                                    Mauritania</option>
                                                                <option value="Mauritius" data="141"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/141">
                                                                    Mauritius</option>
                                                                <option value="Mayotte" data="142" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/142">
                                                                    Mayotte</option>
                                                                <option value="Mexico" data="143" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/143">
                                                                    Mexico</option>
                                                                <option value="Micronesia, Federated States of"
                                                                    data="144" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/144">
                                                                    Micronesia, Federated States of</option>
                                                                <option value="Moldova, Republic of" data="145"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/145">
                                                                    Moldova, Republic of</option>
                                                                <option value="Monaco" data="146" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/146">
                                                                    Monaco</option>
                                                                <option value="Mongolia" data="147" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/147">
                                                                    Mongolia</option>
                                                                <option value="Montenegro" data="148"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/148">
                                                                    Montenegro</option>
                                                                <option value="Montserrat" data="149"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/149">
                                                                    Montserrat</option>
                                                                <option value="Morocco" data="150" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/150">
                                                                    Morocco</option>
                                                                <option value="Mozambique" data="151"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/151">
                                                                    Mozambique</option>
                                                                <option value="Myanmar" data="152" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/152">
                                                                    Myanmar</option>
                                                                <option value="Namibia" data="153" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/153">
                                                                    Namibia</option>
                                                                <option value="Nauru" data="154" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/154">
                                                                    Nauru</option>
                                                                <option value="Nepal" data="155" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/155">
                                                                    Nepal</option>
                                                                <option value="Netherlands" data="156"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/156">
                                                                    Netherlands</option>
                                                                <option value="Netherlands Antilles" data="157"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/157">
                                                                    Netherlands Antilles</option>
                                                                <option value="New Caledonia" data="158"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/158">
                                                                    New Caledonia</option>
                                                                <option value="New Zealand" data="159"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/159">
                                                                    New Zealand</option>
                                                                <option value="Nicaragua" data="160"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/160">
                                                                    Nicaragua</option>
                                                                <option value="Niger" data="161" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/161">
                                                                    Niger</option>
                                                                <option value="Nigeria" data="162" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/162">
                                                                    Nigeria</option>
                                                                <option value="Niue" data="163" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/163">
                                                                    Niue</option>
                                                                <option value="Norfolk Island" data="164"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/164">
                                                                    Norfolk Island</option>
                                                                <option value="Northern Mariana Islands" data="165"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/165">
                                                                    Northern Mariana Islands</option>
                                                                <option value="Norway" data="166" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/166">
                                                                    Norway</option>
                                                                <option value="Oman" data="167" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/167">
                                                                    Oman</option>
                                                                <option value="Pakistan" data="168" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/168">
                                                                    Pakistan</option>
                                                                <option value="Palau" data="169" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/169">
                                                                    Palau</option>
                                                                <option value="Palestine" data="170"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/170">
                                                                    Palestine</option>
                                                                <option value="Panama" data="171" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/171">
                                                                    Panama</option>
                                                                <option value="Papua New Guinea" data="172"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/172">
                                                                    Papua New Guinea</option>
                                                                <option value="Paraguay" data="173" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/173">
                                                                    Paraguay</option>
                                                                <option value="Peru" data="174" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/174">
                                                                    Peru</option>
                                                                <option value="Philippines" data="175"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/175">
                                                                    Philippines</option>
                                                                <option value="Pitcairn" data="176" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/176">
                                                                    Pitcairn</option>
                                                                <option value="Poland" data="177" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/177">
                                                                    Poland</option>
                                                                <option value="Portugal" data="178" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/178">
                                                                    Portugal</option>
                                                                <option value="Puerto Rico" data="179"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/179">
                                                                    Puerto Rico</option>
                                                                <option value="Qatar" data="180" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/180">
                                                                    Qatar</option>
                                                                <option value="Reunion" data="181" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/181">
                                                                    Reunion</option>
                                                                <option value="Romania" data="182" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/182">
                                                                    Romania</option>
                                                                <option value="Russian Federation" data="183"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/183">
                                                                    Russian Federation</option>
                                                                <option value="Rwanda" data="184" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/184">
                                                                    Rwanda</option>
                                                                <option value="Saint Kitts and Nevis" data="185"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/185">
                                                                    Saint Kitts and Nevis</option>
                                                                <option value="Saint Lucia" data="186"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/186">
                                                                    Saint Lucia</option>
                                                                <option value="Saint Vincent and the Grenadines"
                                                                    data="187" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/187">
                                                                    Saint Vincent and the Grenadines</option>
                                                                <option value="Samoa" data="188" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/188">
                                                                    Samoa</option>
                                                                <option value="San Marino" data="189"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/189">
                                                                    San Marino</option>
                                                                <option value="Sao Tome and Principe" data="190"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/190">
                                                                    Sao Tome and Principe</option>
                                                                <option value="Saudi Arabia" data="191"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/191">
                                                                    Saudi Arabia</option>
                                                                <option value="Senegal" data="192" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/192">
                                                                    Senegal</option>
                                                                <option value="Serbia" data="193" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/193">
                                                                    Serbia</option>
                                                                <option value="Seychelles" data="194"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/194">
                                                                    Seychelles</option>
                                                                <option value="Sierra Leone" data="195"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/195">
                                                                    Sierra Leone</option>
                                                                <option value="Singapore" data="196"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/196">
                                                                    Singapore</option>
                                                                <option value="Slovakia" data="197" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/197">
                                                                    Slovakia</option>
                                                                <option value="Slovenia" data="198" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/198">
                                                                    Slovenia</option>
                                                                <option value="Solomon Islands" data="199"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/199">
                                                                    Solomon Islands</option>
                                                                <option value="Somalia" data="200" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/200">
                                                                    Somalia</option>
                                                                <option value="South Africa" data="201"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/201">
                                                                    South Africa</option>
                                                                <option value="South Georgia South Sandwich Islands"
                                                                    data="202" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/202">
                                                                    South Georgia South Sandwich Islands</option>
                                                                <option value="South Sudan" data="203"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/203">
                                                                    South Sudan</option>
                                                                <option value="Spain" data="204" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/204">
                                                                    Spain</option>
                                                                <option value="Sri Lanka" data="205"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/205">
                                                                    Sri Lanka</option>
                                                                <option value="St. Helena" data="206"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/206">
                                                                    St. Helena</option>
                                                                <option value="St. Pierre and Miquelon" data="207"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/207">
                                                                    St. Pierre and Miquelon</option>
                                                                <option value="Sudan" data="208" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/208">
                                                                    Sudan</option>
                                                                <option value="Suriname" data="209" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/209">
                                                                    Suriname</option>
                                                                <option value="Svalbard and Jan Mayen Islands"
                                                                    data="210" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/210">
                                                                    Svalbard and Jan Mayen Islands</option>
                                                                <option value="Swaziland" data="211"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/211">
                                                                    Swaziland</option>
                                                                <option value="Sweden" data="212" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/212">
                                                                    Sweden</option>
                                                                <option value="Switzerland" data="213"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/213">
                                                                    Switzerland</option>
                                                                <option value="Syrian Arab Republic" data="214"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/214">
                                                                    Syrian Arab Republic</option>
                                                                <option value="Taiwan" data="215" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/215">
                                                                    Taiwan</option>
                                                                <option value="Tajikistan" data="216"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/216">
                                                                    Tajikistan</option>
                                                                <option value="Tanzania, United Republic of"
                                                                    data="217" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/217">
                                                                    Tanzania, United Republic of</option>
                                                                <option value="Thailand" data="218" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/218">
                                                                    Thailand</option>
                                                                <option value="Togo" data="219" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/219">
                                                                    Togo</option>
                                                                <option value="Tokelau" data="220" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/220">
                                                                    Tokelau</option>
                                                                <option value="Tonga" data="221" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/221">
                                                                    Tonga</option>
                                                                <option value="Trinidad and Tobago" data="222"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/222">
                                                                    Trinidad and Tobago</option>
                                                                <option value="Tunisia" data="223" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/223">
                                                                    Tunisia</option>
                                                                <option value="Turkey" data="224" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/224">
                                                                    Turkey</option>
                                                                <option value="Turkmenistan" data="225"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/225">
                                                                    Turkmenistan</option>
                                                                <option value="Turks and Caicos Islands" data="226"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/226">
                                                                    Turks and Caicos Islands</option>
                                                                <option value="Tuvalu" data="227" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/227">
                                                                    Tuvalu</option>
                                                                <option value="Uganda" data="228" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/228">
                                                                    Uganda</option>
                                                                <option value="Ukraine" data="229" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/229">
                                                                    Ukraine</option>
                                                                <option value="United Arab Emirates" data="230"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/230">
                                                                    United Arab Emirates</option>
                                                                <option value="United Kingdom" data="231"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/231">
                                                                    United Kingdom</option>
                                                                <option value="United States" data="232"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/232">
                                                                    United States</option>
                                                                <option value="United States minor outlying islands"
                                                                    data="233" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/233">
                                                                    United States minor outlying islands</option>
                                                                <option value="Uruguay" data="234" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/234">
                                                                    Uruguay</option>
                                                                <option value="Uzbekistan" data="235"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/235">
                                                                    Uzbekistan</option>
                                                                <option value="Vanuatu" data="236" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/236">
                                                                    Vanuatu</option>
                                                                <option value="Vatican City State" data="237"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/237">
                                                                    Vatican City State</option>
                                                                <option value="Venezuela" data="238"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/238">
                                                                    Venezuela</option>
                                                                <option value="Vietnam" data="239" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/239">
                                                                    Vietnam</option>
                                                                <option value="Virgin Islands (British)" data="240"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/240">
                                                                    Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (U.S.)" data="241"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/241">
                                                                    Virgin Islands (U.S.)</option>
                                                                <option value="Wallis and Futuna Islands" data="242"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/242">
                                                                    Wallis and Futuna Islands</option>
                                                                <option value="Western Sahara" data="243"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/243">
                                                                    Western Sahara</option>
                                                                <option value="Yemen" data="244" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/244">
                                                                    Yemen</option>
                                                                <option value="Zambia" data="245" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/245">
                                                                    Zambia</option>
                                                                <option value="Zimbabwe" data="246" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/246">
                                                                    Zimbabwe</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-6 d-none select_state">
                                                            <select class="form-control " id="show_state"
                                                                name="customer_state">

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="ship-diff-addres-area d-none">
                                                    <h5 class="title">
                                                        Shipping Details
                                                    </h5>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_name" id="shippingFull_name"
                                                                placeholder="Full Name">
                                                            <input type="hidden" name="shipping_email"
                                                                value="">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_phone" id="shipingPhone_number"
                                                                placeholder="Phone Number">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_address" id="shipping_address"
                                                                placeholder="Address">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_zip" id="shippingPostal_code"
                                                                placeholder="Postal Code">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_city" id="shipping_city"
                                                                placeholder="City">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input class="form-control ship_input" type="text"
                                                                name="shipping_state" id="shipping_state"
                                                                placeholder="State">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <select class="form-control ship_input"
                                                                name="shipping_country">
                                                                <option value="" disabled="" selected="">
                                                                    Select Country</option>
                                                                <option value="Afghanistan" data="1"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/1">
                                                                    Afghanistan</option>
                                                                <option value="Albania" data="2" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/2">
                                                                    Albania</option>
                                                                <option value="Algeria" data="3" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/3">
                                                                    Algeria</option>
                                                                <option value="American Samoa" data="4"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/4">
                                                                    American Samoa</option>
                                                                <option value="Andorra" data="5" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/5">
                                                                    Andorra</option>
                                                                <option value="Angola" data="6" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/6">
                                                                    Angola</option>
                                                                <option value="Anguilla" data="7" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/7">
                                                                    Anguilla</option>
                                                                <option value="Antarctica" data="8"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/8">
                                                                    Antarctica</option>
                                                                <option value="Antigua and Barbuda" data="9"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/9">
                                                                    Antigua and Barbuda</option>
                                                                <option value="Argentina" data="10"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/10">
                                                                    Argentina</option>
                                                                <option value="Armenia" data="11" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/11">
                                                                    Armenia</option>
                                                                <option value="Aruba" data="12" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/12">
                                                                    Aruba</option>
                                                                <option value="Australia" data="13"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/13">
                                                                    Australia</option>
                                                                <option value="Austria" data="14" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/14">
                                                                    Austria</option>
                                                                <option value="Azerbaijan" data="15"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/15">
                                                                    Azerbaijan</option>
                                                                <option value="Bahamas" data="16" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/16">
                                                                    Bahamas</option>
                                                                <option value="Bahrain" data="17" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/17">
                                                                    Bahrain</option>
                                                                <option value="Bangladesh" data="18"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/18">
                                                                    Bangladesh</option>
                                                                <option value="Barbados" data="19" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/19">
                                                                    Barbados</option>
                                                                <option value="Belarus" data="20" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/20">
                                                                    Belarus</option>
                                                                <option value="Belgium" data="21" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/21">
                                                                    Belgium</option>
                                                                <option value="Belize" data="22" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/22">
                                                                    Belize</option>
                                                                <option value="Benin" data="23" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/23">
                                                                    Benin</option>
                                                                <option value="Bermuda" data="24" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/24">
                                                                    Bermuda</option>
                                                                <option value="Bhutan" data="25" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/25">
                                                                    Bhutan</option>
                                                                <option value="Bolivia" data="26" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/26">
                                                                    Bolivia</option>
                                                                <option value="Bosnia and Herzegovina" data="27"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/27">
                                                                    Bosnia and Herzegovina</option>
                                                                <option value="Botswana" data="28" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/28">
                                                                    Botswana</option>
                                                                <option value="Bouvet Island" data="29"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/29">
                                                                    Bouvet Island</option>
                                                                <option value="Brazil" data="30" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/30">
                                                                    Brazil</option>
                                                                <option value="British Indian Ocean Territory"
                                                                    data="31" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/31">
                                                                    British Indian Ocean Territory</option>
                                                                <option value="Brunei Darussalam" data="32"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/32">
                                                                    Brunei Darussalam</option>
                                                                <option value="Bulgaria" data="33" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/33">
                                                                    Bulgaria</option>
                                                                <option value="Burkina Faso" data="34"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/34">
                                                                    Burkina Faso</option>
                                                                <option value="Burundi" data="35" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/35">
                                                                    Burundi</option>
                                                                <option value="Cambodia" data="36" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/36">
                                                                    Cambodia</option>
                                                                <option value="Cameroon" data="37" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/37">
                                                                    Cameroon</option>
                                                                <option value="Canada" data="38" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/38">
                                                                    Canada</option>
                                                                <option value="Cape Verde" data="39"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/39">
                                                                    Cape Verde</option>
                                                                <option value="Cayman Islands" data="40"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/40">
                                                                    Cayman Islands</option>
                                                                <option value="Central African Republic" data="41"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/41">
                                                                    Central African Republic</option>
                                                                <option value="Chad" data="42" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/42">
                                                                    Chad</option>
                                                                <option value="Chile" data="43" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/43">
                                                                    Chile</option>
                                                                <option value="China" data="44" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/44">
                                                                    China</option>
                                                                <option value="Christmas Island" data="45"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/45">
                                                                    Christmas Island</option>
                                                                <option value="Cocos (Keeling) Islands" data="46"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/46">
                                                                    Cocos (Keeling) Islands</option>
                                                                <option value="Colombia" data="47" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/47">
                                                                    Colombia</option>
                                                                <option value="Comoros" data="48" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/48">
                                                                    Comoros</option>
                                                                <option value="Democratic Republic of the Congo"
                                                                    data="49" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/49">
                                                                    Democratic Republic of the Congo</option>
                                                                <option value="Republic of Congo" data="50"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/50">
                                                                    Republic of Congo</option>
                                                                <option value="Cook Islands" data="51"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/51">
                                                                    Cook Islands</option>
                                                                <option value="Costa Rica" data="52"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/52">
                                                                    Costa Rica</option>
                                                                <option value="Croatia (Hrvatska)" data="53"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/53">
                                                                    Croatia (Hrvatska)</option>
                                                                <option value="Cuba" data="54" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/54">
                                                                    Cuba</option>
                                                                <option value="Cyprus" data="55" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/55">
                                                                    Cyprus</option>
                                                                <option value="Czech Republic" data="56"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/56">
                                                                    Czech Republic</option>
                                                                <option value="Denmark" data="57" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/57">
                                                                    Denmark</option>
                                                                <option value="Djibouti" data="58" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/58">
                                                                    Djibouti</option>
                                                                <option value="Dominica" data="59" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/59">
                                                                    Dominica</option>
                                                                <option value="Dominican Republic" data="60"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/60">
                                                                    Dominican Republic</option>
                                                                <option value="East Timor" data="61"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/61">
                                                                    East Timor</option>
                                                                <option value="Ecuador" data="62" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/62">
                                                                    Ecuador</option>
                                                                <option value="Egypt" data="63" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/63">
                                                                    Egypt</option>
                                                                <option value="El Salvador" data="64"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/64">
                                                                    El Salvador</option>
                                                                <option value="Equatorial Guinea" data="65"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/65">
                                                                    Equatorial Guinea</option>
                                                                <option value="Eritrea" data="66" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/66">
                                                                    Eritrea</option>
                                                                <option value="Estonia" data="67" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/67">
                                                                    Estonia</option>
                                                                <option value="Ethiopia" data="68" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/68">
                                                                    Ethiopia</option>
                                                                <option value="Falkland Islands (Malvinas)"
                                                                    data="69" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/69">
                                                                    Falkland Islands (Malvinas)</option>
                                                                <option value="Faroe Islands" data="70"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/70">
                                                                    Faroe Islands</option>
                                                                <option value="Fiji" data="71" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/71">
                                                                    Fiji</option>
                                                                <option value="Finland" data="72" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/72">
                                                                    Finland</option>
                                                                <option value="France" data="73" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/73">
                                                                    France</option>
                                                                <option value="France, Metropolitan" data="74"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/74">
                                                                    France, Metropolitan</option>
                                                                <option value="French Guiana" data="75"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/75">
                                                                    French Guiana</option>
                                                                <option value="French Polynesia" data="76"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/76">
                                                                    French Polynesia</option>
                                                                <option value="French Southern Territories"
                                                                    data="77" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/77">
                                                                    French Southern Territories</option>
                                                                <option value="Gabon" data="78" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/78">
                                                                    Gabon</option>
                                                                <option value="Gambia" data="79" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/79">
                                                                    Gambia</option>
                                                                <option value="Georgia" data="80" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/80">
                                                                    Georgia</option>
                                                                <option value="Germany" data="81" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/81">
                                                                    Germany</option>
                                                                <option value="Ghana" data="82" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/82">
                                                                    Ghana</option>
                                                                <option value="Gibraltar" data="83"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/83">
                                                                    Gibraltar</option>
                                                                <option value="Guernsey" data="84" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/84">
                                                                    Guernsey</option>
                                                                <option value="Greece" data="85" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/85">
                                                                    Greece</option>
                                                                <option value="Greenland" data="86"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/86">
                                                                    Greenland</option>
                                                                <option value="Grenada" data="87" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/87">
                                                                    Grenada</option>
                                                                <option value="Guadeloupe" data="88"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/88">
                                                                    Guadeloupe</option>
                                                                <option value="Guam" data="89" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/89">
                                                                    Guam</option>
                                                                <option value="Guatemala" data="90"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/90">
                                                                    Guatemala</option>
                                                                <option value="Guinea" data="91" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/91">
                                                                    Guinea</option>
                                                                <option value="Guinea-Bissau" data="92"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/92">
                                                                    Guinea-Bissau</option>
                                                                <option value="Guyana" data="93" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/93">
                                                                    Guyana</option>
                                                                <option value="Haiti" data="94" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/94">
                                                                    Haiti</option>
                                                                <option value="Heard and Mc Donald Islands"
                                                                    data="95" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/95">
                                                                    Heard and Mc Donald Islands</option>
                                                                <option value="Honduras" data="96" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/96">
                                                                    Honduras</option>
                                                                <option value="Hong Kong" data="97"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/97">
                                                                    Hong Kong</option>
                                                                <option value="Hungary" data="98" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/98">
                                                                    Hungary</option>
                                                                <option value="Iceland" data="99" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/99">
                                                                    Iceland</option>
                                                                <option value="India" data="100" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/100">
                                                                    India</option>
                                                                <option value="Isle of Man" data="101"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/101">
                                                                    Isle of Man</option>
                                                                <option value="Indonesia" data="102"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/102">
                                                                    Indonesia</option>
                                                                <option value="Iran (Islamic Republic of)"
                                                                    data="103" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/103">
                                                                    Iran (Islamic Republic of)</option>
                                                                <option value="Iraq" data="104" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/104">
                                                                    Iraq</option>
                                                                <option value="Ireland" data="105" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/105">
                                                                    Ireland</option>
                                                                <option value="Israel" data="106" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/106">
                                                                    Israel</option>
                                                                <option value="Italy" data="107" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/107">
                                                                    Italy</option>
                                                                <option value="Ivory Coast" data="108"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/108">
                                                                    Ivory Coast</option>
                                                                <option value="Jersey" data="109" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/109">
                                                                    Jersey</option>
                                                                <option value="Jamaica" data="110" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/110">
                                                                    Jamaica</option>
                                                                <option value="Japan" data="111" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/111">
                                                                    Japan</option>
                                                                <option value="Jordan" data="112" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/112">
                                                                    Jordan</option>
                                                                <option value="Kazakhstan" data="113"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/113">
                                                                    Kazakhstan</option>
                                                                <option value="Kenya" data="114" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/114">
                                                                    Kenya</option>
                                                                <option value="Kiribati" data="115" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/115">
                                                                    Kiribati</option>
                                                                <option value="Korea, Democratic People's Republic of"
                                                                    data="116" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/116">
                                                                    Korea, Democratic People's Republic of</option>
                                                                <option value="Korea, Republic of" data="117"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/117">
                                                                    Korea, Republic of</option>
                                                                <option value="Kosovo" data="118" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/118">
                                                                    Kosovo</option>
                                                                <option value="Kuwait" data="119" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/119">
                                                                    Kuwait</option>
                                                                <option value="Kyrgyzstan" data="120"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/120">
                                                                    Kyrgyzstan</option>
                                                                <option value="Lao People's Democratic Republic"
                                                                    data="121" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/121">
                                                                    Lao People's Democratic Republic</option>
                                                                <option value="Latvia" data="122" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/122">
                                                                    Latvia</option>
                                                                <option value="Lebanon" data="123" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/123">
                                                                    Lebanon</option>
                                                                <option value="Lesotho" data="124" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/124">
                                                                    Lesotho</option>
                                                                <option value="Liberia" data="125" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/125">
                                                                    Liberia</option>
                                                                <option value="Libyan Arab Jamahiriya" data="126"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/126">
                                                                    Libyan Arab Jamahiriya</option>
                                                                <option value="Liechtenstein" data="127"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/127">
                                                                    Liechtenstein</option>
                                                                <option value="Lithuania" data="128"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/128">
                                                                    Lithuania</option>
                                                                <option value="Luxembourg" data="129"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/129">
                                                                    Luxembourg</option>
                                                                <option value="Macau" data="130" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/130">
                                                                    Macau</option>
                                                                <option value="North Macedonia" data="131"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/131">
                                                                    North Macedonia</option>
                                                                <option value="Madagascar" data="132"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/132">
                                                                    Madagascar</option>
                                                                <option value="Malawi" data="133" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/133">
                                                                    Malawi</option>
                                                                <option value="Malaysia" data="134" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/134">
                                                                    Malaysia</option>
                                                                <option value="Maldives" data="135" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/135">
                                                                    Maldives</option>
                                                                <option value="Mali" data="136" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/136">
                                                                    Mali</option>
                                                                <option value="Malta" data="137" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/137">
                                                                    Malta</option>
                                                                <option value="Marshall Islands" data="138"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/138">
                                                                    Marshall Islands</option>
                                                                <option value="Martinique" data="139"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/139">
                                                                    Martinique</option>
                                                                <option value="Mauritania" data="140"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/140">
                                                                    Mauritania</option>
                                                                <option value="Mauritius" data="141"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/141">
                                                                    Mauritius</option>
                                                                <option value="Mayotte" data="142" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/142">
                                                                    Mayotte</option>
                                                                <option value="Mexico" data="143" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/143">
                                                                    Mexico</option>
                                                                <option value="Micronesia, Federated States of"
                                                                    data="144" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/144">
                                                                    Micronesia, Federated States of</option>
                                                                <option value="Moldova, Republic of" data="145"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/145">
                                                                    Moldova, Republic of</option>
                                                                <option value="Monaco" data="146" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/146">
                                                                    Monaco</option>
                                                                <option value="Mongolia" data="147" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/147">
                                                                    Mongolia</option>
                                                                <option value="Montenegro" data="148"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/148">
                                                                    Montenegro</option>
                                                                <option value="Montserrat" data="149"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/149">
                                                                    Montserrat</option>
                                                                <option value="Morocco" data="150" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/150">
                                                                    Morocco</option>
                                                                <option value="Mozambique" data="151"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/151">
                                                                    Mozambique</option>
                                                                <option value="Myanmar" data="152" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/152">
                                                                    Myanmar</option>
                                                                <option value="Namibia" data="153" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/153">
                                                                    Namibia</option>
                                                                <option value="Nauru" data="154" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/154">
                                                                    Nauru</option>
                                                                <option value="Nepal" data="155" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/155">
                                                                    Nepal</option>
                                                                <option value="Netherlands" data="156"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/156">
                                                                    Netherlands</option>
                                                                <option value="Netherlands Antilles" data="157"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/157">
                                                                    Netherlands Antilles</option>
                                                                <option value="New Caledonia" data="158"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/158">
                                                                    New Caledonia</option>
                                                                <option value="New Zealand" data="159"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/159">
                                                                    New Zealand</option>
                                                                <option value="Nicaragua" data="160"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/160">
                                                                    Nicaragua</option>
                                                                <option value="Niger" data="161" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/161">
                                                                    Niger</option>
                                                                <option value="Nigeria" data="162" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/162">
                                                                    Nigeria</option>
                                                                <option value="Niue" data="163" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/163">
                                                                    Niue</option>
                                                                <option value="Norfolk Island" data="164"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/164">
                                                                    Norfolk Island</option>
                                                                <option value="Northern Mariana Islands" data="165"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/165">
                                                                    Northern Mariana Islands</option>
                                                                <option value="Norway" data="166" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/166">
                                                                    Norway</option>
                                                                <option value="Oman" data="167" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/167">
                                                                    Oman</option>
                                                                <option value="Pakistan" data="168" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/168">
                                                                    Pakistan</option>
                                                                <option value="Palau" data="169" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/169">
                                                                    Palau</option>
                                                                <option value="Palestine" data="170"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/170">
                                                                    Palestine</option>
                                                                <option value="Panama" data="171" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/171">
                                                                    Panama</option>
                                                                <option value="Papua New Guinea" data="172"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/172">
                                                                    Papua New Guinea</option>
                                                                <option value="Paraguay" data="173" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/173">
                                                                    Paraguay</option>
                                                                <option value="Peru" data="174" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/174">
                                                                    Peru</option>
                                                                <option value="Philippines" data="175"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/175">
                                                                    Philippines</option>
                                                                <option value="Pitcairn" data="176" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/176">
                                                                    Pitcairn</option>
                                                                <option value="Poland" data="177" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/177">
                                                                    Poland</option>
                                                                <option value="Portugal" data="178" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/178">
                                                                    Portugal</option>
                                                                <option value="Puerto Rico" data="179"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/179">
                                                                    Puerto Rico</option>
                                                                <option value="Qatar" data="180" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/180">
                                                                    Qatar</option>
                                                                <option value="Reunion" data="181" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/181">
                                                                    Reunion</option>
                                                                <option value="Romania" data="182" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/182">
                                                                    Romania</option>
                                                                <option value="Russian Federation" data="183"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/183">
                                                                    Russian Federation</option>
                                                                <option value="Rwanda" data="184" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/184">
                                                                    Rwanda</option>
                                                                <option value="Saint Kitts and Nevis" data="185"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/185">
                                                                    Saint Kitts and Nevis</option>
                                                                <option value="Saint Lucia" data="186"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/186">
                                                                    Saint Lucia</option>
                                                                <option value="Saint Vincent and the Grenadines"
                                                                    data="187" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/187">
                                                                    Saint Vincent and the Grenadines</option>
                                                                <option value="Samoa" data="188" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/188">
                                                                    Samoa</option>
                                                                <option value="San Marino" data="189"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/189">
                                                                    San Marino</option>
                                                                <option value="Sao Tome and Principe" data="190"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/190">
                                                                    Sao Tome and Principe</option>
                                                                <option value="Saudi Arabia" data="191"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/191">
                                                                    Saudi Arabia</option>
                                                                <option value="Senegal" data="192" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/192">
                                                                    Senegal</option>
                                                                <option value="Serbia" data="193" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/193">
                                                                    Serbia</option>
                                                                <option value="Seychelles" data="194"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/194">
                                                                    Seychelles</option>
                                                                <option value="Sierra Leone" data="195"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/195">
                                                                    Sierra Leone</option>
                                                                <option value="Singapore" data="196"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/196">
                                                                    Singapore</option>
                                                                <option value="Slovakia" data="197" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/197">
                                                                    Slovakia</option>
                                                                <option value="Slovenia" data="198" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/198">
                                                                    Slovenia</option>
                                                                <option value="Solomon Islands" data="199"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/199">
                                                                    Solomon Islands</option>
                                                                <option value="Somalia" data="200" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/200">
                                                                    Somalia</option>
                                                                <option value="South Africa" data="201"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/201">
                                                                    South Africa</option>
                                                                <option value="South Georgia South Sandwich Islands"
                                                                    data="202" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/202">
                                                                    South Georgia South Sandwich Islands</option>
                                                                <option value="South Sudan" data="203"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/203">
                                                                    South Sudan</option>
                                                                <option value="Spain" data="204" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/204">
                                                                    Spain</option>
                                                                <option value="Sri Lanka" data="205"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/205">
                                                                    Sri Lanka</option>
                                                                <option value="St. Helena" data="206"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/206">
                                                                    St. Helena</option>
                                                                <option value="St. Pierre and Miquelon" data="207"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/207">
                                                                    St. Pierre and Miquelon</option>
                                                                <option value="Sudan" data="208" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/208">
                                                                    Sudan</option>
                                                                <option value="Suriname" data="209" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/209">
                                                                    Suriname</option>
                                                                <option value="Svalbard and Jan Mayen Islands"
                                                                    data="210" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/210">
                                                                    Svalbard and Jan Mayen Islands</option>
                                                                <option value="Swaziland" data="211"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/211">
                                                                    Swaziland</option>
                                                                <option value="Sweden" data="212" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/212">
                                                                    Sweden</option>
                                                                <option value="Switzerland" data="213"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/213">
                                                                    Switzerland</option>
                                                                <option value="Syrian Arab Republic" data="214"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/214">
                                                                    Syrian Arab Republic</option>
                                                                <option value="Taiwan" data="215" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/215">
                                                                    Taiwan</option>
                                                                <option value="Tajikistan" data="216"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/216">
                                                                    Tajikistan</option>
                                                                <option value="Tanzania, United Republic of"
                                                                    data="217" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/217">
                                                                    Tanzania, United Republic of</option>
                                                                <option value="Thailand" data="218" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/218">
                                                                    Thailand</option>
                                                                <option value="Togo" data="219" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/219">
                                                                    Togo</option>
                                                                <option value="Tokelau" data="220" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/220">
                                                                    Tokelau</option>
                                                                <option value="Tonga" data="221" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/221">
                                                                    Tonga</option>
                                                                <option value="Trinidad and Tobago" data="222"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/222">
                                                                    Trinidad and Tobago</option>
                                                                <option value="Tunisia" data="223" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/223">
                                                                    Tunisia</option>
                                                                <option value="Turkey" data="224" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/224">
                                                                    Turkey</option>
                                                                <option value="Turkmenistan" data="225"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/225">
                                                                    Turkmenistan</option>
                                                                <option value="Turks and Caicos Islands" data="226"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/226">
                                                                    Turks and Caicos Islands</option>
                                                                <option value="Tuvalu" data="227" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/227">
                                                                    Tuvalu</option>
                                                                <option value="Uganda" data="228" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/228">
                                                                    Uganda</option>
                                                                <option value="Ukraine" data="229" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/229">
                                                                    Ukraine</option>
                                                                <option value="United Arab Emirates" data="230"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/230">
                                                                    United Arab Emirates</option>
                                                                <option value="United Kingdom" data="231"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/231">
                                                                    United Kingdom</option>
                                                                <option value="United States" data="232"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/232">
                                                                    United States</option>
                                                                <option value="United States minor outlying islands"
                                                                    data="233" rel5="0" rel="0"
                                                                    rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/233">
                                                                    United States minor outlying islands</option>
                                                                <option value="Uruguay" data="234" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/234">
                                                                    Uruguay</option>
                                                                <option value="Uzbekistan" data="235"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/235">
                                                                    Uzbekistan</option>
                                                                <option value="Vanuatu" data="236" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/236">
                                                                    Vanuatu</option>
                                                                <option value="Vatican City State" data="237"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/237">
                                                                    Vatican City State</option>
                                                                <option value="Venezuela" data="238"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/238">
                                                                    Venezuela</option>
                                                                <option value="Vietnam" data="239" rel5="0"
                                                                    rel="0" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/239">
                                                                    Vietnam</option>
                                                                <option value="Virgin Islands (British)" data="240"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/240">
                                                                    Virgin Islands (British)</option>
                                                                <option value="Virgin Islands (U.S.)" data="241"
                                                                    rel5="0" rel="0" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/241">
                                                                    Virgin Islands (U.S.)</option>
                                                                <option value="Wallis and Futuna Islands" data="242"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/242">
                                                                    Wallis and Futuna Islands</option>
                                                                <option value="Western Sahara" data="243"
                                                                    rel5="0" rel="1" rel1="0"
                                                                    rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/243">
                                                                    Western Sahara</option>
                                                                <option value="Yemen" data="244" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/244">
                                                                    Yemen</option>
                                                                <option value="Zambia" data="245" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/245">
                                                                    Zambia</option>
                                                                <option value="Zimbabwe" data="246" rel5="0"
                                                                    rel="1" rel1="0" rel2="0"
                                                                    data-href="https://product.geniusocean.com/geniuscart/user/country/wise/state/246">
                                                                    Zimbabwe</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="order-note mt-3">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <input type="text" id="Order_Note" class="form-control"
                                                                name="order_notes" placeholder="Order Note (Optional)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12  mt-3">
                                                        <div class="bottom-area paystack-area-btn">
                                                            <button data-go="2" data-hide="1"
                                                                class="mybtn1 ">Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="pills-step2" role="tabpanel"
                                        aria-labelledby="pills-step2-tab">
                                        <div class="content-box">
                                            <div class="content">
                                                <div class="order-area">
                                                    <div class="order-item">
                                                        @foreach ($products as $i => $product)
                                                            <div class="product-img">
                                                                <div class="d-flex">
                                                                    <img src="{{ asset($product->thumbnail) }}"
                                                                        height="80" width="80" class="p-1">
                                                                </div>
                                                            </div>
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][product_type]"
                                                                value="single">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][unit_price]"
                                                                value="0.00">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][line_discount_type]"
                                                                value="fixed">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][line_discount_amount]"
                                                                value="0.00">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][item_tax]"
                                                                value="0.00">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][tax_id]"
                                                                value="">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][sell_line_note]"
                                                                value="">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][product_id]"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][variation_id]"
                                                                value="{{ $product->id }}">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][enable_stock]"
                                                                value="0">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][quantity]"
                                                                value="0">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][product_unit_id]"
                                                                value="2">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][sub_unit_id]"
                                                                value="2">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][base_unit_multiplier]"
                                                                value="1">
                                                            <input type="hidden"
                                                                name="products[{{ $i + 1 }}][unit_price_inc_tax]"
                                                                value="0.00">

                                                            <div class="product-content">
                                                                <p class="name"><a href=""
                                                                        target="_blank">{{ $product->name }}</a></p>
                                                                <div class="unit-price d-flex">
                                                                    <h5 class="label mr-2">Price : </h5>
                                                                    <p>£{{ $product->price }}</p>
                                                                </div>
                                                                {{-- <div class="quantity d-flex">
                                                                <h5 class="label mr-2">Quantity : </h5>
                                                                <span class="qttotal">1 </span>
                                                            </div>
                                                            <div class="total-price d-flex">
                                                                <h5 class="label mr-2">Total Price : </h5>
                                                                <p>
                                                                    110$
                                                                    <small></small>
                                                                </p>
                                                            </div> --}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12 mt-3">
                                                        <div class="bottom-area">
                                                            <a href="javascript:;" id="step1-btn" data-go="1"
                                                                data-hide="2" class="mybtn1 mr-3">Back</a>
                                                            <a href="javascript:;" id="step3-btn" data-go="3"
                                                                data-hide="2" class="mybtn1">Continue</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="pills-step3" role="tabpanel"
                                        aria-labelledby="pills-step3-tab">
                                        <div class="content-box">
                                            <div class="content">
                                                <div class="payment-information">
                                                    <h4 class="title">
                                                        Payment Info
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-lg-12 d-flex gap-2">
                                                            <input type="hidden" id="payment_method"
                                                                name="payment_method">
                                                            {{-- <label class="form_input form_radio">
                                                                <input type="radio" name="payment_method"
                                                                    value="cash_on_delivery" required>
                                                                Cash On Delivery
                                                            </label> --}}
                                                            <a href="javascript:;" data-go="2" data-hide="3"
                                                                class="mybtn1 mr-3 mb-0 last_back_btn">Back</a>
                                                            <button type="button" id="final-btn"
                                                                class="btn btn-primary">Pay Latter</button>
                                                            <button type="button" class="btn btn-primary"
                                                                id="open_stripe_modal--btn" data-bs-toggle="modal"
                                                                data-bs-target="#stripeModal">Card</button>
                                                            {{-- <div class="stripe_checkbox_container">
                                                                <label class="form_input form_radio">
                                                                    <input type="radio" name="payment_method"
                                                                        value="stripe" required="">
                                                                    Debit or Credit Card
                                                                </label>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stripeModal"
                                                                    class="btn btn-primary" id="open_stripe_modal--btn">Open
                                                                    Stripe Modal</button>
                                                            </div> --}}
                                                        </div>
                                                        <p id="stripe_error_message" class="m-0 text-danger"></p>
                                                    </div>

                                                    <div class="modal fade" id="stripeModal" tabindex="-1"
                                                        aria-labelledby="stripeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="stripeModalLabel">
                                                                        Payment Form</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <label for="card-element">
                                                                        Accepted Card
                                                                    </label>
                                                                    <div class="acceepted_cards_container">
                                                                        <img src="{{ asset('images/cards/visa.jpg') }}"
                                                                            alt="">
                                                                        <img src="{{ asset('images/cards/mastercard.png') }}"
                                                                            alt="">
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <label for="card-number">
                                                                            Card Number
                                                                        </label>
                                                                        <div class="stripe-element-container"
                                                                            id="card-number">
                                                                            <!-- A Stripe Element will be inserted here. -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="row row-cols-2">
                                                                        <div class="form-row">
                                                                            <label for="card-expiry-month">
                                                                                Expiry Date
                                                                            </label>
                                                                            <div class="stripe-element-container"
                                                                                id="card-expiry-month">
                                                                                <!-- A Stripe Element will be inserted here. -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-row">
                                                                            <label for="card-cvc">
                                                                                CVC
                                                                            </label>
                                                                            <div class="stripe-element-container"
                                                                                id="card-cvc">
                                                                                <!-- A Stripe Element will be inserted here. -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="stripe-error-container"
                                                                        style="display: none;"></div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" id="proceed_to_checkout"
                                                                        class="btn btn-primary stripe-proceed-btn">Proceed
                                                                        to payment</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="amount" value="{{ $total_price }}">
                            <input type="hidden" name="product_ids" value="{{ $product_ids }}">

                            <input type="hidden" id="shipping-cost" name="shipping_cost" value="0">
                            <input type="hidden" id="packing-cost" name="packing_cost" value="0">
                            <input type="hidden" id="shipping-title" name="shipping_title" value="Free Shipping">
                            <input type="hidden" id="packing-title" name="packing_title" value="Default Packaging">
                            <input type="hidden" name="dp" value="0">
                            <input type="hidden" id="input_tax" name="tax" value="">
                            <input type="hidden" id="input_tax_type" name="tax_type" value="">
                            <input type="hidden" name="totalQty" value="1">
                            <input type="hidden" name="vendor_shipping_id" value="0">
                            <input type="hidden" name="vendor_packing_id" value="0">
                            <input type="hidden" name="currency_sign" value="$">
                            <input type="hidden" name="currency_name" value="USD">
                            <input type="hidden" name="currency_value" value="1">
                            <input type="hidden" id="tgrandtotal" value="110">
                            <input type="hidden" id="original_tax" value="0">
                            <input type="hidden" id="wallet-price" name="wallet_price" value="0">
                            <input type="hidden" id="ttotal" value="110$">
                            <input type="hidden" name="coupon_code" id="coupon_code" value="">
                            <input type="hidden" name="coupon_discount" id="coupon_discount" value="">
                            <input type="hidden" name="coupon_id" id="coupon_id" value="">
                            <input type="hidden" name="user_id" id="user_id" value="">

                            <input type="hidden" name="status" value="final">
                            <input type="hidden" name="final_total" value="{{ $total_price }}">
                            <input type="hidden" name="discount_type" value="percentage">
                            <input type="hidden" name="discount_amount" value="10.00">
                            <input type="hidden" name="tax_rate_id" value="">
                            <input type="hidden" name="location_id" value="{{ $product->location_id }}">
                            <input type="hidden" name="invoice_scheme_id" value="2">
                            <input type="hidden" name="contact_id" value="{{ $product->contact_id }}">
                            <input type="hidden" name="business_id" value="{{ $product->business_id }}">
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="right-area">
                            <div class="order-box">
                                <h4 class="title">PRICE DETAILS</h4>
                                <ul class="order-list">
                                    <li>
                                        <p>
                                            Total MRP
                                        </p>
                                        <p>
                                            <b class="cart-total">£{{ $total_price_excluding_tax }}</b>
                                        </p>
                                    </li>
                                    <li>
                                        <p> Vat </p>
                                        <p>
                                            <b class="cart-total">£{{ $total_vat }}</b>
                                        </p>
                                    </li>
                                    <li class="tax_show  d-none">
                                        <p> Tax </p>
                                        <p>
                                            <b> <span class="original_tax">0</span> % </b>
                                        </p>
                                    </li>



                                    <li class="discount-bar d-none">
                                        <p> Discount <span class="dpercent"></span> </p>
                                        <p> <b id="discount">$</b> </p>
                                    </li>
                                </ul>
                                <div class="total-price">
                                    <p> Total </p>
                                    <p class="total-cost-dum">
                                        <span id="total-cost">£{{ $total_price }}</span>
                                    </p>
                                </div>
                                {{-- <div class="cupon-box">
                                    <div id="coupon-link">
                                        <img src="https://product.geniusocean.com/geniuscart/assets/front/images/tag.png">
                                        Have a promotion code?
                                    </div>
                                    <form id="check-coupon-form" class="coupon">
                                        <input type="text" placeholder="Coupon Code" id="code"
                                            required="" autocomplete="off">
                                        <button type="submit">Apply</button>
                                    </form>
                                </div> --}}

                                {{-- <div class="packeging-area">
                                    <h4 class="title">Shipping Method</h4>
                                    <div class="radio-design">
                                        <input type="radio" class="shipping" data-form="Free Shipping"
                                            id="free-shepping1" name="shipping" value="0" checked="">
                                        <span class="checkmark"></span>
                                        <label for="free-shepping1">
                                            Free Shipping
                                            <small>(10 - 12 days)</small>
                                        </label>
                                    </div>
                                    <div class="radio-design">
                                        <input type="radio" class="shipping" data-form="Express Shipping"
                                            id="free-shepping2" name="shipping" value="10">
                                        <span class="checkmark"></span>
                                        <label for="free-shepping2">
                                            Express Shipping
                                            + $10
                                            <small>(5 - 6 days)</small>
                                        </label>
                                    </div>
                                </div>

                                <div class="packeging-area">
                                    <h4 class="title">Packaging</h4>
                                    <div class="radio-design">
                                        <input type="radio" class="packing" data-form="Default Packaging"
                                            id="free-package1" name="packeging" value="0" checked="">
                                        <span class="checkmark"></span>
                                        <label for="free-package1">
                                            Default Packaging
                                            <small>Default packaging by store</small>
                                        </label>
                                    </div>
                                    <div class="radio-design">
                                        <input type="radio" class="packing" data-form="Gift Packaging"
                                            id="free-package2" name="packeging" value="15">
                                        <span class="checkmark"></span>
                                        <label for="free-package2">
                                            Gift Packaging
                                            + $15
                                            <small>Exclusive Gift packaging</small>
                                        </label>
                                    </div>
                                </div> --}}
                                <div class="final-price">
                                    <span>Final Price :</span>
                                    <span id="final-cost">£{{ $total_price }}</span>
                                </div>
                                <div class="wallet-price d-none">
                                    <span>Wallet Amount:</span>
                                    <span id="wallet-cost"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="payment_animation_container" tabindex="-1"
            aria-labelledby="payment_animation_containerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <img src="{{ asset('images/cards/payment-animation.gif') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="payment_success_container" tabindex="-1"
            aria-labelledby="payment_success_containerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <i class="fa-solid fa-check"></i>
                        <h1 class="text-center">Payment Successfull</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="payment_thanks_container" tabindex="-1"
            aria-labelledby="payment_thanks_containerLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <h1 class="text-center">Thank you for</h1>
                        <h1 class="text-center mb-5">Your Order!</h1>
                        <div class="d-flex flex-column flex-md-row gap-4">
                            <a class="btn" href="{{ route('service.list') }}">Buy more</a>
                            <button class="btn" id="create_invoice_btn" type="button">
                                <span id="create_invoice_btn_text">Invoice</span>
                                <div id="create_invoice_btn_loader" style="display: none;">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </button>
                            @if (Auth::user() && Auth::user()->user_type == 'user_customer')
                                <a href="{{ url('contact/contact-dashboard') }}" class="btn">Dashboard</a>
                            @else
                                <a href="{{ url('home') }}" class="btn">Dashboard</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="invoice print_section" id="receipt_section">
    </section>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/front/js/custom.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var receipt;
        var stripe = Stripe('{{ env('STRIPE_PUB_KEY') }}');
        var elements = stripe.elements();
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4',
                },
                border: '1px solid #ccc', // Border
                padding: '10px' // Padding
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a',
            },
        };

        // Create Card Element for card number
        var cardNumber = elements.create('cardNumber', {
            style: style
        });
        cardNumber.mount('#card-number');

        // Create Card Element for expiry month
        var cardExpiryMonth = elements.create('cardExpiry', {
            style: style,
            base: {
                fontSize: '16px'
            }
        });
        cardExpiryMonth.mount('#card-expiry-month');

        // Create Card Element for CVC
        var cardCvc = elements.create('cardCvc', {
            style: style
        });
        cardCvc.mount('#card-cvc');
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.mybtn1', function(event) {
                event.preventDefault(); // Prevent default action of the button click

                let go = $(this).data('go');
                let hide = $(this).data('hide');
                var isValid = true;

                if (go > hide) {
                    var form = document.getElementById('checkout_form');
                    var checkTab = document.getElementById(`pills-step${hide}`);
                    var inputFields = checkTab.querySelectorAll('input, select, textarea');
                    inputFields.forEach(function(inputField) {
                        if (!inputField.checkValidity()) {
                            inputField.focus(); // Focus on the first invalid input field
                            form.reportValidity();
                            isValid = false;
                            return;
                        }
                    });
                }
                if (isValid) {
                    $(`#pills-step${go}`).addClass('active');
                    $(`#pills-step${go}-tab`).addClass('active');
                    $(`#pills-step${hide}`).removeClass('active');
                    $(`#pills-step${hide}-tab`).removeClass('active');
                    $(`#pills-step${hide}-tab`).addClass('disabled');
                }
            });

            $('input[type="radio"][name="payment_method"]').change(function() {
                let payment_method = $(this).val();
                if (payment_method == 'stripe') {
                    $('#stripeModal').modal('show');
                    stripe.createToken(cardNumber).then(function(result) {
                        if (result.error) {
                            $('#stripe_error_message').text(
                                'Please provide your card information in the modal.');
                            $('#stripe_error_message').show();
                        } else {
                            $('#stripe_error_message').text(
                                'You have already provided your card information.');
                            $('#stripe_error_message').show();
                        }
                    });
                } else {
                    $('#stripeModal').modal('hide');
                    $('#stripe_error_message').hide();
                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#proceed_to_checkout', function() {
                $('#stripeModal').modal('hide');
                $('#payment_animation_container .modal-body').show();
                $('#payment_animation_container').modal('show');
                const amount = "{{ $total_price }}"
                $.ajax({
                    url: "{{ route('get.stripe.client.secret') }}",
                    type: 'get',
                    data: {
                        amount: amount
                    },
                    dataType: 'json',
                    success: function(response) {
                        setTimeout(() => {
                            $('#payment_animation_container').modal('hide');
                        }, 1500);
                        stripe.confirmCardPayment(response.client_secret, {
                            payment_method: {
                                card: cardNumber,
                                billing_details: {
                                    name: response.name,
                                    email: response.email
                                }
                            },
                            setup_future_usage: 'off_session'
                        }).then(function(result) {
                            if (result.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: result.error.message,
                                    position: 'center',
                                })
                            } else {
                                if (result.paymentIntent.status === 'succeeded') {
                                    $('#payment_method').val('stripe');
                                    saveCheckoutForm();
                                }
                                return false;
                            }
                        });
                    }
                })
            })
            $(document).on('click', '#final-btn', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    // text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm',
                    cancelButtonText: 'Cancel',
                    position: 'center',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#payment_animation_container').modal('show');
                        $('#payment_method').val('cash_on_delivery');
                        saveCheckoutForm();
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        // here handle the cancel
                    }
                });
            })
        })

        function saveCheckoutForm(stripeToken) {
            var checkout_form = $('#checkout_form');
            var data = checkout_form.serializeArray();
            data.push({
                name: 'stripeToken',
                value: stripeToken
            });
            $.ajax({
                url: "{{ route('checkout.post') }}",
                type: 'POST',
                data: data,
                dataType: 'json',
                success: async function(result) {
                    if (result.success == 1) {
                        //Check if enabled or not
                        // if (result.receipt.is_enabled) {
                        $('#payment_animation_container').modal('hide');
                        await $('#payment_success_container').modal('show');
                        $('#stripeModal').modal('hide');
                        setTimeout(function() {
                            location.href = "{{ route('front.payment.successfull') }}"
                        }, 2000);
                        receipt = result.receipt;

                        // pos_print(result.receipt);
                        // }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                            position: 'center',
                        });
                    }
                },
            });
        }
    </script>
@endsection
