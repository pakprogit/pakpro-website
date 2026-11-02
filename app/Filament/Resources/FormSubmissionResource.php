<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FormSubmissionResource\Pages;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;
    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';
    protected static ?string $navigationLabel = 'Forms inbox';
    protected static ?string $navigationGroup = 'Manage';
    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && ($user->hasRole('Administrator') || $user->hasRole('Communications editor'));
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $user = Auth::user();

        // Non-grievance users cannot see grievance/whistleblower submissions
        if (!$user->can('view-grievances')) {
            $query->whereNotIn('form_type', ['grievance', 'whistleblower']);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('form_type')->disabled(),
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\Textarea::make('message')->rows(5)->disabled(),
            Forms\Components\KeyValue::make('data')->label('Additional Fields')->disabled(),
            Forms\Components\Toggle::make('is_read')->label('Mark as read'),
            Forms\Components\TextInput::make('created_at')->disabled(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('form_type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'contact',
                        'success' => 'agent_registration',
                        'danger'  => 'grievance',
                        'warning' => 'whistleblower',
                    ]),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->label('Received'),
                Tables\Columns\IconColumn::make('is_read')->boolean()->label('Read'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('form_type')
                    ->options([
                        'contact' => 'Contact Enquiry',
                        'agent_registration' => 'Agent Registration',
                        'grievance' => 'Grievance Report',
                        'whistleblower' => 'Whistleblower Report',
                    ]),
                Tables\Filters\TernaryFilter::make('is_read')->label('Read status'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFormSubmissions::route('/'),
        ];
    }
}

