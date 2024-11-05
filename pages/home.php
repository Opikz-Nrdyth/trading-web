<?php
require_once("./services/settings.php");
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
  <link rel="stylesheet" href="/Assets/Stylesheets/global.css">
  <link rel="stylesheet" href="/Assets/Stylesheets/dashboard.css">

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
    <table class="table-desktop">
      <thead class="bg-primary">
        <tr>
          <th>Coin</th>
          <th>Rank</th>
          <th>Price</th>
          <th>Change %<span style="opacity: 0.5; font-size:0.8em">(24h)</span></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </main>

  <?php
  require_once("Components/client/sidebar.php");
  ?>

  <script src="/Assets/Javascript/runningText.js"></script>
  <script src="/Assets/Javascript/tableCurrency.js"></script>
  <script src="/utils/cekdevice.js"></script>
</body>

</html>