<?php

namespace App\Livewire;

use App\Models\notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use NumberFormatter;

class Header extends Component
{

    public $notif = false;
    public $currency_option = false;
    public $currency_selected = null;
    public $dataCurrency;
    public $convert_currency_price;
    public $userAmount;

    public function mount()
    {
        $this->notif = notification::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhere('user_id', 'All');
        })
            ->where('status', 'unread')
            ->exists();

        if (Auth::user()->userData->type_currency) {
            $this->currency_selected = Auth::user()->userData->type_currency ?? "IDR";
        } else {
            $this->currency_selected = 'IDR';
        }

        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        $this->dataCurrency = Cache::get('data_currency', []);

        $this->userAmount = auth()->user()->userAmount->where('status', 'success')->sum('amount') ?? 0;

        $this->convert_currency_price = str_replace(
            ',00',
            '',
            $formatter->formatCurrency(
                round($this->userAmount * $this->dataCurrency['idr'][strtolower($this->currency_selected)], 4),
                $this->currency_selected
            )
        );
    }

    public function show_currency()
    {
        $this->currency_option = !$this->currency_option;
    }

    public function currencySelected($currency)
    {
        $this->currency_option = false;
        $this->currency_selected = $currency;
        session(["currency" => $currency]);
        $this->convert_currency_price = round($this->userAmount * $this->dataCurrency['idr'][strtolower($this->currency_selected)], 4);

        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.header');
    }
}
