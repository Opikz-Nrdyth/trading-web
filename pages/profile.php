<?php
session_start();
require_once("services/dbConnect.php");

require_once("./services/settings.php");
$result = readSettings();

$userId = $_SESSION["users"];
$query = "SELECT * FROM `users` WHERE id='$userId'";
$sql = mysqli_query($conn,  $query);

$data = mysqli_fetch_assoc($sql);


function currencyFormatRupiah($amount)
{
    $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);
    $formatted = $formatter->formatCurrency($amount, 'IDR');

    return $formatted;
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
            <div class="bg-foto-profile">
                <div>
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#C05DC2" d="M41.2,-18.5C52.8,-3.8,61.1,18.1,53.7,25.8C46.3,33.4,23.1,26.8,4.7,24.1C-13.7,21.3,-27.4,22.5,-39,12.5C-50.6,2.4,-60.1,-18.9,-53.2,-30.9C-46.4,-42.9,-23.2,-45.6,-4.2,-43.2C14.8,-40.7,29.7,-33.2,41.2,-18.5Z" transform="translate(100 100)" />
                    </svg>
                </div>
                <div>
                    <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#C05DC2" d="M23.7,-17.2C29.1,-4.2,31,7.4,26.4,12.5C21.9,17.7,10.9,16.4,-0.2,16.5C-11.4,16.7,-22.8,18.2,-30,11.5C-37.3,4.8,-40.3,-10.1,-34.6,-23.3C-28.9,-36.4,-14.5,-47.8,-2.7,-46.2C9.1,-44.7,18.2,-30.2,23.7,-17.2Z" transform="translate(100 100)" />
                    </svg>
                </div>
            </div>
            <div class="bg-profile">
                <div class="profile">
                    <img src="<?php echo $data["profile_picture"] ?>" alt="Foto Profile">
                </div>
                <p class="nama"><?php echo $data["name"] ?></p>
                <p class="member">Member Terdaftar <i class="fa-solid fa-circle-check"></i></p>
            </div>

            <div class="data-diri text-white">

                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-user-tie"></i> Nama Lengkap:</p>
                    <p class="value"><?php echo $data["name"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-location-dot"></i> Alamat:</p>
                    <p class="value"><?php echo $data["address"] ?></p>

                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-envelope"></i> Email:</p>
                    <p class="value"><?php echo $data["email"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-venus-mars"></i> Jenis Kelamin:</p>
                    <p class="value"><?php echo $data["gender"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-briefcase"></i> Pekerjaan:</p>
                    <p class="value"><?php echo $data["work"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-phone"></i> Nomor Telepon:</p>
                    <p class="value"><?php echo $data["phone_number"] ?></p>
                    <hr>
                </div>
                <div class="item">
                    <p class="title-key"><i class="fa-solid fa-money-check-dollar"></i> Jumlah Modal:</p>
                    <p class="value"><?php echo currencyFormatRupiah(intval($data["capital_amount"])) ?></p>
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