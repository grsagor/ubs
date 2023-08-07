<div>
    <ul class="navprev">
        @if ($pagination['currentPage'] > 1)
            <li><a href="{{ $data->url(1) }}">&lt;| First</a></li>
            <li><a href="{{ $data->previousPageUrl() }}">&lt;&lt; Prev</a></li>
        @endif
    </ul>
    <ul class="navnext">
        @if ($pagination['currentPage'] < $data->lastPage())
            <li>
                <strong><a href="{{ $data->nextPageUrl() }}">Next &gt;&gt;</a></strong>
            </li>
        @endif
    </ul>
    <p class="navcurrent">
        Showing <strong>{{ $pagination['from'] }} - {{ $pagination['to'] }}</strong> of
        <strong>{{ $pagination['total'] > $data->count() ? $pagination['total'] . '' : $pagination['total'] }}</strong>
        results
    </p>
</div>
