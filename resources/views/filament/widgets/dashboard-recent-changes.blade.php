<x-filament::section>
    <x-slot name="heading">
        <span class="text-sm font-bold tracking-wide uppercase" style="color:#0B2E4F;letter-spacing:.06em">Recent changes</span>
    </x-slot>

    <div class="divide-y divide-gray-100">
        @forelse ($this->recentChanges as $change)
            <div class="py-3 first:pt-1 last:pb-0">
                <div class="flex items-start justify-between gap-3">
                    <p class="text-sm font-medium leading-snug flex-1" style="color:#1e3a5f">
                        {{ $change->description }}
                    </p>
                    <span class="flex-shrink-0 text-xs font-medium px-2 py-0.5 rounded-full"
                          style="background:#EEF4FA;color:#5b7189;white-space:nowrap">
                        {{ $change->created_at->diffForHumans(null, true) }}
                    </span>
                </div>
                <p class="mt-1 text-xs" style="color:#7a94ac">
                    {{ $change->causer?->name ?? 'System' }}
                </p>
            </div>
        @empty
            <div class="py-6 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mx-auto mb-2" style="color:#c3d3e4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <p class="text-sm" style="color:#7a94ac">No recent changes logged yet.</p>
            </div>
        @endforelse
    </div>
</x-filament::section>

