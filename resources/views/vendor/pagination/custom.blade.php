@if ($paginator->hasPages())
<nav style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; font-family: 'Inter', sans-serif;">

    {{-- Info --}}
    <div style="font-size: 13px; color: #64748b;">
        Menampilkan
        <strong>{{ $paginator->firstItem() }}</strong>
        hingga
        <strong>{{ $paginator->lastItem() }}</strong>
        dari
        <strong>{{ $paginator->total() }}</strong>
        hasil
    </div>

    {{-- Page Buttons --}}
    <div style="display: flex; align-items: center; gap: 6px;">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span style="padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; background: #f1f5f9; color: #cbd5e1; cursor: not-allowed; border: 1px solid #e2e8f0;">
                &laquo; Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               style="padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; background: #fff; color: #475569; border: 1px solid #e2e8f0; text-decoration: none; transition: all 0.2s;"
               onmouseover="this.style.background='#076653';this.style.color='#fff';this.style.borderColor='#076653';"
               onmouseout="this.style.background='#fff';this.style.color='#475569';this.style.borderColor='#e2e8f0';">
                &laquo; Prev
            </a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span style="padding: 7px 10px; font-size: 13px; color: #94a3b8;">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span style="padding: 7px 13px; border-radius: 8px; font-size: 13px; font-weight: 700; background: #076653; color: #fff; border: 1px solid #076653;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}"
                           style="padding: 7px 13px; border-radius: 8px; font-size: 13px; font-weight: 600; background: #fff; color: #475569; border: 1px solid #e2e8f0; text-decoration: none; transition: all 0.2s;"
                           onmouseover="this.style.background='#076653';this.style.color='#fff';this.style.borderColor='#076653';"
                           onmouseout="this.style.background='#fff';this.style.color='#475569';this.style.borderColor='#e2e8f0';">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               style="padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; background: #fff; color: #475569; border: 1px solid #e2e8f0; text-decoration: none; transition: all 0.2s;"
               onmouseover="this.style.background='#076653';this.style.color='#fff';this.style.borderColor='#076653';"
               onmouseout="this.style.background='#fff';this.style.color='#475569';this.style.borderColor='#e2e8f0';">
                Next &raquo;
            </a>
        @else
            <span style="padding: 7px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; background: #f1f5f9; color: #cbd5e1; cursor: not-allowed; border: 1px solid #e2e8f0;">
                Next &raquo;
            </span>
        @endif

    </div>
</nav>
@endif
