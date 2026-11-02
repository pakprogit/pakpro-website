<x-filament::section>
    <x-slot name="heading">
        <span class="text-base font-bold text-gray-900">Needs attention</span>
    </x-slot>

    <div class="space-y-3 pt-2">
        @forelse ($this->attentionItems as $item)
            <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 transition">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold bg-[#FEF3C7] text-[#92400E] border border-[#FDE68A]">
                    Check
                </span>
                <a href="{{ $item['link'] }}" class="text-sm text-gray-700 hover:text-[#1474BB] hover:underline flex-1">
                    {{ $item['text'] }}
                </a>
            </div>
        @empty
            <div class="text-sm text-gray-500 py-3 flex items-center gap-2">
                <x-heroicon-o-check-circle class="w-5 h-5 text-green-500" />
                All checks passed! No urgent items need your attention.
            </div>
        @endforelse
    </div>
</x-filament::section>

