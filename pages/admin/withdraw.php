<?php
require_once("services/dbConnect.php");
require_once("services/settings.php");
$resultSettings = readSettings();

function fetchData()
{
    global $conn;
    $query = "SELECT withdrawals.*, users.name, users.capital_amount FROM `withdrawals` INNER JOIN users ON withdrawals.user_id = users.id;";
    $sql = mysqli_query($conn, $query);

    return $sql;
}


if (isset($_POST["Withdraw"])) {
    $id = $_POST["dataId"];
    $query = "UPDATE `withdrawals` SET `status`='completed' WHERE id='$id'";
    $sql = mysqli_query($conn, $query);
    if ($sql) {
        echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Mengupdate Status Withdraw!</span> </div>';
    } else {
        echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Gagal Mengupdate Status Withdraw</span> </div>';
    }
}

$result = fetchData();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Trader Go</title>
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/withdraw.css">
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
        <div class="container-table">
            <table class="table-desktop">
                <thead>
                    <tr>
                        <th>Confirm</th>
                        <th>UserID</th>
                        <th>Nama</th>
                        <th>Metode</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Tanggal Request</th>
                        <th>Tanggal Confirmasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td>
                                <button <?php echo $data['status'] == "completed" ? "disabled" : ""; ?>
                                    class="confirm"
                                    onclick="confirmPayment(`<?php echo $data['id'] ?>`)">
                                    <i class="fa-solid fa-circle-check"></i>
                                </button>
                            </td>

                            <td><?php echo $data['user_id'] ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['method'] ?> | <?php echo $data['number_payment'] ?></td>
                            <td><?php echo $data['amount'] ?></td>
                            <td>
                                <p class="<?php echo $data['status'] ?>"><?php echo $data['status'] ?></p>
                            </td>
                            <td><?php echo $data['created_at'] ?></td>
                            <td><?php echo $data['updated_at'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </main>

    <script>
        function confirmPayment(id) {

            if (confirm('Apakah Anda yakin ingin mengkonfirmasi penarikan tunai?')) {
                const formData = new FormData();
                formData.append('Withdraw', true);
                formData.append('dataId', id);

                fetch(window.location.href, {
                        method: 'POST',
                        body: formData
                    }).then(response => response.text())
                    .then(data => {
                        window.location.reload();
                    }).catch(error => console.error('Error:', error));
            }
        }
        setTimeout(() => {
            document.querySelector(".alert").remove()
        }, 3000);
    </script>
    <script src="/Assets/Javascript/responsiveAdmin.js"></script>
</body>

</html>