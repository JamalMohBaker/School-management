<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class notifications extends Component
{
    /**
     * Create a new component instance.
     */
    /**
     * *
     * @var notifications collection
     */
    public $notifications;

    public function __construct()
    {
        //
        $user = Auth::user();
        $this->notifications = $user->notifications;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notifications');
    }
}
