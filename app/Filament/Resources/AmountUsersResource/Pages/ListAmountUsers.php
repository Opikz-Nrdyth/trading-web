<?php

namespace App\Filament\Resources\AmountUsersResource\Pages;

use App\Filament\Resources\AmountUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAmountUsers extends ListRecords
{
    protected static string $resource = AmountUsersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
