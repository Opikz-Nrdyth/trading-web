@extends('layouts.app')
@section('title', 'Trade')
@section('route', end($route))

@section('content')
    <x-breadcrumb :route="$route" title="{{ $title }}" />

    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container mt-5">
        <div class="tradingview-widget-container__widget"></div>
        <div class="tradingview-widget-copyright"><a href="https://id.tradingview.com/" rel="noopener nofollow"
                target="_blank"></a></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
            {
                "symbols": [{
                        "proName": "FOREXCOM:SPXUSD",
                        "title": "S&P 500 Index"
                    },
                    {
                        "proName": "FOREXCOM:NSXUSD",
                        "title": "US 100 Cash CFD"
                    },
                    {
                        "proName": "FX_IDC:EURUSD",
                        "title": "EUR to USD"
                    },
                    {
                        "proName": "BITSTAMP:BTCUSD",
                        "title": "Bitcoin"
                    },
                    {
                        "proName": "BITSTAMP:ETHUSD",
                        "title": "Ethereum"
                    }
                ],
                "showSymbolLogo": true,
                "isTransparent": false,
                "displayMode": "adaptive",
                "colorTheme": "dark",
                "locale": "id"
            }
        </script>
    </div>
    <!-- TradingView Widget END -->
    <div class="mt-2">
        <livewire:Tradingview />
    </div>
    <div>
        <livewire:tabel title='History' action="{{ true }}" searchbar="{{ true }}" :header="$header"
            :colum="$colum" :searchableHeaders="$filtered" />
    </div>
@endsection
