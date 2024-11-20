<?php
session_start();
require_once("./services/settings.php");
require_once("./utils/translate.php");

$result = readSettings();

$userId = $_SESSION["users"];
$query = "SELECT * FROM `users` WHERE id='$userId'";
$sql = mysqli_query($conn,  $query);

$dataUser = mysqli_fetch_assoc($sql);

// Konversi Mata Uang

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

function convertIdrToUsd($amount) // Fungsi buat melihat kurs dollar saat ini dan mengubah IDR ke USD
{
    $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/idr.json";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $rate_idr_to_usd = $data['idr']['usd'];

    // Menghitung konversi ke USD
    $amount_usd = $amount * $rate_idr_to_usd;
    return $amount_usd;
}

function convertCurrencyAmount2($type, $ResultAmount) // fungsi untuk mengetahui konversi yang diinginkan, jika ke dollar maka akan menjalankan fungsi convertIdrToUsd dahulu jika rupiah maka akan langsung menjalankan fungsi currencyFormat untuk penambahan satuan 
{
    $capital_amount_in_idr = intval($ResultAmount);
    $capital_amount_in_usd = convertIdrToUsd($capital_amount_in_idr);

    if ($type == "USD") {
        return currencyFormat($capital_amount_in_usd, 'USD');
    } else {
        return currencyFormat($capital_amount_in_idr, 'IDR');
    }
}
function convertCurrencyAmount($amount, $to_currency)
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
    <link rel="stylesheet" href="/Assets/Stylesheets/trade.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-base">
    <?php
    require_once("Components/client/navbar.php");

    ?>
    <main>
        <div class="ticker-container">
            <div class="ticker-wrap">
                <div class="ticker">

                </div>
            </div>
        </div>
        <p class="account-type">
            <span class="<?php echo ($dataUser["account_status"] == 'active') ? 'dots-active' : 'dots-inactive'; ?>">
                <i class="fa-solid fa-circle"></i>
            </span>
            <?php if ($dataUser["account_status"] == "active"):
                echo translate(trim($dataUser["language"]), "Akun Anda Telah Aktif");
            else:
                echo translate(trim($dataUser["language"]), "Akun Anda Belum Aktif");
            endif; ?>
        </p>

        <div class="binance">
            <div class="saldo">
                <p><?php echo translate(trim($dataUser["language"]), "Saldo Awal") ?></p>
                <p><?php echo convertCurrencyAmount($dataUser["saldo_awal"], $dataUser["nominal_type"]) ?></p>
            </div>
            <div class="saldo">
                <p><?php echo translate(trim($dataUser["language"]), "Saldo Tambahan") ?></p>
                <p><?php echo convertCurrencyAmount($dataUser["saldo_tambahan"], $dataUser["nominal_type"]) ?></p>
            </div>
            <div class="saldo">
                <p><?php echo translate(trim($dataUser["language"]), "Bonus Member") ?></p>
                <p><?php echo convertCurrencyAmount($dataUser["bonus_member"], $dataUser["nominal_type"]) ?></p>
            </div>
            <div class="saldo">
                <p><?php echo translate(trim($dataUser["language"]), "Saldo Akhir") ?></p>
                <p><?php echo convertCurrencyAmount($dataUser["saldo_akhir"], $dataUser["nominal_type"]) ?></p>
            </div>
        </div>

        <div id="trading-container">
            <div id="tradingview-widget-container"></div>
        </div>
    </main>

    <?php
    require_once("Components/client/sidebar.php");
    ?>

    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>

    <script src="/Assets/Javascript/runningText.js"></script>
    <script src="/Assets/Javascript/tradingview.js"></script>
    <script src="/utils/cekdevice.js"></script>
</body>

</html>