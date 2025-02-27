<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
require_once("./utils/translate.php");

$result = readSettings();

$userId = $_SESSION["users"];
$query = "SELECT * FROM `users` WHERE id='$userId'";
$sql = mysqli_query($conn,  $query);

$dataUser = mysqli_fetch_assoc($sql);


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

if (isset($_POST["logout"])) {
    session_unset(); // Unset all of the user data
    header("location:/login");
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
    <link rel="stylesheet" href="Assets/Stylesheets/profile.css">

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

        <nav class="container-data desktop">
            <div class="bg-image-profile">

            </div>
            <div class="bg-profile">
                <div class="profile">
                    <img src="<?php echo $dataUser["profile_picture"] ?>" alt="Foto Profile">
                </div>
                <p class="nama"><?php echo $dataUser["name"] ?></p>
                <p class="member">Registered Member<span class="check"><i class="fa-solid fa-circle-check"></i></span></p>
            </div>

            <div class="data-diri text-white">

                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-user-tie"></i> Full Name:</p>
                    <p class="value"><?php echo $dataUser["name"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-location-dot"></i> Address:</p>
                    <p class="value"><?php echo $dataUser["address"] ?></p>

                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-envelope"></i> Email:</p>
                    <p class="value"><?php echo $dataUser["email"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-venus-mars"></i> Gander:</p>
                    <p class="value"><?php echo $dataUser["gender"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-briefcase"></i> Work:</p>
                    <p class="value"><?php echo $dataUser["work"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-phone"></i> Phone Number:</p>
                    <p class="value"><?php echo $dataUser["phone_number"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-money-check-dollar"></i> Amount of Capital:</p>
                    <p class="value"><?php echo convertCurrency(intval($dataUser["capital_amount"]), $dataUser["nominal_type"]) ?></p>
                    <hr>
                </div>

                <form method="post" action="">
                    <button class="btn-logout" type="submit" name="logout">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> LOGOUT
                    </button>
                </form>
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