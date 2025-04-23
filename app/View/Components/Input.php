<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public $placeholder;
    public $value;
    public $name;
    public $disabled;
    public $type;
    public $label;
    public $model;
    public function __construct($placeholder = '', $value = '', $name = '', $disabled = false, $type = 'text', $label = "", $model = false)
    {
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->name = $name;
        $this->disabled = $disabled;
        $this->type = $type;
        $this->label = $label;
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
