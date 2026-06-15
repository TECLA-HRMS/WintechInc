{{-- Usage: @include('includes.admin.pagination', ['paginator' => $variable]) --}}
@if($paginator->hasPages())
<div style="display:flex;justify-content:space-between;align-items:center;padding-top:1.25rem;border-top:1px solid #e5e7eb;margin-top:.5rem;flex-wrap:wrap;gap:.5rem">
    <div style="font-size:.8rem;color:#6b7280">
        Showing <strong>{{ $paginator->firstItem() ?? 0 }}</strong> – <strong>{{ $paginator->lastItem() ?? 0 }}</strong> of <strong>{{ $paginator->total() }}</strong> entries
    </div>
    <ul class="pagination" style="margin:0">
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}" style="border-radius:7px;margin:0 2px;font-size:.8rem;padding:.35rem .65rem">&laquo;</a>
        </li>
        @foreach($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
        <li class="page-item {{ $paginator->currentPage() == $page ? 'active' : '' }}">
            <a class="page-link" href="{{ $url }}&{{ http_build_query(request()->except('page')) }}" style="border-radius:7px;margin:0 2px;font-size:.8rem;padding:.35rem .65rem;{{ $paginator->currentPage() == $page ? 'background:#4f46e5;border-color:#4f46e5;color:#fff' : '' }}">{{ $page }}</a>
        </li>
        @endforeach
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}" style="border-radius:7px;margin:0 2px;font-size:.8rem;padding:.35rem .65rem">&raquo;</a>
        </li>
    </ul>
</div>
@endif
