<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
$result = readSettings();

function currencyFormatRupiah($amount)
{
    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
    $formatted = $formatter->formatCurrency($amount, 'IDR');

    return $formatted;
}

$sqlPenarikan;
if (isset($_SESSION["users"])) {
    $id = $_SESSION["users"];

    $query = "SELECT * FROM `users` WHERE id = '$id'";
    $sql = mysqli_query($conn, $query);

    $queryPenarikan = "SELECT * FROM `withdrawals` WHERE user_id  = '$id'";
    $sqlPenarikan = mysqli_query($conn, $queryPenarikan);


    $data = mysqli_fetch_assoc($sql);
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
                <p>Riwayat Penarikan</p>
                <table>
                    <thead class="bg-primary">
                        <tr>
                            <th>Metode</th>
                            <th>Nomor</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($withdrawalData = mysqli_fetch_assoc($sqlPenarikan)) {
                        ?>
                            <tr>
                                <td><?php echo $withdrawalData["method"] ?></td>
                                <td><?php echo $withdrawalData["number_payment"] ?></td>
                                <td><?php echo currencyFormatRupiah($withdrawalData["amount"]) ?></td>
                                <td><?php echo $withdrawalData["status"] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <p class="text-data">
                <?php echo $result["riwayat_penarikan"] ?></p>
            <button class="telegram-btn" onclick="window.location.href = 'https://t.me/Examport1'"><i class="fa-brands fa-telegram"></i> Admin Telegram</button>
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