<?php

namespace App\Models;

use JeffersonGoncalves\Filament\Admin\Models\Admin as BaseAdmin;
use JeffersonGoncalves\HelpDesk\Concerns\HasTickets;
use JeffersonGoncalves\HelpDesk\Concerns\IsOperator;

/**
 * Columns, casts, factory, observer, admin guard, Filament panel access and avatar come from
 * jeffersongoncalves/laravel-admin + jeffersongoncalves/filament-admin.
 */
class Admin extends BaseAdmin
{
    use HasTickets;
    use IsOperator;
}
