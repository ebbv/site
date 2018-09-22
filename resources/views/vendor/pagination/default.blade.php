@if ($paginator->hasPages())
  <ul class="pagination" role="navigation">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span aria-hidden="true" class="material-icons">chevron_left</span>
      </li>
    @else
      <li>
        <a class="material-icons" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">chevron_left</a>
      </li>
    @endif

    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
      {{-- "Three Dots" Separator --}}
      @if (is_string($element))
          <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
      @endif

      {{-- Array Of Links --}}
      @if (is_array($element))
        @foreach ($element as $page => $url)
          @if ($page == $paginator->currentPage())
            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
          @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
          @endif
        @endforeach
      @endif
    @endforeach

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li>
        <a class="material-icons" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">chevron_right</a>
      </li>
    @else
      <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
        <span aria-hidden="true" class="material-icons">chevron_right</span>
      </li>
    @endif
  </ul>
@endif
