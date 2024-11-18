<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started
}

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


if (!isset($_SESSION["users"])) {
    header("location:/login");
} else {
    $id = $_SESSION["users"];
    if ($_SESSION["role"] != "client") {
        header("location:/admin");
    }
    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    if (mysqli_num_rows($sql) == 1) {
        $data = mysqli_fetch_assoc($sql);
    } else {
        session_unset();
        header("location:/login");
    }
}
?>

<nav class="bg-primary navbar">
    <div>
        <img src="<?php echo $result["logo"] ?>" alt="Company Logo" class="logo-company">
    </div>
    <div class="right-nav">
        <div class="text-white bg-secondary type-balance"><?php echo translate(trim($dataUser["language"]), "REAL") ?>
            <!-- REAL <i class="fa-solid fa-caret-down"></i> -->
            <!-- <nav class="select-options">
                <nav>DEMO</nav>
                <nav>REAL</nav>
            </nav> -->
        </div>

        <a href="withdraw" class="balance text-white bg-secondary">
            <?php
            $currency = $data["nominal_type"]; // Mata uang yang dipilih oleh pengguna (misalnya 'IDR' atau 'USD')
            echo convertCurrency($data["capital_amount"],  $currency);
            ?> <span><i class="fa-solid fa-wallet"></i></span>
        </a>
        <a href="profile" class="foto-profile">
            <img src="<?php echo $data["profile_picture"] ?>" alt="foto profile">
        </a>
    </div>
</nav>