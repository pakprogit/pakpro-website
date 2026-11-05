<x-filament::section>
    <x-slot name="heading">
        <span class="text-sm font-bold tracking-wide uppercase" style="color:#0B2E4F;letter-spacing:.06em">Needs attention</span>
    </x-slot>

    <div class="divide-y divide-gray-100">
        @forelse ($this->attentionItems as $item)
            <div class="flex items-start gap-3 py-3 first:pt-1 last:pb-0">
                <span class="mt-0.5 flex-shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold"
                      style="background:#FEF3C7;color:#92400E;border:1px solid #FDE68A">
                    Check
                </span>
                <a href="{{ $item['link'] }}"
                   class="text-sm leading-snug flex-1 hover:underline"
                   style="color:#1e3a5f">
                    {{ $item['text'] }}
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-4 h-4 mt-0.5" style="color:#1474BB" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </div>
        @empty
            <div class="flex items-center gap-2 py-4 text-sm" style="color:#3d7a52">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" style="color:#16a34a" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                All checks passed — no urgent items.
            </div>
        @endforelse
    </div>
</x-filament::section>

