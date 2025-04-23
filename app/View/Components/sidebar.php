<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class sidebar extends Component
{
    public $route;
    public function __construct($route)
    {
        $this->route = $route;
    }

    public function render(): View|Closure|string
    {
        if (!Auth::check()) {
            return redirect()->to("/admin/login");
        }


        return view('components.sidebar');
    }
}
