<style>
    .footer-top {
        background-color: #232F3E;
        color: #ccc !important;
        padding: 15px 0;
        font-size: 13px;
        margin-top: 25px;
    }

    .footer-logo {
        width: 120px;
        height: auto;
    }

    .footer-mid {
        background-color: #131A22;
        color: #ddd;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        padding: 30px 8%;
        font-size: 12px;
    }

    .footer-mid ul {
        display: flex;
        flex-direction: column;
    }

    .footer-mid a {
        color: #999;
    }

    .footer-mid span {
        color: #ddd;
        font-size: 12px;
    }

    .footer-mid a:hover {
        color: #999 !important;
        font-weight: bold;
    }

    .footer-mid i {
        font-size: 20px;
    }

    .footer-bottom {
        color: #999;
        background-color: #131A22;
        font-size: 11px;
        text-align: center;
        padding: 0 13%;
        padding-bottom: 20px;
    }

    @media screen and (max-width: 577px) {
        .footer-mid {
            background-color: #232F3E;
            grid-template-columns: repeat(1, 1fr);
            padding: 5px 5%;
        }

        .footer-mid ul {
            background-color: #131A22;
            padding: 10px 10%;
        }

        .footer-mid span {
            text-align: center;
        }

        .footer-bottom {
            padding: 13%;
        }
    }
</style>
<footer>
    <div class="footer-top d-flex flex-column align-items-center">
        <img class="footer-logo" src="{{ asset('assets/images/header_logo.png') }}" alt="">
        <div class="d-flex gap-5">
            <span>United Kindom</span>
            <span>Bangladesh</span>
        </div>
    </div>
    <div class="footer-mid ">

        <ul>
            <li><span>About</span></li>
            <li><a href="{{ route('footer.details.about_us') }}">About Us</a></li>
            <li><a href="{{ route('footer.details.slavery_and_human_trafficking_statement') }}">Slavery and Human
                    Trafficking</a></li>
            <li><a href="{{ route('footer.details.statement') }}">Statement</a></li>
            <li><a href="{{ route('footer.details.sustainability') }}">Sustainability</a></li>
            <li><a href="{{ route('footer.details.unipuller_service') }}">Unipuller service</a></li>
        </ul>

        <ul>
            <li><span>Make money with us</span></li>
            <li><a href="{{ route('footer.details.sell_on_technology') }}">Sell on unipuller technology</a>
            </li>
            <li><a href="{{ route('footer.details.sell_on_unipuller') }}">Sell on unipuller</a></li>
            <li><a href="{{ route('footer.details.associate_program') }}">Associate program</a></li>
            <li><a href="{{ route('footer.details.delivery_partner') }}">Service Delivery parntership</a></li>
        </ul>

        <ul>
            <li><span>Our services</span></li>
            <li><a href="{{ route('footer.details.our.advertising') }}">Advertising</a></li>
            <li><a href="{{ route('footer.details.our.marketing') }}">Marketing</a></li>
            <li><a href="{{ route('footer.details.our.website_devlopment') }}">Website Development</a></li>
            <li><a href="{{ route('footer.details.our.software_devlopment') }}">Software Development</a></li>
            <li><a href="{{ route('footer.details.our.seo') }}">SEO</a></li>
            <li><a href="{{ route('footer.details.our.video_production') }}">Video Production</a></li>
        </ul>

        <ul>
            <li><span>Policies</span></li>
            <li><a href="{{ route('footer.details.policies.privacy_cookies') }}">Privacy and Cookies</a></li>
            <li><a href="{{ route('footer.details.policies.condition_of_use_sale') }}">Condition of use and sale</a>
            </li>
            <li><a href="{{ route('footer.details.policies.return_refund_policies') }}">Returns and Refund Policies</a>
            </li>
            <li><a href="{{ route('footer.details.policies.payment_terms') }}">Payment terms</a></li>
        </ul>

        <ul>
            <li><span>Connect</span></li>
            <li><a href="{{ route('footer.details.contact_us') }}">Help and support</a></li>
            <li>
                <ul class="d-flex flex-row gap-3 mt-2" style="padding: 0px !important;">
                    <li>
                        @if (isset(footerInfo()['facebook']))
                            <a href="{!! strip_tags(footerInfo()['facebook']) !!}" target="_blank" rel="noopener">
                                <i class="fa-brands fa-facebook"></i>
                            </a>
                        @endif
                    </li>

                    <li>
                        @if (isset(footerInfo()['linkedin']))
                            <a href="{!! strip_tags(footerInfo()['linkedin']) !!}" target="__blank">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        @endif
                    </li>

                    <li>
                        @if (isset(footerInfo()['youtube']))
                            <a href="{!! strip_tags(footerInfo()['youtube']) !!}" target="__blank">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        @endif
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    {{-- {{ dd(footerInfo()) }} --}}
    <div class="footer-bottom">
        @if (isset(footerInfo()['copyright']))
            {!! footerInfo()['copyright'] !!}
        @endif
    </div>

</footer>
<script src="https://kit.fontawesome.com/7e596160a4.js" crossorigin="anonymous"></script>
