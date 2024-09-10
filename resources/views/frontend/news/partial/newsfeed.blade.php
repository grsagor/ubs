@foreach ($news as $item)
    <div class="newsfeed-card">
        <a href="{{ route('shop.service', $item->business_location_id) }}" class="card-header">
            <img src="{{ $item->businessLocation->logo ? asset($item->businessLocation->logo) : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg' }}"
                alt="Profile Picture" class="profile-pic">
            <div class="user-info">
                <h4 class="username">{{ $item->businessLocation->name }}</h4>
                <p class="timestamp">{{ $item->created_at->diffForHumans() }}</p>
            </div>
        </a>

        <a href="{{ route('news.show', $item->slug) }}" class="card-link">
            <div class="card-body">
                @php
                    $thumbnail =
                        $item->thumbnail && file_exists(public_path($item->thumbnail))
                            ? asset($item->thumbnail)
                            : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg';
                @endphp
                <img src="{{ $thumbnail }}" alt="Post Image" class="post-image">
                <p class="post-content" style="font-size: 18px; font-weight:bold; margin-top:10px;">
                    {{ $item->title }}</p>
                <p class="post-content">{{ $item->define_this_item }}</p>
            </div>
        </a>
    </div>
@endforeach
