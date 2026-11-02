<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MediaLibraryPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Media library';
    protected static ?string $navigationGroup = 'Manage';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.media-library-page';

    public $search = '';

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && ($user->hasRole('Administrator') || $user->hasRole('Communications editor'));
    }

    public function getFilesProperty(): array
    {
        $files = [];
        $disk = Storage::disk('public');
        
        $directories = ['', 'highlights', 'homepage', 'highlights/videos', 'highlights/posters'];
        
        foreach ($directories as $dir) {
            foreach ($disk->files($dir) as $filePath) {
                if ($this->search && !str_contains(strtolower($filePath), strtolower($this->search))) {
                    continue;
                }
                
                $mime = $disk->mimeType($filePath) ?? 'application/octet-stream';
                $size = $disk->size($filePath);
                $modified = $disk->lastModified($filePath);

                $files[] = [
                    'path' => $filePath,
                    'name' => basename($filePath),
                    'url' => $disk->url($filePath),
                    'mime' => $mime,
                    'size' => round($size / 1024, 1) . ' KB',
                    'date' => date('d M Y, H:i', $modified),
                ];
            }
        }

        return $files;
    }

    public function deleteFile(string $path): void
    {
        Storage::disk('public')->delete($path);
        Notification::make()->title('File deleted')->success()->send();
    }
}

