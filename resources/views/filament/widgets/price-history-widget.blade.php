<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
    <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-900 mb-3">Before you publish</h3>
        <ul class="space-y-2 text-xs text-gray-600">
            @foreach ($this->checkList as $check)
                <li class="flex items-center gap-2">
                    @if ($check['status'] === 'error')
                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                        <span class="text-red-700 font-semibold">{{ $check['text'] }}</span>
                    @elseif ($check['status'] === 'warning')
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        <span>{{ $check['text'] }}</span>
                    @else
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>{{ $check['text'] }}</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white rounded-xl p-5 border border-gray-200 shadow-sm">
        <h3 class="text-sm font-bold text-gray-900 mb-2">History</h3>
        @if ($latest = $this->latestPublication)
            <div class="text-xs text-gray-600 mb-3">
                <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($latest->published_at)->format('d M Y, H:i') }}</span>
                · {{ $latest->user?->name ?? 'System' }}
                · {{ count($latest->snapshot ?? []) }} prices published
            </div>
        @else
            <div class="text-xs text-gray-500 mb-3">
                No publication snapshot recorded yet. The public site currently displays "Last updated: Date to be confirmed".
            </div>
        @endif

        <div class="pt-1">
            <span class="text-xs text-gray-400">Historical snapshots are retained for auditing and rollback.</span>
        </div>
    </div>
</div>

