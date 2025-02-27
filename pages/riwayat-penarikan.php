<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
require_once("./utils/translate.php");

$result = readSettings();

if (!function_exists("currencyFormat")) {
    function currencyFormat($angka, $currency)
    {
        // Fungsi format angka berdasarkan currency
        $symbols = [
            'IDR' => 'Rp ',
            'USD' => '$',
            'SGD' => 'S$',
            'MYR' => 'RM ',
            'GBP' => '£',
            'THB' => '฿',
            'VND' => '₫',
            'BND' => 'B$',
            'KHR' => '៛ ',
            'LAK' => '₭ ',
            'PHP' => '₱',
            'SAR' => '﷼ ',
            'BHD' => '.د.ب '
        ];

        // Simbol default jika tidak ditemukan
        $symbol = $symbols[$currency] ?? '';

        // Format angka sesuai aturan internasional
        $formatted = number_format($angka, 0, '.', '.');

        return $symbol . $formatted;
    }
}


if (!function_exists("convertCurrency")) {
    function convertCurrency($amount, $to_currency)
    {
        // Pastikan to_currency dalam huruf kecil
        $to_currency = strtolower($to_currency);

        // API URL untuk mendapatkan nilai tukar IDR ke mata uang lain
        $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/idr.json";

        // Ambil data kurs mata uang
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        // Mengecek apakah mata uang yang diminta ada dalam data (huruf kecil)
        if (isset($data['idr'][$to_currency])) {
            $rate = $data['idr'][$to_currency];
            $converted_amount = $amount * $rate; // Menghitung jumlah yang dikonversi
            return currencyFormat($converted_amount, strtoupper($to_currency)); // Format mata uang sesuai dengan jenisnya
        } else {
            return "Error: Invalid currency conversion."; // Jika mata uang tidak ditemukan
        }
    }
}

$sqlPenarikan;
if (isset($_SESSION["users"])) {
    $id = $_SESSION["users"];

    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    $queryPenarikan = "SELECT * FROM `withdrawals` WHERE user_id  = '$id'";
    $sqlPenarikan = mysqli_query($conn, $queryPenarikan);


    $dataUser = mysqli_fetch_assoc($sql);
}
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
    <link rel="stylesheet" href="Assets/Stylesheets/withdraw.css">

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

        <div class="desktop" style="overflow: auto;">
            <div class="text-white riwayat-penarikan">
                <p>Withdrawal History</p>
                <table>
                    <thead class="bg-primary">
                        <tr>
                            <th>Method</th>
                            <th>Account number</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($withdrawalData = mysqli_fetch_assoc($sqlPenarikan)) {
                        ?>
                            <tr>
                                <td><?php echo $withdrawalData["method"] ?></td>
                                <td><?php echo $withdrawalData["number_payment"]  ?></td>
                                <td><?php echo convertCurrency($withdrawalData["amount"], $dataUser["nominal_type"]) ?></td>
                                <td><?php echo $withdrawalData["status"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <p class="text-data">
                <?php echo $dataUser["quotes"] ?></p>
            <button class="telegram-btn" onclick="window.location.href = 'https://t.me/Examport1'"><i class="fa-brands fa-telegram"></i> Admin Telegram</button>
        </div>
    </main>

    <?php
    require_once("Components/client/sidebar.php");
    ?>

    <script>
        function allAmount(amount) {
            document.getElementById("amount").value = amount
        }
    </script>
    <script src="/Assets/Javascript/runningText.js"></script>
    <script src="/Assets/Javascript/withdraw.js"></script>
    <script src="/utils/cekdevice.js"></script>

</body>

</html>