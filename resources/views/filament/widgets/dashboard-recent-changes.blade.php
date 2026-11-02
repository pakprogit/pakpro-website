<x-filament::section>
    <x-slot name="heading">
        <span class="text-base font-bold text-gray-900">Recent changes</span>
    </x-slot>

    <div class="space-y-2 pt-2">
        @forelse ($this->recentChanges as $change)
            <div class="text-xs text-gray-600 flex items-center justify-between border-b border-gray-100 pb-1.5 last:border-b-0">
                <span class="font-medium text-gray-800">{{ $change->description }}</span>
                <span class="text-gray-400">
                    {{ $change->causer?->name ?? 'System' }} · {{ $change->created_at->diffForHumans(null, true) }}
                </span>
            </div>
        @empty
            <div class="space-y-1.5 text-xs text-gray-500">
                <div class="text-gray-400">No recent changes logged yet.</div>
            </div>
        @endforelse
    </div>
</x-filament::section>

