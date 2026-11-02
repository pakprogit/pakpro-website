<x-filament-panels::page>
    <div class="space-y-4">
        <div class="flex items-center justify-between gap-4">
            <div class="w-72">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search media files..."
                       class="w-full text-xs rounded-lg border-gray-300 shadow-sm focus:border-[#1474BB] focus:ring-[#1474BB]" />
            </div>
            <span class="text-xs text-gray-500">MIME-validated storage. Max: Images 5MB (JPG/PNG/WebP), Videos 5MB (MP4/WebM), Docs 20MB (PDF).</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @forelse ($this->files as $file)
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-sm flex flex-col justify-between">
                    <div class="h-32 bg-gray-50 flex items-center justify-center p-2 overflow-hidden">
                        @if (str_starts_with($file['mime'], 'image/'))
                            <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" class="max-h-full object-contain" />
                        @elseif (str_starts_with($file['mime'], 'video/'))
                            <x-heroicon-o-video-camera class="w-12 h-12 text-gray-400" />
                        @else
                            <x-heroicon-o-document class="w-12 h-12 text-gray-400" />
                        @endif
                    </div>
                    <div class="p-2.5 border-t border-gray-100 bg-white">
                        <div class="text-xs font-semibold truncate text-gray-900" title="{{ $file['name'] }}">
                            {{ $file['name'] }}
                        </div>
                        <div class="text-[10px] text-gray-400 mt-0.5 flex justify-between">
                            <span>{{ $file['size'] }}</span>
                            <span>{{ $file['date'] }}</span>
                        </div>
                        <div class="mt-2 pt-2 border-t border-gray-100 flex justify-between items-center text-xs">
                            <a href="{{ $file['url'] }}" target="_blank" class="text-[#1474BB] hover:underline text-[11px]">View</a>
                            <button wire:click="deleteFile('{{ $file['path'] }}')" wire:confirm="Are you sure you want to delete this file?" class="text-red-500 hover:text-red-700 text-[11px]">Delete</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-400 text-xs">
                    No uploaded media files found.
                </div>
            @endforelse
        </div>
    </div>
</x-filament-panels::page>

