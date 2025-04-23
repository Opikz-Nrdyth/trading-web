<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $userData = $data['userData'];
        unset($data['userData']);

        if (!empty($data['password_confirmation'])) {
            $plainPassword = $data['password_confirmation'];

            $data['password_view'] = $plainPassword;
        }

        // Update userData
        $this->record->userData()->update($userData);

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
