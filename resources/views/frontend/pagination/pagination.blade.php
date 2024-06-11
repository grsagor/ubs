{{-- <div class="col-lg-12 mt-3 text-center">
    <div class="d-flex align-items-start pt-3" id="custom-pagination">
        <div class="pagination-style-one mx-auto shop-list-page">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($paginator->lastPage() > 1)
                        <li class="page-item{{ $paginator->currentPage() == 1 ? ' hide' : '' }}">
                            <a class="page-link" href="{{ $paginator->url(1) }}" aria-label="First">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = max(1, $paginator->currentPage() - 1); $i <= min($paginator->lastPage(), $paginator->currentPage() + 1); $i++)
                            <li class="page-item{{ $paginator->currentPage() == $i ? ' active' : '' }}">
                                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li
                            class="page-item{{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
                            <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div> --}}


<div class="col-lg-12 mt-3 text-center">
    <div class="d-flex align-items-start pt-3" id="custom-pagination">
        <div class="pagination-style-one mx-auto shop-list-page">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    @if ($paginator->lastPage() > 1)
                        <li class="page-item{{ $paginator->currentPage() == 1 ? ' disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $paginator->currentPage() == 1 ? '#' : $paginator->url($paginator->currentPage() - 1) }}"
                                aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @for ($i = max(1, $paginator->currentPage() - 1); $i <= min($paginator->lastPage(), $paginator->currentPage() + 1); $i++)
                            <li class="page-item{{ $paginator->currentPage() == $i ? ' active' : '' }}">
                                <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li
                            class="page-item{{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
                            <a class="page-link"
                                href="{{ $paginator->currentPage() == $paginator->lastPage() ? '#' : $paginator->url($paginator->currentPage() + 1) }}"
                                aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
