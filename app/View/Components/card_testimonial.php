<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card_testimonial extends Component
{
    public $profile;
    public $name;
    public $position;
    public $testimonials;
    public function __construct($profile, $name, $position, $testimonials)
    {
        $this->profile = $profile;
        $this->name = $name;
        $this->position = $position;
        $this->testimonials = $testimonials;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card_testimonial');
    }
}
