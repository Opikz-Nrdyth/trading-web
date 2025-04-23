<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputImage extends Component
{
    public $label;
    public $name;
    public $model;
    public function __construct($label = 'Upload File', $name = 'file', $model = null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-image');
    }
}
