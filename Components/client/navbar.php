<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start the session if it hasn't been started
}

function currencyFormat($angka)
{
    if ($angka >= 1000000000000) {
        $formatted = $angka / 1000000000000;
        return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Triliun';
    } elseif ($angka >= 1000000000) {
        $formatted = $angka / 1000000000;
        return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Miliard';
    } elseif ($angka >= 1000000) {
        $formatted = $angka / 1000000;
        return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 2, '.', '')) . ' Juta';
    } elseif ($angka >= 1000) {
        $formatted = $angka / 1000;
        return ($formatted == intval($formatted) ? intval($formatted) : number_format($formatted, 0, '.', '')) . ' Ribu';
    } else {
        return $angka;
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
        <div class="text-white bg-secondary type-balance">REAL
            <!-- REAL <i class="fa-solid fa-caret-down"></i> -->
            <!-- <nav class="select-options">
                <nav>DEMO</nav>
                <nav>REAL</nav>
            </nav> -->
        </div>


        <a href="withdraw" class="balance text-white bg-secondary">
            <?php echo "Rp." . currencyFormat(intval($data["capital_amount"])) ?> <span><i class="fa-solid fa-wallet"></i></span>
        </a>
        <a href="profile" class="foto-profile">
            <img src="<?php echo $data["profile_picture"] ?>" alt="foto profile">
        </a>
    </div>
</nav>