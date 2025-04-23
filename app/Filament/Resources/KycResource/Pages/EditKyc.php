<?php

namespace App\Filament\Resources\KycResource\Pages;

use App\Filament\Resources\KycResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditKyc extends EditRecord
{
    protected static string $resource = KycResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->action(function ($record) {
                    if ($record->photo) {
                        Storage::disk('public')->delete($record->photo);
                    }
                    if ($record->identity) {

                        Storage::disk('public')->delete($record->identity);
                    }

                    $record->delete();

                    Notification::make()
                        ->success()
                        ->title('KYC data and associated files deleted successfully')
                        ->send();
                }),
        ];
    }

    protected function afterSave(): void
    {
        $record = $this->getRecord(); // Mendapatkan record yang telah disimpan

        // Cek apakah status telah diubah menjadi "failed"
        if ($record->status === 'failed') {
            // Hapus file 'photo' jika ada
            if ($record->photo && Storage::disk('public')->exists($record->photo)) {
                Storage::disk('public')->delete($record->photo);
            }

            // Hapus file 'identity' jika ada
            if ($record->identity && Storage::disk('public')->exists($record->identity)) {
                Storage::disk('public')->delete($record->identity);
            }
        }
    }
}
