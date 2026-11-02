<?php

namespace App\Filament\Resources;

use App\Exports\PricesExport;
use App\Filament\Resources\PriceResource\Pages;
use App\Imports\PricesImport;
use App\Models\Price;
use App\Models\PricePublication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class PriceResource extends Resource
{
    protected static ?string $model = Price::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Prices';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && (
            $user->hasRole('Administrator') ||
            $user->hasRole('Communications editor') ||
            $user->hasRole('Price editor')
        );
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('material')
                ->required()->maxLength(255),
            Forms\Components\TextInput::make('slug')
                ->required()->maxLength(255),
            Forms\Components\Grid::make(4)->schema([
                Forms\Components\TextInput::make('recycler_min')
                    ->numeric()->nullable()->step(0.01)->label('Recycler Min'),
                Forms\Components\TextInput::make('recycler_max')
                    ->numeric()->nullable()->step(0.01)->label('Recycler Max'),
                Forms\Components\TextInput::make('aggregator_min')
                    ->numeric()->nullable()->step(0.01)->label('Aggregator Min'),
                Forms\Components\TextInput::make('aggregator_max')
                    ->numeric()->nullable()->step(0.01)->label('Aggregator Max'),
            ]),
            Forms\Components\TextInput::make('note')->maxLength(500)->columnSpanFull(),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true)->label('Active'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('sort_order')->sortable()->label('#'),
                Tables\Columns\TextColumn::make('material')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('recycler_formatted')->label('Recycler (KES/kg)'),
                Tables\Columns\TextColumn::make('aggregator_formatted')->label('Aggregator (KES/kg)'),
                Tables\Columns\BadgeColumn::make('check_status')
                    ->label('Check')
                    ->colors([
                        'success' => 'OK',
                        'danger'  => 'Missing',
                        'warning' => 'Confirm',
                    ]),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Active'),
            ])
            ->defaultSort('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('save_and_publish')
                    ->label('Save and publish')
                    ->color('primary')
                    ->icon('heroicon-o-arrow-up-circle')
                    ->requiresConfirmation()
                    ->modalHeading('Confirm Publication')
                    ->modalDescription('This will publish current prices to the public website immediately and notify administrators.')
                    ->modalSubmitActionLabel('Yes, publish now')
                    ->action(function () {
                        $prices = Price::where('is_active', true)->get();
                        $snapshot = $prices->map(fn ($p) => [
                            'id'            => $p->id,
                            'material'      => $p->material,
                            'recycler_min'  => $p->recycler_min,
                            'recycler_max'  => $p->recycler_max,
                            'aggregator_min' => $p->aggregator_min,
                            'aggregator_max' => $p->aggregator_max,
                        ])->toArray();

                        PricePublication::create([
                            'user_id'         => Auth::id(),
                            'snapshot'        => $snapshot,
                            'change_summary'  => 'Published by ' . Auth::user()->name,
                            'published_at'    => now(),
                        ]);

                        Cache::forget('public_prices');
                        Cache::forget('price_last_updated');

                        Notification::make()
                            ->title('Prices published successfully!')
                            ->body('Public website price ticker and table updated.')
                            ->success()
                            ->send();
                    })
                    ->visible(fn () => Auth::user()?->can('publish', Price::class)),

                Tables\Actions\Action::make('import_excel')
                    ->label('Import Excel')
                    ->icon('heroicon-o-arrow-up-tray')
                    ->color('gray')
                    ->form([
                        Forms\Components\FileUpload::make('file')
                            ->label('Excel or CSV file')
                            ->acceptedFileTypes([
                                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                'text/csv',
                                'text/plain',
                                'application/vnd.ms-excel',
                            ])
                            ->required()
                            ->storeFiles(false),
                    ])
                    ->action(function (array $data) {
                        try {
                            Excel::import(new PricesImport, $data['file']);
                            Cache::forget('public_prices');
                            Notification::make()
                                ->title('Prices imported successfully!')
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Import failed')
                                ->body($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

                Tables\Actions\Action::make('export')
                    ->label('Export')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('gray')
                    ->action(function () {
                        return Excel::download(new PricesExport, 'pakpro-prices-' . now()->format('Y-m-d') . '.xlsx');
                    }),
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
            'index'  => Pages\ListPrices::route('/'),
            'create' => Pages\CreatePrice::route('/create'),
            'edit'   => Pages\EditPrice::route('/{record}/edit'),
        ];
    }
}
