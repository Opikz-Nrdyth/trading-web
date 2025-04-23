<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\notification;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function afterCreate(): void
    {
        // Ambil data userData dari form
        $userData = $this->data['userData'];

        $this->record->update([
            'password_view' => $this->data['password_confirmation'],
        ]);

        notification::create([
            'user_id' => $this->record->id,
            'type' => 'info',
            'title' => 'Welcome ' . $this->record->name,
            'message' => 'We’re thrilled to have you on board. Whether you’re a seasoned trader or just starting out, this is your gateway to a world of opportunities. 📈 Enjoy seamless trading with our user-friendly platform, cutting-edge tools, and market insights tailored just for you. Remember, trading is not just about profits—it’s about learning, growing, and staying positive. Feel free to reach out if you need assistance.Happy trading and may your journey be filled with success! 🚀',
        ]);

        // Cek apakah userData sudah ada, jika ada maka update, jika tidak buat yang baru
        $this->record->userData()->updateOrCreate(
            ['user_id' => $this->record->id], // Kriteria pencarian data yang akan di-update
            $userData // Data yang akan di-update atau dibuat baru
        );
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
