<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class HomePageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationLabel = 'Homepage';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 1;
    protected static string $view = 'filament.pages.home-page-settings';

    public ?array $data = [];

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && ($user->hasRole('Administrator') || $user->hasRole('Communications editor'));
    }

    public function mount(): void
    {
        $this->form->fill([
            'hero_eyebrow'   => SiteSetting::get('hero_eyebrow', 'Producer Responsibility Organisation'),
            'hero_title'     => SiteSetting::get('hero_title', 'Driving Extended Producer Responsibility in Kenya'),
            'hero_text'      => SiteSetting::get('hero_text', 'PAKPRO is the non-profit producer responsibility organisation established to lead post-consumer packaging collection and recycling.'),
            'hero_btn1_text' => SiteSetting::get('hero_btn1_text', 'Recycled Material Prices'),
            'hero_btn1_url'  => SiteSetting::get('hero_btn1_url', '#prices'),
            'hero_btn2_text' => SiteSetting::get('hero_btn2_text', 'Join PAKPRO'),
            'hero_btn2_url'  => SiteSetting::get('hero_btn2_url', 'https://epr.pakpro.co.ke'),
            'hero_video'     => SiteSetting::get('hero_video', 'hero.mp4'),
            'hero_poster'    => SiteSetting::get('hero_poster', ''),
            'marquee_items'  => SiteSetting::get('marquee_items', []),
            'counters'       => SiteSetting::get('counters', []),
            'contact_email'  => SiteSetting::get('contact_email', 'info@pakpro.co.ke'),
            'contact_phone'  => SiteSetting::get('contact_phone', '+254 20 123 4567'),
            'contact_address'=> SiteSetting::get('contact_address', 'Nairobi, Kenya'),
            'contact_whatsapp'=> SiteSetting::get('contact_whatsapp', '+254 700 000 000'),
            'office_hours'   => SiteSetting::get('office_hours', 'Monday - Friday, 8:00 AM - 5:00 PM'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')->tabs([
                    Forms\Components\Tabs\Tab::make('Hero section')->schema([
                        Forms\Components\TextInput::make('hero_eyebrow')->label('Eyebrow text'),
                        Forms\Components\TextInput::make('hero_title')->label('Headline')->required(),
                        Forms\Components\Textarea::make('hero_text')->label('Body description')->rows(3),
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\TextInput::make('hero_btn1_text')->label('Primary Button Text'),
                            Forms\Components\TextInput::make('hero_btn1_url')->label('Primary Button URL'),
                            Forms\Components\TextInput::make('hero_btn2_text')->label('Secondary Button Text'),
                            Forms\Components\TextInput::make('hero_btn2_url')->label('Secondary Button URL'),
                        ]),
                        Forms\Components\FileUpload::make('hero_video')
                            ->label('Hero Video (MP4 / WebM, max 5MB)')
                            ->acceptedFileTypes(['video/mp4', 'video/webm'])
                            ->maxSize(5120)
                            ->directory('homepage')
                            ->visibility('public')
                            ->helperText('If file is too large: "This video is too big for the website. Please compress it to under 5 MB (720p, 10-15 seconds, no audio)."'),
                        Forms\Components\FileUpload::make('hero_poster')
                            ->label('Video Poster Image (used if video cannot load)')
                            ->image()
                            ->maxSize(5120)
                            ->directory('homepage')
                            ->visibility('public'),
                    ]),

                    Forms\Components\Tabs\Tab::make('Marquee ticker')->schema([
                        Forms\Components\Repeater::make('marquee_items')
                            ->schema([
                                Forms\Components\TextInput::make('text')->required()->label('Announcement Text'),
                                Forms\Components\TextInput::make('link')->label('Link (optional)'),
                            ])
                            ->defaultItems(2)
                            ->collapsible(),
                    ]),

                    Forms\Components\Tabs\Tab::make('Counters')->schema([
                        Forms\Components\Repeater::make('counters')
                            ->schema([
                                Forms\Components\TextInput::make('number')->required()->label('Number / Value (e.g. 50000)'),
                                Forms\Components\TextInput::make('prefix')->label('Prefix (e.g. + or KES)'),
                                Forms\Components\TextInput::make('suffix')->label('Suffix (e.g. + or MT)'),
                                Forms\Components\TextInput::make('label')->required()->label('Metric description'),
                            ])
                            ->columns(4)
                            ->collapsible(),
                    ]),

                    Forms\Components\Tabs\Tab::make('Contact & Office details')->schema([
                        Forms\Components\TextInput::make('contact_email')->email()->label('Email address'),
                        Forms\Components\TextInput::make('contact_phone')->label('Phone number'),
                        Forms\Components\TextInput::make('contact_whatsapp')->label('WhatsApp number'),
                        Forms\Components\TextInput::make('office_hours')->label('Office hours'),
                        Forms\Components\Textarea::make('contact_address')->label('Physical office address')->rows(2),
                    ]),
                ]),
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        foreach ($state as $key => $value) {
            SiteSetting::set($key, $value);
        }

        Notification::make()
            ->title('Homepage settings updated!')
            ->body('Changes are live on the public site.')
            ->success()
            ->send();
    }
}

