<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class comment extends Component
{
    public $user;
    public $comment;
    public $profile;
    public $updatedAt;

    public function __construct($user = '', $comment = '', $profile = '', $updatedAt)
    {
        $this->user = $user;
        $this->comment = $comment;
        $this->profile = $profile;
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.comment');
    }
}
