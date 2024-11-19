@if ($paginator->hasPages())
    <nav>
        <ul class="pagination flex items-center justify-center gap-[14px] mt-10">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold bg-[#0E0140] transition-all duration-300" aria-hidden="true">&laquo;</button>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">
                        <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">&laquo;</button>
                    </a>
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
                            <li class="active" aria-current="page">
                                <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold bg-[#7521FF] transition-all duration-300">{{ $page }}</button>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}">
                                    <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">{{ $page }}</button>
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">
                        <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">&raquo;</button>
                    </a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <button class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold bg-[#0E0140] transition-all duration-300" aria-hidden="true">&raquo;</button>
                </li>
            @endif
        </ul>
    </nav>
@endif