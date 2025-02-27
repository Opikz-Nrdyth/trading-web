<?php
require_once("./services/settings.php");
require_once("./utils/translate.php");
require_once("./services/dbConnect.php");
require_once("./services/getUser.php");
$result = readSettings();

function convertCurrencyAmount($amount, $to_currency)
{
  // Pastikan to_currency dalam huruf kecil
  $to_currency = strtolower($to_currency);

  // API URL untuk mendapatkan nilai tukar IDR ke mata uang lain
  $url = "https://cdn.jsdelivr.net/npm/@fawazahmed0/currency-api@latest/v1/currencies/idr.json";

  // Ambil data kurs mata uang
  $response = file_get_contents($url);
  $data = json_decode($response, true);

  // Mengecek apakah mata uang yang diminta ada dalam data (huruf kecil)
  if (isset($data['idr'][$to_currency])) {
    $rate = $data['idr'][$to_currency];

    $converted_amount = $amount * $rate; // Menghitung jumlah yang dikonversi
    return currencyFormat($converted_amount, strtoupper($to_currency)); // Format mata uang sesuai dengan jenisnya
  } else {
    return "Error: Invalid currency conversion."; // Jika mata uang tidak ditemukan
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
    <div class="ticker-container display-none">
      <div class="ticker-wrap">
        <div class="ticker">

        </div>
      </div>
    </div>
    <!-- TradingView Widget BEGIN -->
    <div class="tradingview-widget-container">
      <div class="tradingview-widget-container__widget"></div>
      <div class="tradingview-widget-copyright"></div>
      <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
        {
          "symbols": [{
              "proName": "FOREXCOM:SPXUSD",
              "title": "S&P 500 Index"
            },
            {
              "proName": "FOREXCOM:NSXUSD",
              "title": "US 100 Cash CFD"
            },
            {
              "proName": "FX_IDC:EURUSD",
              "title": "EUR to USD"
            },
            {
              "proName": "BITSTAMP:BTCUSD",
              "title": "Bitcoin"
            },
            {
              "proName": "BITSTAMP:ETHUSD",
              "title": "Ethereum"
            }
          ],
          "showSymbolLogo": true,
          "isTransparent": false,
          "displayMode": "adaptive",
          "colorTheme": "dark",
          "locale": "id"
        }
      </script>
    </div>
    <!-- TradingView Widget END -->

    <div class="balance-amount">
      <div class="users">
        <p>INVESTOR NAME:</p>
        <p><?php echo $dataUser['name'] ?></p>
      </div>
      <div class="amount">
        <img src="/Assets/Images/arrow-vertical.svg" alt="arrow-vertical" width="45px">
        <div>
          <img src="/Assets/Images/wallet-icon.svg" alt="wallet icon" width="75px">
          <p><?php echo convertCurrencyAmount($dataUser["saldo_awal"], $dataUser["nominal_type"]) ?></p>
          <p class="invt-amount">investment amount</p>
        </div>
      </div>
    </div>

    <!-- <div class="top-home">
      <div class="title">
        <img src="/Assets/Images/foto-profile.png" alt="foto" class="foto-top-home">
        <div class="text-top-home">
          <p>Lorem Ipsum Indonesia</p>
          <p>Pusat Info Perdagangan yang terpercaya</p>
        </div>
      </div>
      <div class="descriptions">
        <?php echo translate(trim($dataUser["language"]), "") ?>
      </div>
    </div> -->
    <table class="table-desktop">
      <thead class="bg-primary">
        <tr>
          <th>Coin</th>
          <th>Rank</th>
          <th>Price</th>
          <th>Presentase%<span style="opacity: 0.5; font-size:0.8em">(24h)</span></th>
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