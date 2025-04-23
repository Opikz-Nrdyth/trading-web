<?php

namespace App\Http\Controllers;

use App\Models\news;
use App\Models\notification;
use App\Models\User;
use App\Models\userData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use NumberFormatter;

class welcome extends Controller
{
    public function Welcome()
    {
        // $members = Auth::user() ? userData::where("referals", Auth::user()->userData->username ?? "-")->count() :  0;
        $members = Auth::user() ? Auth::user()->userData->members :  0;
        $bonus = Auth::user() ? Auth::user()->userAmount->where('status', 'success')->where('type', 'bonus')->sum('amount') : 0;
        $profits = Auth::user() ? Auth::user()->userAmount->where('status', 'success')->where('type', 'profits')->sum('amount') : 0;
        $wallet = Auth::user() ? Auth::user()->userAmount->where('status', 'success')->sum('amount') : 0;

        $dataCurrency = Cache::get('data_currency', []);

        if ($dataCurrency) {
            $currencyType = Auth::user()->userData->type_currency ? Auth::user()->userData->type_currency : "IDR";
            $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
            $bonus = str_replace(',00', '', 
                $formatter->formatCurrency( round($bonus * $dataCurrency['idr'][strtolower($currencyType)], 4) ?? $bonus, $currencyType )
            );
            $profits = str_replace(',00', '', 
                $formatter->formatCurrency( round($profits * $dataCurrency['idr'][strtolower($currencyType)], 4) ?? $profits, $currencyType )
            );;
        
            
            $wallet = str_replace(',00', '', 
                $formatter->formatCurrency( round($wallet * $dataCurrency['idr'][strtolower($currencyType)], 4) ?? $wallet, $currencyType )
            );
        }

        $news = news::where('status', 'publish')->get();
        $notification = Notification::where(function ($query) {
            $query->where('user_id', Auth::id())
                ->orWhere('user_id', 'All');
        })
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('welcome', [
            'route' => ['profile'],
            'title' => 'Dashboard',
            'members' => $members,
            'bonus' => $bonus,
            'profits' => $profits,
            'wallet' => $wallet,
            'news' => $news,
            'notification' => $notification,
        ]);
    }
}
