<?php

require_once("./services/settings.php");
require_once("./utils/translate.php");
require_once("./services/dbConnect.php");
require_once("./services/getUser.php");

$result = readSettings();

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
    <link rel="stylesheet" href="/Assets/Stylesheets/deposit.css">

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

        <nav class="desktop">
            <div>
                <div class="container-company">
                    <div class="company-profile">
                        <img src="https://banner2.cleanpng.com/20180825/ook/kisspng-logo-brand-product-design-trademark-logos-fake-mock-up-illust-ss143531671-2-sra-so-1713948667494.webp" alt="company profile">
                    </div>
                </div>
                <div class="investment-capital">
                    <h3><?php echo translate(trim($dataUser["language"]), "Investment Capital Deposit") ?></h3>
                    <p><?php echo translate(trim($dataUser["language"]), "Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, earum incidunt! Illo voluptas culpa molestias est alias. Eum, inventore! Incidunt nemo fugiat earum, illo placeat repellendus nulla ad neque in?") ?></p>
                </div>
            </div>
            <div>
                <button class="telegram-buttons" onclick="window.location.href = 'klikdisini'"> <?php echo translate(trim($dataUser["language"]), "Klik Disini") ?></button>
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