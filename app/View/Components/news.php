<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class news extends Component
{
    public $title;
    public $description;
    public $thubmnail;
    public $updated_at;
    public $id;
    public function __construct($title = '', $description = '', $thubmnail = '', $updatedat = '', $id = 0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->thubmnail = $thubmnail;
        $this->updated_at = $updatedat;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news');
    }
}
