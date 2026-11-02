<x-filament-panels::page>
    <div class="flex justify-between items-center mb-4">
        <p class="text-sm text-gray-600">Edit homepage content and settings. Edits appear on the live site immediately.</p>
        <a href="{{ url('/') }}" target="_blank" class="inline-flex items-center gap-1 text-sm font-semibold text-[#1474BB] hover:underline">
            <x-heroicon-m-arrow-top-right-on-square class="w-4 h-4" />
            Live site preview
        </a>
    </div>

    <form wire:submit.prevent="submit" class="space-y-6">
        {{ $this->form }}

        <div class="flex gap-3">
            <x-filament::button type="submit" color="primary">
                Save and publish changes
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>

