<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    public $placeholder;
    public $value;
    public $name;
    public $disabled;
    public $options;
    public $model;
    public function __construct($placeholder = '', $value = '', $name = '', $options = '', $disabled = false, $model = false)
    {
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->name = $name;
        $this->disabled = $disabled;
        $this->options = is_array($options) ? $options : explode(',', $options);
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select');
    }
}
