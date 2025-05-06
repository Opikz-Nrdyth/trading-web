<?php

namespace App\Filament\Resources\AmountUsersResource\Pages;

use App\Filament\Resources\AmountUsersResource;
use App\Models\notification;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Cache;

class CreateAmountUsers extends CreateRecord
{
    protected static string $resource = AmountUsersResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil nilai currency dan amount dari form
        $amount = $data['amount'] ?? 0;
        $currency = $data['type_currency'] ?? 'IDR';

        // Konversi ke rupiah
        $data['amount'] = $this->convertToRupiah($amount, $currency);

        unset($data['type_currency']);

        $user = User::where("id", $data['user_id'])->first();

        notification::create([
            'user_id' => $user?->userData?->username,
            'type' => 'info',
            'title' => 'you get ' . $data['type'] . ' balance',
            'message' => 'you get additional balance from ' . $data['from_user'],
        ]);

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
}
