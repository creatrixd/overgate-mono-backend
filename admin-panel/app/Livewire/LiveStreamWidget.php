<?php

namespace App\Livewire;

use Filament\Widgets\Widget;

class LiveStreamWidget extends Widget
{
    protected string $view = 'livewire.live-stream-widget';
    protected int | string | array $columnSpan = 'full';
}
