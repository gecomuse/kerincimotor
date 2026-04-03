@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-2 flex-wrap" aria-label="Pagination">
    {{-- Previous --}}
    @if ($paginator->onFirstPage())
    <span class="px-4 py-2 rounded-lg border border-white/10 text-brand-text-gray text-sm cursor-not-allowed">
        &laquo; Sebelumnya
    </span>
    @else
    <button wire:click="previousPage" wire:loading.attr="disabled"
            class="px-4 py-2 rounded-lg border border-white/10 text-brand-text-gray text-sm
                   hover:border-brand-red/50 hover:text-white transition-colors">
        &laquo; Sebelumnya
    </button>
    @endif

    {{-- Pages --}}
    @foreach ($elements as $element)
        @if (is_string($element))
        <span class="px-3 py-2 text-brand-text-gray text-sm">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <span class="px-4 py-2 rounded-lg bg-brand-red text-white font-heading font-bold text-sm">
                {{ $page }}
            </span>
            @else
            <button wire:click="gotoPage({{ $page }})"
                    class="px-4 py-2 rounded-lg border border-white/10 text-brand-text-gray text-sm
                           hover:border-brand-red/50 hover:text-white transition-colors">
                {{ $page }}
            </button>
            @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
    <button wire:click="nextPage" wire:loading.attr="disabled"
            class="px-4 py-2 rounded-lg border border-white/10 text-brand-text-gray text-sm
                   hover:border-brand-red/50 hover:text-white transition-colors">
        Berikutnya &raquo;
    </button>
    @else
    <span class="px-4 py-2 rounded-lg border border-white/10 text-brand-text-gray text-sm cursor-not-allowed">
        Berikutnya &raquo;
    </span>
    @endif
</nav>
@endif
