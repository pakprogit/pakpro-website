<x-filament::section>
    <x-slot name="heading">
        <span class="text-base font-bold text-gray-900">Quick actions</span>
    </x-slot>

    <div class="space-y-3 pt-2">
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('filament.admin.resources.prices.index') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-[#1474BB] hover:bg-[#0f5c94] text-white text-sm font-semibold rounded-lg shadow-sm transition">
                Update prices
            </a>

            <a href="{{ route('filament.admin.resources.highlights.create') }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-[#D4DF22] hover:bg-[#c3cd1e] text-[#0B2E4F] text-sm font-bold rounded-lg shadow-sm transition">
                Add highlight
            </a>
        </div>

        <div>
            <a href="{{ route('filament.admin.pages.home-page-settings') }}"
               class="inline-flex items-center justify-center w-full px-4 py-2 bg-white hover:bg-gray-50 text-[#1474BB] border border-[#1474BB] text-sm font-medium rounded-lg shadow-sm transition">
                Change hero video
            </a>
        </div>
    </div>
</x-filament::section>

