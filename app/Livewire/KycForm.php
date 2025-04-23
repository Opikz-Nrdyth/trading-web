<?php

namespace App\Livewire;

use Livewire\WithFileUploads;

use App\Models\kyc;
use Livewire\Component;

class KycForm extends Component
{
    use WithFileUploads;

    public $full_name;
    public $address;
    public $identity_card;
    public $close_up_photo;

    // Validasi input
    protected $rules = [
        'full_name' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'identity_card' => 'required|image|max:2048', // Maksimal 2MB
        'close_up_photo' => 'required|image|max:2048', // Maksimal 2MB
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->full_name = $user->name;
        $this->address = $user->userData->address;
    }

    public function submit()
    {
        $this->validate();

        // Simpan file upload
        $closeUpPhotoPath = $this->close_up_photo->store('kyc', 'public');
        $identityCardPath = $this->identity_card->store('kyc', 'public');

        // Simpan data ke database
        kyc::updateOrCreate(
            ['user_id' => auth()->id()],
            [
                'photo' => $closeUpPhotoPath,
                'identity' => $identityCardPath,
                'status' => 'pending'
            ]
        );

        // Reset input setelah berhasil submit
        $this->reset(['full_name', 'address', 'identity_card', 'close_up_photo']);

        session()->flash('message', 'KYC data submitted successfully!');

        sleep(2);
        return redirect()->to("/kyc");
    }

    public function render()
    {
        return view('livewire.kyc-form');
    }
}
