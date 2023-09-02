@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="">
                {{-- {!! __('pagination.previous') !!} --}}
                <span> <i class="fa fa-arrow-left" aria-hidden="true"></i> Chương trước</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="">
                {{-- {!! __('pagination.previous') !!} --}}
                <span> <i class="fa fa-arrow-left" aria-hidden="true"></i> Chương trước</span>
            </a>
        @endif
        |
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="">
                <span> Chương tiếp theo <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>
        @else
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="">
                <span> Chương tiếp theo <i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </a>
        @endif
    </nav>
@endif
