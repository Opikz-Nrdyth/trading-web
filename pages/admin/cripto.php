<?php
require_once("services/dbConnect.php");
require_once("services/settings.php");
$resultSettings = readSettings();

function fetchData()
{
    global $conn;
    $query = "SELECT * FROM `crypto_coins`";
    $result = mysqli_query($conn, $query);

    return $result;
}

if (isset($_POST["addData"])) {
    $symbol = $_POST["criptoId"];
    $name = $_POST["nama"];
    $logo = $_FILES["logo"];

    // Allowed file types and size limit (1MB)
    $allowed_types = ['image/svg+xml'];
    $max_file_size = 1048576; // 1MB

    // Target directory
    $target_dir = "Assets/Images/CryptocurrencyIcons/";
    $file_extension = pathinfo($logo["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $name . '.' . $file_extension;

    // Check if the coin already exilogosts
    $queryCek =  "SELECT * FROM `crypto_coins` WHERE coin_symbol = '$symbol'";
    $sqlCek =  mysqli_query($conn, $queryCek);

    // If the coin doesn't exist
    if (mysqli_num_rows($sqlCek) == 0) {

        // Check file type
        if (!in_array($logo["type"], $allowed_types)) {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Hanya diperbolehkan file svg!</span> </div>';
            exit;
        }

        // Check file size
        if ($logo["size"] > $max_file_size) {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: File terlalu besar. maksimal 1mb!</span> </div>';
            exit;
        }

        // Check if upload directory exists, if not, create it
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($logo["tmp_name"], $target_file)) {

            // Insert into the database with the correct file path
            $query = "INSERT INTO `crypto_coins`(`coin_name`, `coin_symbol`, `logo_url`) 
                      VALUES ('$name', '$symbol', '/$target_file')";

            if (mysqli_query($conn, $query)) {
                echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Menambahkan Koin Baru!</span> </div>';
            } else {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: ' . mysqli_error($conn) . '</span> </div>';
            }
        } else {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Gagal Upload File!</span> </div>';
        }
    } else {
        echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Koin Sudah Tersedia!</span> </div>';
    }
}

if (isset($_POST["editData"])) {
    $oldSymbol = $_POST["oldId"]; // old coin symbol
    $symbol = $_POST["criptoId"]; // new coin symbol
    $name = $_POST["nama"];
    $logo = $_FILES["logo"];

    // Allowed file types and size limit (1MB)
    $allowed_types = ['image/svg+xml'];
    $max_file_size = 1048576; // 1MB

    // Target directory
    $target_dir = "Assets/Images/CryptocurrencyIcons/";

    // Check if the coin with the old symbol exists in the database
    $queryCek = "SELECT * FROM `crypto_coins` WHERE coin_symbol = '$oldSymbol'";
    $sqlCek = mysqli_query($conn, $queryCek);

    if (mysqli_num_rows($sqlCek) > 0) {
        // If a file was uploaded, validate and process it
        if ($logo['error'] == 0) { // File was uploaded
            $file_extension = pathinfo($logo["name"], PATHINFO_EXTENSION);
            $target_file = $target_dir . $name . '.' . $file_extension;

            // Check file type
            if (!in_array($logo["type"], $allowed_types)) {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Hanya diperbolehkan file svg!</span> </div>';
                exit;
            }

            // Check file size
            if ($logo["size"] > $max_file_size) {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: File Terlalu Besar! Hanya diperbolehkan 1mb</span> </div>';
                exit;
            }

            // Check if upload directory exists, if not, create it
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            // Move uploaded file to the target directory
            if (move_uploaded_file($logo["tmp_name"], $target_file)) {
                // Update database with new logo URL and new data
                $query = "UPDATE `crypto_coins` 
                          SET coin_name = '$name', coin_symbol = '$symbol', logo_url = '/$target_file' 
                          WHERE coin_symbol = '$oldSymbol'";

                if (mysqli_query($conn, $query)) {
                    echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Update Koin!</span> </div>';
                } else {
                    echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: ' . mysqli_error($conn) . '</span> </div>';
                }
            } else {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: Gagal Upload File!</span> </div>';
            }
        } else {
            // No new file uploaded, update only the name and symbol (don't change the logo)
            $query = "UPDATE `crypto_coins` 
                      SET coin_name = '$name', coin_symbol = '$symbol' 
                      WHERE coin_symbol = '$oldSymbol'";

            if (mysqli_query($conn, $query)) {
                echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Berhasil Update Koin!</span> </div>';
            } else {
                echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: ' . mysqli_error($conn) . '</span> </div>';
            }
        }
    } else {
        echo "Coin with symbol '$oldSymbol' does not exist.";
    }
}


if (isset($_POST["deleteData"])) {
    $dataId = $_POST["dataId"];
    $query = "DELETE FROM `crypto_coins` WHERE coin_symbol= '$dataId'";
    $sql =  mysqli_query($conn, $query);
    if ($sql) {
        echo "Data deleted successfully.";
    } else {
        echo "Error deleting data.";
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
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/cripto.css">
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
        <button class="add-data" onclick="openModal()">Tambah Data</button>
        <div class="container-table">
            <table class="table-desktop">
                <thead>
                    <tr>
                        <th>Nomer</th>
                        <th>Cripto ID</th>
                        <th>Cripto Logo</th>
                        <th>Nama Koin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($data = mysqli_fetch_assoc($result)) {

                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $data["coin_symbol"] ?></td>
                            <td><img class="logo_url" src="<?php echo $data["logo_url"] ?>" alt="bitcoin"></td>
                            <td><?php echo strtoupper($data["coin_name"]) ?></td>
                            <td>
                                <button class="btn-edit" onclick="editData(`<?php echo $data['coin_symbol'] ?>`, `<?php echo $data['coin_name'] ?>`)"><i class="fa-solid fa-pen"></i></button>
                                <button class="btn-delete" onclick="deleteData(`<?php echo $data['coin_symbol'] ?>`)"><i class="fa-solid fa-trash"></i></button>
                            </td>
                        </tr>

                    <?php
                        $i++;
                    };
                    ?>
                </tbody>
            </table>
        </div>

        <div class="modal">
            <div class="modal-content">
                <p>Tambah Koin Kripto</p>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="text" name="oldId" placeholder="OldId">
                    <input type="text" name="criptoId" placeholder="Cripto Id">
                    <input type="text" name="nama" placeholder="Nama Koin">
                    <input type="file" accept="images/svg" name="logo" placeholder="logo">
                    <div class="conatiner-button">
                        <button type="button" onclick="closeModal()">Batal</button>
                        <button type="submit" name="addData">Prosess</button>
                    </div>

                    <p>Panduan:</p>
                    <p>1. <a href="https://coinmarketcap.com/" target="_blank">toko kripto</a></p>
                    <p>2. <a href="https://iconduck.com/icons/82093/bitcoin-cryptocurrency" target="_blank">opsi 2 logo kripto</a></p>
                    <p>3. <a href="https://cryptologos.cc/" target="_blank">opsi 3 logo kripto</a></p>
                    <p>4. <a href="https://logonest.net/logos/" target="_blank">opsi 4 logo kripto</a></p>
                </form>
            </div>
        </div>
    </main>

    <script>
        function closeModal() {
            document.querySelector('.modal').style.display = 'none';
        }

        function openModal() {
            document.querySelector('.modal').style.display = 'block';
            document.querySelector('input[name="oldId"]').setAttribute("style", "display:none")
        }

        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                const formData = new FormData();
                formData.append('deleteData', true);
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

        function editData(symbol, name) {
            document.querySelector('input[name="oldId"]').value = symbol;
            document.querySelector('input[name="criptoId"]').value = symbol;
            document.querySelector('input[name="nama"]').value = name;

            // Change form button and action for editing
            document.querySelector('.conatiner-button button[type="submit"]').innerText = "Update";
            document.querySelector('.conatiner-button button[type="submit"]').name = "editData";

            document.querySelector('.modal').style.display = 'block';
            document.querySelector('input[name="oldId"]').style.display = "none"
        }

        setTimeout(() => {
            document.querySelector(".alert").remove()
        }, 3000);
    </script>
    <script src="/Assets/Javascript/responsiveAdmin.js"></script>
</body>

</html>