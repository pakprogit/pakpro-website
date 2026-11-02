<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HighlightResource\Pages;
use App\Models\Highlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class HighlightResource extends Resource
{
    protected static ?string $model = Highlight::class;
    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Highlights';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && (
            $user->hasRole('Administrator') ||
            $user->hasRole('Communications editor')
        );
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Highlight details')->schema([
                Forms\Components\Select::make('type')
                    ->options([
                        'policy'   => 'Policy',
                        'projects' => 'Projects & Partnerships',
                        'bcc'      => 'BCC Campaigns',
                    ])
                    ->required()
                    ->label('Section'),

                Forms\Components\DatePicker::make('month')
                    ->required()
                    ->label('Month (first of month)')
                    ->default(now()->startOfMonth()),

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('summary')
                    ->rows(3)
                    ->maxLength(500),

                Forms\Components\Select::make('media_type')
                    ->options([
                        'image' => 'Image',
                        'video' => 'Video',
                    ])
                    ->reactive()
                    ->label('Media type'),

                Forms\Components\FileUpload::make('media_path')
                    ->image()
                    ->maxSize(5120)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->label('Upload image')
                    ->directory('highlights')
                    ->visibility('public')
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'image'),

                Forms\Components\TextInput::make('alt_text')
                    ->label('Alt text (required for images)')
                    ->maxLength(255)
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'image')
                    ->required(fn (Forms\Get $get) => $get('media_type') === 'image'),

                Forms\Components\FileUpload::make('video_file')
                    ->maxSize(5120)
                    ->acceptedFileTypes(['video/mp4', 'video/webm'])
                    ->label('Upload video (max 5MB, 720p)')
                    ->directory('highlights/videos')
                    ->visibility('public')
                    ->hint('For longer videos, use a YouTube/Vimeo link instead.')
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),

                Forms\Components\TextInput::make('video_url')
                    ->url()
                    ->label('YouTube/Vimeo/MP4 link (optional)')
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),

                Forms\Components\FileUpload::make('poster')
                    ->image()
                    ->maxSize(5120)
                    ->label('Video poster image')
                    ->directory('highlights/posters')
                    ->visibility('public')
                    ->visible(fn (Forms\Get $get) => $get('media_type') === 'video'),

                Forms\Components\TextInput::make('link_url')
                    ->url()
                    ->label('Read more link'),

                Forms\Components\Select::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                    ])
                    ->default('draft')
                    ->required(),

                Forms\Components\Toggle::make('is_placeholder')
                    ->label('Placeholder (never shown on public site)')
                    ->helperText('Placeholders are for admin reference only')
                    ->visible(fn () => Auth::user()?->hasRole('Administrator')),
            ])->columns(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('type')
                    ->colors([
                        'primary' => 'policy',
                        'success' => 'projects',
                        'warning' => 'bcc',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'policy'   => 'Policy',
                        'projects' => 'Projects',
                        'bcc'      => 'BCC',
                        default    => $state,
                    }),
                Tables\Columns\TextColumn::make('title')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('month')
                    ->date('M Y')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'draft',
                        'success' => 'published',
                    ]),
                Tables\Columns\IconColumn::make('is_placeholder')
                    ->boolean()
                    ->label('Placeholder'),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'policy'   => 'Policy',
                        'projects' => 'Projects & Partnerships',
                        'bcc'      => 'BCC Campaigns',
                    ]),
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'published' => 'Published',
                    ]),
            ])
            ->defaultSort('month', 'desc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlight::route('/create'),
            'edit'   => Pages\EditHighlight::route('/{record}/edit'),
        ];
    }
}

