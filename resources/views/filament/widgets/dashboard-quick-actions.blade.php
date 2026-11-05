<x-filament::section>
    <x-slot name="heading">
        <span class="text-sm font-bold tracking-wide uppercase" style="color:#0B2E4F;letter-spacing:.06em">Quick actions</span>
    </x-slot>

    <div class="flex flex-col gap-3 pt-1">
        <a href="{{ route('filament.admin.resources.prices.index') }}"
           class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-semibold text-white transition hover:opacity-90 active:scale-95"
           style="background:#1474BB;box-shadow:0 2px 8px rgba(20,116,187,.25)">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Update prices
        </a>

        <a href="{{ route('filament.admin.resources.highlights.create') }}"
           class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-bold transition hover:opacity-90 active:scale-95"
           style="background:#D4DF22;color:#0B2E4F;box-shadow:0 2px 8px rgba(212,223,34,.3)">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add highlight
        </a>

        <a href="{{ route('filament.admin.pages.home-page-settings') }}"
           class="flex items-center gap-3 w-full rounded-xl px-4 py-3 text-sm font-semibold transition hover:bg-blue-50 active:scale-95"
           style="background:#f0f7ff;color:#1474BB;border:1.5px solid #bfdbfe">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
            </svg>
            Change hero video
        </a>
    </div>
</x-filament::section>

