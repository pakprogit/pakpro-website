<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class UserRoleMatrixWidget extends Widget
{
    protected static string $view = 'filament.widgets.user-role-matrix-widget';
    protected int | string | array $columnSpan = 'full';
}

