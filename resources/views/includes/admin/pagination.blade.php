{{-- Usage: @include('includes.admin.pagination', ['paginator' => $variable]) --}}
@if ($paginator->hasPages())
    <div style="display:flex;justify-content:space-between;align-items:center;padding-top:1.25rem;border-top:1px solid #e5e7eb;margin-top:.5rem;flex-wrap:wrap;gap:.5rem">
        <div style="font-size:.8rem;color:#6b7280">
            Showing <strong>{{ $paginator->firstItem() ?? 0 }}</strong> – <strong>{{ $paginator->lastItem() ?? 0 }}</strong> of <strong>{{ $paginator->total() }}</strong> entries
        </div>
        <ul class="pagination" style="margin:0;flex-wrap:wrap;gap:2px">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem;color:#9ca3af">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem">&laquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem;color:#9ca3af">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active"><span class="page-link" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem;background:#4f46e5;border-color:#4f46e5;color:#fff">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem">&raquo;</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link" style="border-radius:7px;margin:0;font-size:.8rem;padding:.35rem .65rem;color:#9ca3af">&raquo;</span>
                </li>
            @endif
        </ul>
    </div>
@endif
