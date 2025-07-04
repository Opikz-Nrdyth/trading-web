<?php

namespace App\Filament\Resources\AmountUsersResource\Pages;

use App\Filament\Resources\AmountUsersResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditAmountUsers extends EditRecord
{
    protected static string $resource = AmountUsersResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil nilai currency dan amount dari form
        $amount = $data['amount'] ?? 0;
        $currency = $data['type_currency'] ?? 'IDR';

        // Konversi ke rupiah
        $data['amount'] = $this->convertToRupiah($amount, $currency);

        unset($data['type_currency']);
        return $data;
    }

    protected function convertToRupiah($amount, $currency): int
    {
        $dataCurrency = Cache::get('data_currency', []);
        $currency = strtolower($currency ?? 'idr');

        if (!isset($dataCurrency['idr'][$currency]) || $dataCurrency['idr'][$currency] == 0) {
            return 0;
        }

        $rate = 1 / $dataCurrency['idr'][$currency];

        return intval($amount * $rate);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
