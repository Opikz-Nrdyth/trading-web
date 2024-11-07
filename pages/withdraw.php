<?php
session_start();
require_once("services/dbConnect.php");
require_once("./services/settings.php");
$result = readSettings();
function generateId($length = 8)
{
    $number = '';
    for ($i = 0; $i < $length; $i++) {
        $number .= rand(0, 9);
    }
    return $number;
}

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

if (isset($_POST["changeWithdraw"])) {
    $nama = $_POST["nama_payment"];
    $nomor = $_POST["number_payment"];
    $amount = $_POST["amount"];
    $method = $_POST["method"];
    $id  = generateId();
    $userId = $_SESSION["users"];


    sleep(2);
    if ($amount <= $data["capital_amount"]) {
        $query = "INSERT INTO `withdrawals`(`id`, `user_id`, `nama_payment`, `method`, `number_payment`, `amount`, `status`) VALUES ('$id', '$userId', '$nama', '$method', '$nomor', '$amount', 'pending')";
        $sqlChangePenarikan = mysqli_query($conn, $query);

        if ($sqlChangePenarikan) {
            $totalAmount = $data["capital_amount"] - $amount;
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
                <p>Uang Anda</p>
                <div>
                    <p><?php echo currencyFormatRupiah(intval($data["capital_amount"])) ?></p>
                    <p>Proses penarikan berlangsung 1-3 hari kerja</p>
                </div>
            </div>

            <form method="post" action="" class="container-pembayaran">
                <p class="title">Metode Pembayaran</p>
                <div class="search-container">
                    <input type="text"
                        name="method"
                        required
                        class="search-input"
                        placeholder="Pilih Bank atau E-Wallet"
                        id="searchInput"
                        oninput="filterItems()"
                        onfocus="showDropdown()"
                        onblur="hideDropdown()">
                    <div class="dropdown" id="dropdown"></div>
                </div>
                <p class="title">Nama Pemilik</p>
                <input type="text" required name="nama_payment" placeholder="Masukan Nama Pemilik">

                <p class="title">Nomer Rekening / E-Wallet</p>
                <input class="input" required name="number_payment" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Masukan Nomer Rekening / E-Wallet" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                <div class="nominal">
                    <p class="title">Nominal Penarikan</p>
                    <input class="input" id="amount" required name="amount" type="text" inputmode="numeric" pattern="[0-9]*" placeholder="Masukan Nominal Penarikan" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                    <div onclick="allAmount(`<?php echo intval($data['capital_amount']) ?>`)">
                        Semua
                    </div>
                </div>
                <button class="btn-process" type="submit" name="changeWithdraw" onclick="proseswithdraw()">Proses</button>

            </form>
            <button class="btn-riwayat">Cek Riwayat Transaksi</button>
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