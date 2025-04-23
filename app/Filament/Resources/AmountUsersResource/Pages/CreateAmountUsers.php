<?php

namespace App\Filament\Resources\AmountUsersResource\Pages;

use App\Filament\Resources\AmountUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAmountUsers extends CreateRecord
{
    protected static string $resource = AmountUsersResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
