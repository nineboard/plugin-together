@if ($paginator->hasPages())
<!-- board-paging-tfc -->
<div class="board-paging-tfc">
    @if($paginator->currentPage() <= 1)
        <a class="link-arr link-prev link-nomore"><i class="xi-angle-left"><span class="blind">이전</span></i></a>
    @else
        <a href="{{ $paginator->previousPageUrl() }}" class="link-arr link-prev"><i class="xi-angle-left"><span class="blind">이전</span></i></a>
    @endif

    <div class="box-paging">
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <a href="{{ htmlentities($url) }}" @if ($page == $paginator->currentPage()) class="active" @endif>{{ $page }}</a>
                @endforeach
            @endif
        @endforeach
    </div>
    @if(!$paginator->hasMorePages())
        <a class="link-arr link-next link-nomore"><i class="xi-angle-right"><span class="blind">다음</span></i></a>
    @else
        <a href="#" class="link-arr link-next"><i class="xi-angle-right"><span class="blind">다음</span></i></a>
    @endif
</div>
<!-- // board-paging-tfc -->
@endif
