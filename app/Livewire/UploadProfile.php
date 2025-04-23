<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadProfile extends Component
{
    use WithFileUploads;

    public $profile_image;

    // Validation rules
    protected $rules = [
        'profile_image' => 'required|image|max:2048', // Max size: 1MB
    ];

    public function submit()
    {

        // Validate the uploaded file
        $this->validate();

        // Store the uploaded profile image
        $path = $this->profile_image->store('profile', 'public'); // Store in storage/app/public/profile

        // Update the userData with the file path
        $userData = Auth::user()->userData; // Assuming the relationship exists
        $userData->update([
            'profile_image' => $path,
        ]);

        // Flash message
        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.upload-profile');
    }
}
