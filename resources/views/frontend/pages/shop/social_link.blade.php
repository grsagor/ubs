<ul class="social-links">
    @if ($shop->facebook)
        <li>
            <a href="{{ $shop->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
        </li>
    @endif
    @if ($shop->instagram)
        <li>
            <a href="{{ $shop->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
        </li>
    @endif
    @if ($shop->linkedin)
        <li>
            <a href="{{ $shop->linkedin }}" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </li>
    @endif
    @if ($shop->twitter)
        <li>
            <a href="{{ $shop->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
        </li>
    @endif
    @if ($shop->youtube)
        <li>
            <a href="{{ $shop->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
        </li>
    @endif
    @if ($shop->pinterest)
        <li>
            <a href="{{ $shop->pinterest }}" target="_blank"><i class="fab fa-pinterest"></i></a>
        </li>
    @endif
</ul>
