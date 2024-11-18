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
        // Fungsi untuk format angka besar (Billions, Millions, dll.)
        if (!function_exists("formatLargeNumber")) {

            function formatLargeNumber($angka)
            {
                if ($angka >= 1000000000) {
                    $formatted = $angka / 1000000000;
                    return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Billion';
                } elseif ($angka >= 1000000) {
                    $formatted = $angka / 1000000;
                    return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Million';
                } elseif ($angka >= 1000) {
                    $formatted = $angka / 1000;
                    return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 0, '.', '')) . ' Thousand';
                } else {
                    return number_format($angka, 0, '.', ',');
                }
            }
        }

        // Format untuk IDR (Rupiah)
        if ($currency == 'IDR') {
            if ($angka >= 1000000000000) {
                $formatted = $angka / 1000000000000;
                return "Rp " . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Triliun';
            } elseif ($angka >= 1000000000) {
                $formatted = $angka / 1000000000;
                return "Rp " . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Miliard';
            } elseif ($angka >= 1000000) {
                $formatted = $angka / 1000000;
                return "Rp " . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Juta';
            } elseif ($angka >= 1000) {
                $formatted = $angka / 1000;
                return "Rp " . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 0, '.', '')) . ' Ribu';
            } else {
                return 'Rp ' . number_format($angka, 0, '.', ',');
            }
        }

        // Format untuk USD (Dollar Amerika)
        elseif ($currency == 'USD') {
            if ($angka >= 1000000000) {
                $formatted = $angka / 1000000000;
                return '$' . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Billion';
            } elseif ($angka >= 1000000) {
                $formatted = $angka / 1000000;
                return '$' . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Million';
            } elseif ($angka >= 1000) {
                $formatted = $angka / 1000;
                return '$' . ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Thousand';
            } else {
                return '$' . number_format($angka, 2, '.', ',');
            }
        }

        // Format untuk SGD (Dollar Singapura)
        elseif ($currency == 'SGD') {
            return 'S$ ' . formatLargeNumber($angka);
        }

        // Format untuk MYR (Ringgit Malaysia)
        elseif ($currency == 'MYR') {
            return 'RM ' . formatLargeNumber($angka);
        }

        // Format untuk GBP (Poundsterling Inggris)
        elseif ($currency == 'GBP') {
            return '£ ' . formatLargeNumber($angka);
        }

        // Format untuk THB (Baht Thailand)
        elseif ($currency == 'THB') {
            return '฿ ' . formatLargeNumber($angka);
        }

        // Format untuk VND (Dong Vietnam)
        elseif ($currency == 'VND') {
            return '₫ ' . formatLargeNumber($angka);
        }

        // Format untuk BND (Dollar Brunei Darusalam)
        elseif ($currency == 'BND') {
            return 'B$ ' . formatLargeNumber($angka);
        }

        // Format untuk KHR (Riel Kamboja)
        elseif ($currency == 'KHR') {
            return '៛ ' . formatLargeNumber($angka);
        }

        // Format untuk LAK (Kip Laos)
        elseif ($currency == 'LAK') {
            return '₭ ' . formatLargeNumber($angka);
        }

        // Format untuk PHP (Peso Filipina)
        elseif ($currency == 'PHP') {
            return '₱ ' . formatLargeNumber($angka);
        }

        // Format untuk SAR (Riyal Arab Saudi)
        elseif ($currency == 'SAR') {
            return '﷼ ' . formatLargeNumber($angka);
        }

        // Format untuk BHD (Dinar Bahrain)
        elseif ($currency == 'BHD') {
            return '.د.ب ' . formatLargeNumber($angka);
        }

        // Jika tidak ada format yang cocok
        else {
            return number_format($angka, 2, '.', ',');
        }
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
        <div class="ticker-container">
            <div class="ticker-wrap">
                <div class="ticker">

                </div>
            </div>
        </div>

        <nav class="container-data desktop">
            <div class="bg-image-profile">

            </div>
            <div class="bg-profile">
                <div class="profile">
                    <img src="<?php echo $dataUser["profile_picture"] ?>" alt="Foto Profile">
                </div>
                <p class="nama"><?php echo $dataUser["name"] ?></p>
                <p class="member"><?php echo translate(trim($dataUser["language"]), "Member Terdaftar") ?><span class="check"><i class="fa-solid fa-circle-check"></i></span></p>
            </div>

            <div class="data-diri text-white">

                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-user-tie"></i> <?php echo translate(trim($dataUser["language"]), "Nama Lengkap:") ?></p>
                    <p class="value"><?php echo $dataUser["name"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-location-dot"></i> <?php echo translate(trim($dataUser["language"]), "Alamat:") ?></p>
                    <p class="value"><?php echo $dataUser["address"] ?></p>

                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-envelope"></i> <?php echo translate(trim($dataUser["language"]), "Email:") ?></p>
                    <p class="value"><?php echo $dataUser["email"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-venus-mars"></i> <?php echo translate(trim($dataUser["language"]), "Jenis Kelamin:") ?></p>
                    <p class="value"><?php echo $dataUser["gender"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-briefcase"></i> <?php echo translate(trim($dataUser["language"]), "Pekerjaan") ?></p>
                    <p class="value"><?php echo $dataUser["work"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-phone"></i> <?php echo translate(trim($dataUser["language"]), "Nomor Telephone") ?></p>
                    <p class="value"><?php echo $dataUser["phone_number"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-money-check-dollar"></i> <?php echo translate(trim($dataUser["language"]), "Jumlah Modal") ?></p>
                    <p class="value"><?php echo convertCurrency(intval($dataUser["capital_amount"]), $dataUser["nominal_type"]) ?></p>
                    <hr>
                </div>

                <form method="post" action="">
                    <button class="btn-logout" type="submit" name="logout">
                        <i class="fa-solid fa-person-walking-dashed-line-arrow-right"></i> <?php echo translate(trim($dataUser["language"]), "LOGOUT") ?>
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