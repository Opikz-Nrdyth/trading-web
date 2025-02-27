<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started
}

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
        <!-- <div class="text-white bg-secondary type-balance"><?php echo translate(trim($dataUser["language"]), "REAL") ?>
            REAL <i class="fa-solid fa-caret-down"></i>
            <nav class="select-options">
                <nav>DEMO</nav>
                <nav>REAL</nav>
            </nav>
        </div> -->

        <a href="withdraw" class="balance-container text-white">
            <?php
            $currency = $data["nominal_type"]; // Mata uang yang dipilih oleh pengguna (misalnya 'IDR' atau 'USD')
            echo convertCurrency($data["capital_amount"],  $currency);
            ?>

            <div class="text-white bg-secondary type-balance">
                REAL
            </div>
        </a>
        <a href="profile" class="foto-profile">
            <img src="<?php echo $data["profile_picture"] ?>" alt="foto profile">
        </a>
    </div>
</nav>