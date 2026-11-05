<?php

namespace App\Providers\Filament;

use App\Filament\Pages\AuditLog;
use App\Filament\Pages\HomePageSettings;
use App\Filament\Pages\MediaLibraryPage;
use App\Filament\Pages\PakproDashboard;
use App\Filament\Resources\FormSubmissionResource;
use App\Filament\Resources\HighlightResource;
use App\Filament\Resources\PriceResource;
use App\Filament\Resources\UserResource;
use App\Filament\Widgets\DashboardNeedsAttentionWidget;
use App\Filament\Widgets\DashboardQuickActionsWidget;
use App\Filament\Widgets\DashboardRecentChangesWidget;
use App\Filament\Widgets\DashboardStatsWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('PAKPRO Admin')
            ->brandLogo(fn () => view('filament.brand'))
            ->brandLogoHeight('2.5rem')
            ->favicon(asset('assets/favicon.ico'))
            ->colors([
                'primary'   => Color::hex('#1474BB'),
                'secondary' => Color::hex('#0B2E4F'),
                'warning'   => Color::hex('#D4DF22'),
                'success'   => Color::hex('#16a34a'),
                'danger'    => Color::hex('#dc2626'),
                'info'      => Color::hex('#1474BB'),
                'gray'      => Color::Slate,
            ])
            ->darkMode(false)
            ->sidebarCollapsibleOnDesktop()
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                PakproDashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                DashboardStatsWidget::class,
                DashboardNeedsAttentionWidget::class,
                DashboardQuickActionsWidget::class,
                DashboardRecentChangesWidget::class,
            ])
            ->navigationGroups([
                \Filament\Navigation\NavigationGroup::make('Content'),
                \Filament\Navigation\NavigationGroup::make('Manage'),
            ])
            ->renderHook(
                PanelsRenderHook::USER_MENU_BEFORE,
                fn () => view('filament.topbar-view-site')
            )
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<style>
                    :root {
                        --pakpro-navy: #0B2E4F;
                        --pakpro-blue: #1474BB;
                        --pakpro-lime: #D4DF22;
                        --pakpro-bg: #F3F6FA;
                    }
                    body {
                        background-color: var(--pakpro-bg) !important;
                        font-family: Inter, Aptos, "Segoe UI", sans-serif !important;
                    }

                    /* ── Sidebar shell ── */
                    .fi-sidebar {
                        background-color: var(--pakpro-navy) !important;
                        border-right: none !important;
                    }
                    .fi-sidebar-header {
                        background-color: var(--pakpro-navy) !important;
                        border-bottom: 1px solid rgba(255,255,255,0.08) !important;
                    }

                    /* ── Nav items ── */
                    .fi-sidebar-item-btn {
                        color: #cbd5e1 !important;
                        border-radius: 0.5rem !important;
                        margin: 2px 8px !important;
                    }
                    .fi-sidebar-item-btn:hover {
                        background-color: rgba(255,255,255,0.08) !important;
                        color: #ffffff !important;
                    }
                    .fi-sidebar-item-active .fi-sidebar-item-btn,
                    .fi-sidebar-item-btn.fi-active {
                        background-color: var(--pakpro-blue) !important;
                        color: #ffffff !important;
                        font-weight: 600 !important;
                    }
                    .fi-sidebar-item-active .fi-sidebar-item-icon,
                    .fi-sidebar-item-btn.fi-active .fi-sidebar-item-icon {
                        color: #ffffff !important;
                    }
                    /* icons for non-active items */
                    .fi-sidebar-item-icon {
                        color: #94a3b8 !important;
                    }
                    .fi-sidebar-item-btn:hover .fi-sidebar-item-icon {
                        color: #ffffff !important;
                    }

                    /* ── Group labels – white on dark sidebar ── */
                    .fi-sidebar-group-label,
                    .fi-sidebar-group > div > span,
                    [class*="fi-sidebar-group"] span {
                        color: rgba(255,255,255,0.45) !important;
                        text-transform: uppercase !important;
                        font-size: 0.68rem !important;
                        letter-spacing: 0.08em !important;
                        font-weight: 700 !important;
                        padding-left: 1rem !important;
                    }
                    /* group collapse chevron */
                    .fi-sidebar-group-collapse-button svg {
                        color: rgba(255,255,255,0.4) !important;
                    }

                    /* ── Topbar ── */
                    .fi-topbar {
                        background-color: #ffffff !important;
                        border-bottom: 1px solid #e2e8f0 !important;
                    }

                    /* ── Dashboard widget cards ── */
                    .fi-wi-stats-overview-stat,
                    .fi-section {
                        background: #ffffff !important;
                        border: 1px solid #e2eaf3 !important;
                        border-radius: 14px !important;
                        box-shadow: 0 4px 16px rgba(11,46,79,0.07) !important;
                        overflow: hidden !important;
                    }
                    /* section headings inside widgets */
                    .fi-section-header {
                        border-bottom: 1px solid #e9eff6 !important;
                        padding: 14px 20px 12px !important;
                        background: #f8fafc !important;
                    }
                    .fi-section-content {
                        padding: 16px 20px 20px !important;
                    }
                    /* stats card numbers */
                    .fi-wi-stats-overview-stat-value {
                        color: var(--pakpro-navy) !important;
                        font-weight: 800 !important;
                        font-size: 2rem !important;
                        line-height: 1.1 !important;
                    }
                    .fi-wi-stats-overview-stat-label {
                        color: #5b7189 !important;
                        font-weight: 600 !important;
                        font-size: 0.82rem !important;
                    }
                    .fi-wi-stats-overview-stat-description {
                        font-size: 0.8rem !important;
                        color: #7a94ac !important;
                    }
                </style>'
            )
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
                \App\Http\Middleware\SecurityHeaders::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
