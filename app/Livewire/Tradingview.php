<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use NumberFormatter;

class Tradingview extends Component
{
    public $symbol = 'TRADE';
    public $leverage = 400;
    public $timeframe = '30';
    public $currentPrice = 0;
    public $currency_selected = null;

    public function buy() {}

    public function sell() {}

    public function mount()
    {

        if (Auth::user()->userData->type_currency) {
            $this->currency_selected = Auth::user()->userData->type_currency ?? "IDR";
        } else {
            $this->currency_selected = 'IDR';
        }

        $dataCurrency = Cache::get('data_currency', []);
        $this->currentPrice = Auth::user()->userAmount->where('status', 'success')->sum('amount');
        $currencyType = Auth::user()->userData->type_currency ? Auth::user()->userData->type_currency : "IDR";
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        $this->currentPrice = str_replace(
            ',00',
            '',
            $formatter->formatCurrency(round($this->currentPrice * $dataCurrency['idr'][strtolower($this->currency_selected)], 4), $currencyType)
        );
    }


    public function render()
    {
        return view('livewire.tradingview');
    }
}
