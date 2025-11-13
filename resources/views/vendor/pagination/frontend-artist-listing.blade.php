@if ($paginator->hasPages())
    <ul class="uk-pagination uk-flex-center uk-margin" style="padding-top: 30px;">
        @if ($paginator->onFirstPage())
{{--            <li class="uk-disabled"><a><span uk-pagination-previous></span></a></li>--}}
        @else
            <li>
                <a class="page-link prev page-numbers" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                    <svg width="7" height="12" viewBox="0 0 7 12" xmlns="http://www.w3.org/2000/svg"><polyline fill="none" stroke="#000" stroke-width="1.2" points="6 1 1 6 6 11"></polyline></svg>
                </a>
            </li>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="uk-disabled"><a>{{ $element }}</a></li>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="uk-active"><a class="page-numbers current"><b>{{ $page }}</b></a></li>
                    @else
                        <li><a class="page-link page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li>
                <a class="page-link next page-numbers" href="{{ $paginator->nextPageUrl() }}" rel="next">
                    <span uk-pagination-next class="uk-pagination-next uk-icon">
                        <svg width="7" height="12"
                             viewBox="0 0 7 12"
                             xmlns="http://www.w3.org/2000/svg"><polyline
                                fill="none" stroke="#000" stroke-width="1.2" points="1 1 6 6 1 11"></polyline></svg>
                    </span>
                </a>
            </li>
        @else
{{--            <li class="uk-disabled"><a><span uk-pagination-next></span></a></li>--}}
        @endif
    </ul>
@endif
