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
        <img class="footer-logo" src="{{ asset('assets/images/1688251988finallogowhitepng.png') }}" alt="">
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
            <li><a href="{{ route('footer.details.delivery_partner') }}">Service Delivery partner</a></li>
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
            <li><a href="">Help and support</a></li>
            <li>
                <ul class="d-flex flex-row gap-3 mt-2">
                    <li><a href="https://www.facebook.com/Unipuller" target="__blank"><i
                                class="fa-brands fa-facebook"></i></a></li>
                    {{-- <li><a href=""><i class="fa-brands fa-twitter"></i></a></li> --}}
                    <li><a href="https://www.linkedin.com/company/unipuller/" target="__blank"><i
                                class="fa-brands fa-linkedin"></i></a>
                    </li>
                    <li><a href="https://www.youtube.com/@unipuller" target="__blank"><i
                                class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="footer-bottom">
        <span class="fw-bold">Unipuller</span> is a registered Private Ltd. company with Company House in United Kingdom
        and Bangladesh. Registration number: 14583903 and VAT number: 438 5100 09. Company address: Unit 1a, Nagpal
        House, 1 Gunthrope St., London, United Kingdom. Post code: E1 7RG. © Unipuller Limited 2023. All rights
        reserved.
    </div>
</footer>
<script src="https://kit.fontawesome.com/7e596160a4.js" crossorigin="anonymous"></script>
