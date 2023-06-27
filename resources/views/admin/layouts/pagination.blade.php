<div class=" col-md-12">
    <nav aria-label="Page navigation mb-3">
        <ul class="pagination justify-content-center">
            {{--            <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><</a>--}}
            {{--            </li>--}}

            @if ($paginator->onFirstPage())
                <li class="page-item disabled"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><</a>
                </li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $paginator->previousPageUrl() }}"><</a></li>
            @endif
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">></a>
                </li>
            @else
                <li class="page-item disabled">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">></a>
                </li>
            @endif
        </ul>
    </nav>
</div>
