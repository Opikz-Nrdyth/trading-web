<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chart extends Component
{
    public $bonus;
    public $profits;
    public $wallet;
    public $members;
    public function __construct($bonus = 0, $profits = 0, $wallet = 0, $members = 0)
    {
        $this->bonus = $bonus;
        $this->profits = $profits;
        $this->wallet = $wallet;
        $this->members = $members;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.chart');
    }
}
