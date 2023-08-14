@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li style="margin-left:5px;margin-right:5px" class="disabled"><i class="slider-prev fas fa-arrow-left slick-arrow" style=""></i></li>
        @else
            <li style="margin-left:5px;margin-right:5px"><a href="{{ $paginator->previousPageUrl() }}" class="slider-prev fas fa-arrow-left slick-arrow" rel="prev"></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li style="margin-left:5px;margin-right:5px" class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li style="margin-left:5px;margin-right:5px" class="active"><span>{{ $page }}</span></li>
                    @else
                        <li style="margin-left:5px;margin-right:5px"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li style="margin-left:5px;margin-right:5px"><a href="{{ $paginator->nextPageUrl() }}" class="slider-next fas fa-arrow-right slick-arrow" rel="next"></a></li>
        @else
            <li style="margin-left:5px;margin-right:5px" class="disabled"><i class="slider-next fas fa-arrow-right slick-arrow" style=""></i></li>
        @endif
    </ul>
@endif
