<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Accrodion extends Component
{
    public $id;
    public $title;
    public $content;
    public function __construct($id = 0, $title = '', $content = '')
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accrodion');
    }
}
