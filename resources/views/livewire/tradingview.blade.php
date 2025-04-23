<div class="trading-container bg-base-card p-4 rounded-lg">
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-white text-xl">{{ $symbol }}</h2>
        <div class="text-white">
            Current Price: {{ $currentPrice }}
        </div>
    </div>

    <div class="tradingview-widget-container !h-[50vh] w-full">
        <div class="tradingview-widget-container__widget h-full w-full"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js" async>
            {
                "autosize": true,
                "symbol": "BITCOIN",
                "interval": "D",
                "timezone": "Asia/Jakarta",
                "theme": "dark",
                "style": "1",
                "locale": "en",
                "allow_symbol_change": true,
                "calendar": false,
                "support_host": "https://www.tradingview.com"
            }
        </script>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <div class="flex items-center space-x-4">
            <div class="bg-gray-800 text-white rounded px-4 py-2 flex items-center gap-3 justify-center">
                <p>SGD | </p><input type="number" value="0"
                    class="w-[80px] text-center text-lg bg-base-input outline-none rounded-md" min="1">
            </div>
            <select wire:model="timeframe" class="bg-gray-800 text-white rounded px-4 py-2">
                <option value="30">30 Second</option>
                <option value="60">1 Minute</option>
                <option value="300">5 Minutes</option>
            </select>
        </div>

        <div class="flex justify-center md:justify-end space-x-4">
            <button wire:click="buy" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">
                Buy {{ $leverage }}%
            </button>
            <button wire:click="sell" class="bg-red-500 hover:bg-red-600 text-white px-6 py-2 rounded">
                Sell {{ $leverage }}%
            </button>
        </div>
    </div>
</div>
