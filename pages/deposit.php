<?php

require_once("./services/settings.php");
require_once("./utils/translate.php");
require_once("./services/dbConnect.php");
require_once("./services/getUser.php");

$result = readSettings();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $result["company_name"] ?></title>
    <link
        rel="icon"
        type="images/png"
        href="<?php echo $result["logo"] ?>" />
    <link rel="stylesheet" href="Assets/Stylesheets/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/deposit.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-base">
    <?php
    require_once("Components/client/navbar.php");

    ?>
    <main>
        <div class="ticker-container display-none">
            <div class="ticker-wrap">
                <div class="ticker">

                </div>
            </div>
        </div>

        <div id="running">
            <!-- TradingView Widget BEGIN -->
            <div class="tradingview-widget-container">
                <div class="tradingview-widget-container__widget"></div>
                <div class="tradingview-widget-copyright"></div>
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
        </div>

        <nav class="desktop">
            <div>
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div class="tradingview-widget-container__widget"></div>
                    <div class="tradingview-widget-copyright"></div>
                    <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
                        {
                            "interval": "1m",
                            "width": 425,
                            "isTransparent": false,
                            "height": 450,
                            "symbol": "COINBASE:BTCUSD",
                            "showIntervalTabs": true,
                            "displayMode": "single",
                            "locale": "en",
                            "colorTheme": "dark"
                        }
                    </script>
                </div>
                <!-- TradingView Widget END -->
                <div class="investment-capital">
                    <h3>Investment Capital Deposit</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, earum incidunt! Illo voluptas culpa molestias est alias. Eum, inventore! Incidunt nemo fugiat earum, illo placeat repellendus nulla ad neque in?</p>
                </div>
            </div>
            <div style="padding-bottom: 100px;">
                <button class="telegram-buttons" onclick="window.location.href = 'klikdisini'"> <i class="fa-brands fa-telegram"></i> Telegram</button>
            </div>
        </nav>

    </main>

    <?php
    require_once("Components/client/sidebar.php");
    ?>


    <script src="/Assets/Javascript/runningText.js"></script>
    <script src="/utils/cekdevice.js"></script>
</body>

</html>