@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled material-icons"><span>chevron_left</span></li>
        @else
            <li><a class="material-icons" href="{{ $paginator->previousPageUrl() }}" rel="prev">chevron_left</a></li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="material-icons" href="{{ $paginator->nextPageUrl() }}" rel="next">chevron_right</a></li>
        @else
            <li class="disabled material-icons"><span>chevron_right</span></li>
        @endif
    </ul>
@endif
