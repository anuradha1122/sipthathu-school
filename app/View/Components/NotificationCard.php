<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationCard extends Component
{
    public $title;
    public $time;
    public $subtitle;
    public $author;

    public function __construct($title = null, $time = null, $subtitle = null, $author = null)
    {
        $this->title = $title;
        $this->time = $time;
        $this->subtitle = $subtitle;
        $this->author = $author;
    }


    public function render(): View|Closure|string
    {
        return view('components.notification-card');
    }
}
