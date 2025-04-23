<?php

namespace App\Livewire;

use App\Models\testimonial;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormTestimonial extends Component
{
    public $message;

    public function submit()
    {

        $this->message = trim($this->message);
        $this->validate([
            'message' => 'required|string',
        ]);

        testimonial::create([
            'user_id' => Auth::id(),
            'testimonial' => $this->message,
            'status' => "publish",
        ]);

        session()->flash('message', 'Successfully gave a testimonial');
    }

    public function render()
    {
        return view('livewire.form-testimonial');
    }
}
