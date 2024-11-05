<?php
$removeBackgroundApiKey = "eTiSMET9jeGpopyq2gaGR6vd";
$project = "TraderGp API Key (2024-11-04 20:46:20)";
require_once("services/settings.php");
$resultSettings = readSettings();

function removeBackground($imagePath, $apiKey)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.remove.bg/v1.0/removebg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image_file' => new CURLFile($imagePath),
        'size' => 'auto'
    ]);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Api-Key: ' . $apiKey
    ]);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception(curl_error($ch));
    }
    curl_close($ch);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpCode != 200) {
        throw new Exception("Error: " . $result);
    }

    // Simpan hasil gambar tanpa background
    $outputFile = 'Assets/Images/company-profile.png';
    file_put_contents($outputFile, $result);

    return $outputFile;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["simpansettings"])) {
    $companyName = trim($_POST['company_name']);
    $whatsappNumber = trim($_POST['whatsapp_number']);
    $riwayatPenarikan = trim($_POST['riwayat_penarikan']);
    $logo = $_FILES['logo'];

    if ($logo['error'] === UPLOAD_ERR_OK) {
        $logoPath = 'Assets/Images/' . basename($logo['name']);
        move_uploaded_file($logo['tmp_name'], $logoPath);

        try {
            // Hapus background menggunakan remove.bg API
            $logoPathNoBg = removeBackground($logoPath, $removeBackgroundApiKey);

            // Hapus file asli dan gunakan file tanpa background
            unlink($logoPath);
            $logoPath = $logoPathNoBg;

            // Simpan data ke file .opz
            $settings = [
                'company_name' => $companyName,
                'whatsapp_number' => $whatsappNumber,
                'riwayat_penarikan' => $riwayatPenarikan,
                'logo' => $logoPath
            ];

            $encryptedData = base64_encode(json_encode($settings));
            file_put_contents('utils/settings.opz', $encryptedData);

            echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Pengaturan Berhasil Disimpan!</span> </div>';
        } catch (Exception $e) {

            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: ' . $e->getMessage() . '</span> </div>';
        }
    } else {

        // Jika tidak ada file yang diupload, baca pengaturan lama
        try {
            $settings = readSettings('utils/settings.opz');

            // Update pengaturan dengan data yang ada dan logo lama
            $settings['company_name'] = $companyName;
            $settings['whatsapp_number'] = $whatsappNumber;
            $settings['riwayat_penarikan'] = $riwayatPenarikan;

            // Simpan kembali tanpa mengubah logo
            $encryptedData = base64_encode(json_encode($settings));
            file_put_contents('utils/settings.opz', $encryptedData);

            echo '<div class="alert check"> <i class="far fa-check-circle color"></i> &nbsp; &nbsp; <span>Pengaturan Berhasil Disimpan!</span> </div>';
        } catch (Exception $e) {
            echo '<div class="alert error"> <i class="fa-solid fa-triangle-exclamation"></i> &nbsp; &nbsp; <span>Error: ' . $e->getMessage() . '</span> </div>';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - <?php echo $resultSettings["company_name"] ?></title>
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/global.css">
    <link rel="stylesheet" href="/Assets/Stylesheets/admin/settings.css">
    <link
        rel="icon"
        type="images/png"
        href="<?php echo "/" . $resultSettings["logo"] ?>" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js" integrity="sha512-6sSYJqDreZRZGkJ3b+YfdhB3MzmuP9R7X1QZ6g5aIXhRvR1Y/N/P47jmnkENm7YL3oqsmI6AK+V6AD99uWDnIw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <?php
    require_once("Components/admin/navbar.php");
    require_once("Components/admin/sidebar.php");

    ?>


    <main class="container-main-open">
        <div class="container container-table">
            <h2>Settings</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="company_name">Nama Perusahaan:</label>
                <input type="text" name="company_name" value="<?php echo $resultSettings["company_name"] ?>">
                <br>
                <label for="whatsapp_number">Nomor WhatsApp:</label>
                <input type="text" name="whatsapp_number" value="<?php echo $resultSettings["whatsapp_number"] ?>">
                <br>
                <label for="logo">Upload Logo:</label>
                <input type="file" name="logo" accept="image/png">
                <br>
                <label for="whatsapp_number">Text di riwayat penarikan:</label>
                <textarea name="riwayat_penarikan">
                <?php echo trim($resultSettings["riwayat_penarikan"]) ?>
                </textarea>
                <br>

                <button type="submit" name="simpansettings">Simpan</button>

            </form>
        </div>
    </main>

    <script>
        setTimeout(() => {
            document.querySelector(".alert").remove()
        }, 3000);
    </script>
    <script src="/Assets/Javascript/responsiveAdmin.js"></script>
</body>

</html>