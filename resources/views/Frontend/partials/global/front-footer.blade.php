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
        grid-template-columns: repeat(6, 1fr);
        gap: 10px;
        padding: 30px 10%;
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
            padding: 30px 10%;
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
    <div class="footer-mid">
        <ul>
            <li><a href="{{ route('footer.details.about') }}"><span>About</span></a></li>
            <li><a href="">About us</a></li>
            <li><a href="">Statement</a></li>
            <li><a href="">Sustainability</a></li>
            <li><a href="">Unipuller service</a></li>
        </ul>
        <ul>
            <li><a href="{{ route('footer.details.make.money') }}"><span>Make money with us</span></a></li>
            <li><a href="">Sell on unipuller</a></li>
            <li><a href="">Sell on unipuller technology</a></li>
            <li><a href="">Associate program</a></li>
            <li><a href="">Delivery partner</a></li>
        </ul>
        <ul>
            <li><a href="{{ route('footer.details.our.services') }}"><span>Our services</span></a></li>
            <li><a href="">Advertising</a></li>
            <li><a href="">Marketing</a></li>
            <li><a href="">Website Development</a></li>
            <li><a href="">Software Development</a></li>
            <li><a href="">SEO</a></li>
            <li><a href="">Video Production</a></li>
            <li><a href="">Partner Boarding</a></li>
        </ul>
        <ul>
            <li><a href="{{ route('footer.details.quick.links') }}"><span>Quick links</span></a></li>
            </li>
            <li><a href="">Software</a></li>
            </li>
            <li><a href="">Domain & Hosting</a></li>
            </li>
            <li><a href="">Ready Websites</a></li>
            </li>
            <li><a href="">Form Generator</a></li>
            </li>
            <li><a href="">QR Code Generator</a></li>
            </li>
            <li><a href="">Content Creator</a></li>
            </li>
        </ul>
        <ul>
            <li><a href="{{ route('footer.details.policies') }}"><span>Policies</span></a></li>
            <li><a href="">Privacy</a></li>
            <li><a href="">Cookies</a></li>
            <li><a href="">Condition of sale</a></li>
            <li><a href="">Condition of use</a></li>
            <li><a href="">Return policies</a></li>
            <li><a href="">Refund policies</a></li>
            <li><a href="">Seller statement</a></li>
            <li><a href="">Payment terms</a></li>
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
