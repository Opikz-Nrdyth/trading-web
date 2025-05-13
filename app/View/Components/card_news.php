<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class card_news extends Component
{
    public $thumbnail;
    public $author;
    public $date;
    public $title;
    public $description;
    public $id;
    public function __construct($id, $thumbnail, $author, $date, $title, $description)
    {
        $this->id->$id;
        $this->thumbnail = $thumbnail;
        $this->author = $author;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card_news');
    }
}
