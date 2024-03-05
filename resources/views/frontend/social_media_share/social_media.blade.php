<div class="my-2 social-linkss social-sharing a2a_kit a2a_kit_size_32" style="line-height: 32px;">
    {{-- <h5 class="mb-2">Share Now</h5> --}}
    <ul class="social-icons py-1 share-product social-linkss py-md-0">
        <li>
            <a class="facebook a2a_button_facebook" href="#" target="_blank" onclick="shareOnFacebook()"
                rel="nofollow noopener">
                <i class="fab fa-facebook-f"></i>
            </a>
        </li>
        <li>
            <a class="twitter a2a_button_twitter" href="#" target="_blank" onclick="shareOnTwitter()"
                rel="nofollow noopener">
                <i class="fab fa-twitter"></i>
            </a>
        </li>
        <li>
            <a class="linkedin a2a_button_linkedin" href="#" target="_blank" onclick="shareOnLinkedIn()"
                rel="nofollow noopener">
                <i class="fab fa-linkedin-in"></i>
            </a>
        </li>
        <li>
            <a class="pinterest a2a_button_pinterest" href="#" target="_blank" onclick="shareOnPinterest()"
                rel="nofollow noopener">
                <i class="fab fa-pinterest-p"></i>
            </a>
        </li>
        <li>
            <a class="instagram a2a_button_whatsapp" href="#" target="_blank" onclick="shareOnWhatsApp()"
                rel="nofollow noopener">
                <i class="fab fa-whatsapp"></i>
            </a>
        </li>
    </ul>
</div>

<script>
    function shareOnFacebook() {
        var currentURL = window.location.href;
        var facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(currentURL);
        window.open(facebookURL, '_blank');
        return false;
    }

    function shareOnTwitter() {
        var currentURL = window.location.href;
        var twitterURL = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(currentURL);
        window.open(twitterURL, '_blank');
        return false;
    }

    function shareOnLinkedIn() {
        var currentURL = window.location.href;
        var linkedInURL = 'https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(currentURL);
        window.open(linkedInURL, '_blank');
        return false;
    }

    function shareOnPinterest() {
        var currentURL = window.location.href;
        var pinterestURL = 'https://pinterest.com/pin/create/button/?url=' + encodeURIComponent(currentURL);
        window.open(pinterestURL, '_blank');
        return false;
    }

    function shareOnWhatsApp() {
        var currentURL = window.location.href;
        var whatsappURL = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(currentURL);
        window.open(whatsappURL, '_blank');
        return false;
    }
</script>
