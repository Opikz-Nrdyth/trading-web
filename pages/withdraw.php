<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
require_once("./utils/translate.php");

$result = readSettings();
function generateId($length = 8)
{
    $number = '';
    for ($i = 0; $i < $length; $i++) {
        $number .= rand(0, 9);
    }
    return $number;
}

// Convert USD to IDR / IDR to USD



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

function convertUsdToIdr($amount, $currencyType) // Fungsi buat melihat kurs dollar saat ini dan mengubah IDR ke USD
{
    $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/$currencyType.json";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);

    $rate_idr_to_usd = $data[$currencyType]['idr'];

    // Menghitung konversi ke USD
    $amount_usd = $amount * $rate_idr_to_usd;
    return floor($amount_usd);
}

function convertCurrency($amount, $to_currency)
{
    // Pastikan to_currency dalam huruf kecil
    $to_currency = strtolower($to_currency);

    // API URL untuk mendapatkan nilai tukar IDR ke mata uang lain
    $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/idr.json";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);
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

$sqlPenarikan;
if (isset($_SESSION["users"])) {
    $id = $_SESSION["users"];

    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    $queryPenarikan = "SELECT * FROM `withdrawals` WHERE user_id  = '$id'";
    $sqlPenarikan = mysqli_query($conn, $queryPenarikan);


    $dataUser = mysqli_fetch_assoc($sql);
}

if (isset($_POST["changeWithdraw"])) {
    $nama = $_POST["nama_payment"];
    $nomor = $_POST["number_payment"];
    $amount = $_POST["amount"];
    $method = $_POST["method"];
    $id  = generateId();
    $userId = $_SESSION["users"];

    if ($dataUser["nominal_type"] != "IDR") {
        $amount = convertUsdToIdr($amount, strtolower($dataUser["nominal_type"]));
    }
    sleep(2);
    if ($amount <= $dataUser["capital_amount"]) {
        $query = "INSERT INTO `withdrawals`(`id`, `user_id`, `nama_payment`, `method`, `number_payment`, `amount`, `status`) VALUES ('$id', '$userId', '$nama', '$method', '$nomor', '$amount', 'pending')";
        $sqlChangePenarikan = mysqli_query($conn, $query);

        if ($sqlChangePenarikan) {
            $totalAmount = $dataUser["capital_amount"] - $amount;
            $queryUpdateAmount = "UPDATE `users` SET `capital_amount`='$totalAmount' WHERE id='$userId'";
            $sqlUser = mysqli_query($conn, $queryUpdateAmount);
            if ($sqlUser) {
                header("location:/riwayatpenarikan");
            } else {
                echo "Error updating user capital amount";
            }
        }
    } else {
?>
        <script>
            alert("Jumlah Uang Tidak Mencukupi")
            document.querySelector(".conatiner-loader").setAttribute("style", "display:none");
        </script>
<?php
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
    <link rel="stylesheet" href="Assets/Stylesheets/withdraw.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="bg-base">
    <?php
    require_once("Components/client/navbar.php");

    ?>
    <div class="bg-images">

    </div>
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
        <div class="conatiner-loader">
            <div class="custom-loader"></div>
        </div>
        <div class="desktop" style="overflow: auto;">
            <div class="balance-amount">
                <div class="blc">
                    <div class="logo">
                        <p class="wallet-logo"><i class="fa-solid fa-wallet"></i></p>
                        <p>Your Balance</p>
                    </div>
                    <div class="amount">
                        <p><?php echo convertCurrency($dataUser["capital_amount"], $dataUser["nominal_type"]) ?></p>
                    </div>
                </div>
                <p class="txt-alert">The withdrawal process takes 1-3 working days</p>
            </div>

            <form method="post" action="" class="container-pembayaran">
                <p class="title">Payment Method</p>
                <div class="search-container">
                    <input type="text"
                        name="method"
                        required
                        class="search-input"
                        placeholder="Select Bank or E-Wallet"
                        id="searchInput"
                        oninput="filterItems()"
                        onfocus="showDropdown()"
                        onblur="hideDropdown()">
                    <div class="dropdown" id="dropdown"></div>
                </div>
                <p class="title">User Name</p>
                <input type="text" required name="nama_payment" placeholder="Enter the Owner's Name">

                <p class="title">Account Number / E-Wallet</p>
                <input class="input" required name="number_payment" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Enter Account Number / E-Wallet" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                <div class="nominal">
                    <p class="title">Withdrawal Amount</p>
                    <input class="input" id="amount" required name="amount" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Enter the Withdrawal Amount" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    <div onclick="allAmount(`<?php echo preg_replace('/\D/', '', str_replace('$', '', convertCurrency($dataUser['capital_amount'], $dataUser['nominal_type']))) ?>`)">
                        All
                    </div>

                </div>
                <button class="btn-process" type="submit" name="changeWithdraw" onclick="proseswithdraw()">Process</button>

            </form>
            <button class="btn-riwayat">Check Transaction History</button>
        </div>


    </main>

    <?php
    require_once("Components/client/sidebar.php");
    ?>

    <script>
        function allAmount(amount) {
            document.getElementById("amount").value = amount
        }

        function proseswithdraw() {
            document.querySelector(".conatiner-loader").setAttribute("style", "display:flex");
        }

        document.querySelector(".btn-riwayat").addEventListener("click", () => {
            document.querySelector(".conatiner-loader").setAttribute("style", "display:flex");
            setTimeout(() => {
                window.location.href = "/riwayatpenarikan"
            }, 2000);
        })
    </script>
    <script src="/Assets/Javascript/runningText.js"></script>
    <script src="/Assets/Javascript/withdraw.js"></script>
    <script src="/utils/cekdevice.js"></script>

</body>

</html>