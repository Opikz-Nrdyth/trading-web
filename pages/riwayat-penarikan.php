<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
require_once("./utils/translate.php");

$result = readSettings();

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
        <div class="ticker-container">
            <div class="ticker-wrap">
                <div class="ticker">

                </div>
            </div>
        </div>

        <div class="desktop" style="overflow: auto;">
            <div class="text-white riwayat-penarikan">
                <p><?php echo translate(trim($dataUser["language"]), "Riwayat Penarikan") ?></p>
                <table>
                    <thead class="bg-primary">
                        <tr>
                            <th><?php echo translate(trim($dataUser["language"]), "Metode") ?></th>
                            <th><?php echo translate(trim($dataUser["language"]), "Nomor Rekening") ?></th>
                            <th><?php echo translate(trim($dataUser["language"]), "Nominal") ?></th>
                            <th><?php echo translate(trim($dataUser["language"]), "Status") ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($withdrawalData = mysqli_fetch_assoc($sqlPenarikan)) {
                        ?>
                            <tr>
                                <td><?php echo translate(trim($dataUser["language"]), $withdrawalData["method"]) ?></td>
                                <td><?php echo translate(trim($dataUser["language"]), $withdrawalData["number_payment"])  ?></td>
                                <td><?php echo convertCurrency($withdrawalData["amount"], $dataUser["nominal_type"]) ?></td>
                                <td><?php echo translate(trim($dataUser["language"]), $withdrawalData["status"]) ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <p class="text-data">
                <?php echo translate(trim($dataUser["language"]), $dataUser["quotes"]) ?></p>
            <button class="telegram-btn" onclick="window.location.href = 'https://t.me/Examport1'"><i class="fa-brands fa-telegram"></i><?php echo translate(trim($dataUser["language"]), " Admin Telegram") ?></button>
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