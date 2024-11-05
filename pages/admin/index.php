<?php
require_once("services/dbConnect.php");
require_once("services/settings.php");
$resultSettings = readSettings();

$sql = mysqli_query($conn, "
    SELECT 
        (SELECT COUNT(*) FROM `crypto_coins`) as total_coins,
        (SELECT COUNT(*) FROM `withdrawals` WHERE status = 'completed') as total_transactions,
        (SELECT COUNT(*) FROM `users` WHERE role = 'client') as total_users
");

$result = mysqli_fetch_assoc($sql);

$countCoin = $result['total_coins'];
$countTransaction = $result['total_transactions'];
$countUsers = $result['total_users'];

function getUptime()
{
    // Set waktu mulai simulasi uptime (01 November 2024, jam 00:00)
    $startTimestamp = strtotime('2024-11-01 00:00:00');

    // Hitung selisih waktu dari sekarang
    $uptimeSeconds = time() - $startTimestamp;

    return $uptimeSeconds;
}


function formatUptime($seconds)
{
    $minutes = floor($seconds / 60);
    $hours = floor($seconds / 3600);
    $days = floor($seconds / 86400);
    $months = floor($seconds / (86400 * 30));

    if ($seconds < 60) {
        return "0 Menit " . $seconds . " Detik";
    } elseif ($seconds < 3600) {
        return "0 Jam " . $minutes . " Menit";
    } elseif ($seconds < 86400) {
        return "0 Hari " . $hours . " Jam";
    } elseif ($seconds < 86400 * 30) {
        return "0 Bulan " . $days . " Hari";
    } else {
        $remainingDays = floor(($seconds % (86400 * 30)) / 86400);
        return $months . " Bulan " . $remainingDays . " Hari";
    }
}

// Mendapatkan uptime sesuai lingkungan (localhost atau server hosting)
$uptimeSeconds = getUptime();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Trader Go</title>
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/index.css">
    <link
        rel="icon"
        type="images/png"
        href="/Assets/Images/company-logo.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php
    require_once("Components/admin/navbar.php");
    require_once("Components/admin/sidebar.php");
    ?>

    <main class="container-main-open">
        <div class="shorcut-button">
            <div class="item-shorcut">
                <p class="logo"><i class="fa-solid fa-users"></i></p>
                <p class="value"><?php echo $countUsers ?></p>
                <p class="deskripsi">User Aktif</p>
            </div>
            <div class="item-shorcut">
                <p class="logo"><i class="fa-regular fa-clock"></i></p>
                <p class="value"><?php echo formatUptime($uptimeSeconds); ?></p>
                <p class="deskripsi">Waktu Akhir</p>
            </div>
            <div class="item-shorcut">
                <p class="logo"><i class="fa-solid fa-coins"></i></p>
                <p class="value"><?php echo $countCoin ?></p>
                <p class="deskripsi">Coin Criptocurrency</p>
            </div>
            <div class="item-shorcut">
                <p class="logo"><i class="fa-solid fa-money-bill-transfer"></i></p>
                <p class="value"><?php echo $countTransaction ?></p>
                <p class="deskripsi">Transaksi Berhasil</p>
            </div>
        </div>
    </main>
    <script src="/Assets/Javascript/responsiveAdmin.js"></script>
</body>

</html>