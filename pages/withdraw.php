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

function convertUsdToIdr($amount) // Fungsi buat melihat kurs dollar saat ini dan mengubah IDR ke USD
{
    $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/usd.json";

    $response = file_get_contents($url);
    $data = json_decode($response, true);

    $rate_idr_to_usd = $data['usd']['idr'];

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
        // $amount = convertUsdToIdr($amount);
        header("location:/withdraw-fail");
    } else {
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
        <div class="ticker-container">
            <div class="ticker-wrap">
                <div class="ticker">

                </div>
            </div>
        </div>
        <div class="conatiner-loader">
            <div class="custom-loader"></div>
        </div>
        <div class="desktop" style="overflow: auto;">
            <div class="balance-amount">
                <p><?php echo translate(trim($dataUser["language"]), "Uang Anda") ?></p>
                <div>
                    <p><?php echo convertCurrency($dataUser["capital_amount"], $dataUser["nominal_type"]) ?></p>
                    <p><?php echo translate(trim($dataUser["language"]), "Proses penarikan berlangsung 1-3 hari kerja") ?></p>
                </div>
            </div>

            <form method="post" action="" class="container-pembayaran">
                <p class="title"><?php echo translate(trim($dataUser["language"]), "Metode Pembayaran") ?></p>
                <div class="search-container">
                    <input type="text"
                        name="method"
                        required
                        class="search-input"
                        placeholder="<?php echo translate(trim($dataUser["language"]), "Pilih Bank atau E-Wallet") ?>"
                        id="searchInput"
                        oninput="filterItems()"
                        onfocus="showDropdown()"
                        onblur="hideDropdown()">
                    <div class="dropdown" id="dropdown"></div>
                </div>
                <p class="title"><?php echo translate(trim($dataUser["language"]), "Nama Pemilik") ?></p>
                <input type="text" required name="nama_payment" placeholder="<?php echo translate(trim($dataUser["language"]), "Masukan Nama Pemilik") ?>">

                <p class="title"><?php echo translate(trim($dataUser["language"]), "Nomer Rekening / E-Wallet") ?></p>
                <input class="input" required name="number_payment" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="<?php echo translate(trim($dataUser["language"]), "Masukan Nomer Rekening / E-Wallet") ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                <div class="nominal">
                    <p class="title"><?php echo translate(trim($dataUser["language"]), "Nominal Penarikan") ?></p>
                    <input class="input" id="amount" required name="amount" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="<?php echo translate(trim($dataUser["language"]), "Masukan Nominal Penarikan") ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    <div onclick="allAmount(`<?php echo preg_replace('/\D/', '', str_replace('$', '', convertCurrency($dataUser['capital_amount'], $dataUser['nominal_type']))) ?>`)">
                        <?php echo translate(trim($dataUser["language"]), "Semua") ?>
                    </div>

                </div>
                <button class="btn-process" type="submit" name="changeWithdraw" onclick="proseswithdraw()"><?php echo translate(trim($dataUser["language"]), "Proses") ?></button>

            </form>
            <button class="btn-riwayat"><?php echo translate(trim($dataUser["language"]), "Cek Riwayat Transaksi") ?></button>
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