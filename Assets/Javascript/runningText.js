let assetMap = {};
let nameCoin = "";
let host = window.location.origin;

document.addEventListener("DOMContentLoaded", function (event) {
  const tickers = document.querySelectorAll(".tradingview-widget-container");
  if (tickers) {
    setTimeout(() => {
      tickers[0].setAttribute("style", "width: 100%; height: fit-content;");
    }, 1000);
  }
});

// Fungsi untuk mengambil data dari API dan memperbarui assetMap dan nameCoin
async function updateCryptoAssets() {
  try {
    // Fetch data dari API
    let response = await fetch(`${host}/services/criptoapi.php?coins`);
    let coins = await response.json();

    // Array untuk menyimpan nama-nama aset yang akan digunakan dalam WebSocket
    let nameCoinArray = [];

    // Loop melalui hasil API dan buat pemetaan serta string aset
    coins.forEach((coin) => {
      // Misalnya API mengembalikan data seperti {symbol: 'BTC/USD', name: 'bitcoin'}
      let symbol = coin.coin_symbol; // contoh: 'BTC/USD'
      let name = coin.coin_name; // contoh: 'bitcoin'

      // Perbarui assetMap
      assetMap[symbol] = name;

      // Tambahkan nama koin ke array nameCoin
      nameCoinArray.push(name);
    });

    // Buat string berisi nama-nama aset untuk WebSocket
    nameCoin = nameCoinArray.join(",");

    main(assetMap, nameCoin);

    if (typeof generateTabelItems == "function") {
      generateTabelItems();
      updateTableItems();
    }
  } catch (error) {
    console.error("Error fetching data from API:", error);
  }
}

// Panggil fungsi untuk memperbarui crypto assets
updateCryptoAssets();

function main() {
  let DurationTime = 5;
  // Pemetaan jumlah desimal yang akan ditampilkan untuk setiap mata uang
  const decimalMap = {
    BTC: 0,
    ETH: 2,
    BNB: 2,
    DOGE: 4,
    TRX: 6,
    BTH: 2,
    LTC: 2,
  };

  // Membuat koneksi WebSocket ke API CoinCap
  const socket = new WebSocket(`wss://ws.coincap.io/prices?assets=${nameCoin}`);

  // Objek untuk menyimpan harga terkini
  let currentPrices = {};

  // Objek untuk menyimpan harga sebelumnya (untuk perhitungan persentase perubahan)
  let previousPrices = {};

  // Fungsi untuk membuat elemen-elemen ticker
  function generateTickerItems() {
    const ticker = document.querySelector(".ticker");
    ticker.innerHTML = ""; // Membersihkan konten yang ada

    Object.keys(assetMap).forEach((pair) => {
      const tickerItem = document.createElement("div");
      tickerItem.className = "ticker-item";

      const pairSpan = document.createElement("span");
      pairSpan.classList.add("cryptoItem");
      pairSpan.innerHTML = `<img class="icon-crypt" src="/Assets/Images/CryptocurrencyIcons/${assetMap[pair]}.svg"/>${pair}`;

      const priceSpan = document.createElement("span");
      priceSpan.className = "price";
      priceSpan.textContent = "Loading...";

      tickerItem.appendChild(pairSpan);
      tickerItem.appendChild(priceSpan);

      ticker.appendChild(tickerItem);
    });

    // Menduplikasi konten untuk scroll berkelanjutan
    duplicateContent();

    // Menyesuaikan kecepatan scroll berdasarkan jumlah item ticker
    adjustScrollSpeed();
  }

  // Handler untuk pesan yang diterima melalui WebSocket
  socket.onmessage = function (msg) {
    const data = JSON.parse(msg.data);
    Object.keys(data).forEach((asset) => {
      const price = parseFloat(data[asset]);
      if (currentPrices[asset]) {
        previousPrices[asset] = currentPrices[asset];
      }
      currentPrices[asset] = price;
    });
    updateTickerItems();
  };

  // Fungsi untuk menghitung perubahan persentase
  function calculatePercentageChange(currentPrice, previousPrice) {
    if (!previousPrice) return 0;
    return ((currentPrice - previousPrice) / previousPrice) * 100;
  }

  // Fungsi untuk memformat angka
  function formatNumber(number, decimals = 2) {
    return number.toFixed(decimals);
  }

  // Fungsi untuk memperbarui elemen-elemen ticker
  function updateTickerItems() {
    const tickerItems = document.querySelectorAll(".ticker-item");

    tickerItems.forEach((item) => {
      const pairText = item.childNodes[0].textContent.trim();
      const asset = assetMap[pairText];
      if (!asset || !currentPrices[asset]) return;

      const currentPrice = currentPrices[asset];
      const previousPrice = previousPrices[asset] || currentPrice;
      const percentChange = calculatePercentageChange(
        currentPrice,
        previousPrice
      );

      const priceSpan = item.querySelector(".price");
      if (!priceSpan) return;

      const formattedPrice = formatNumber(
        currentPrice,
        decimalMap[pairText.split("/")[0]]
      );

      priceSpan.textContent = `${formattedPrice} (${
        percentChange >= 0 ? "+" : ""
      }${percentChange.toFixed(4)}%)`;

      // Remove existing classes
      priceSpan.classList.remove("positive", "negative", "stable");

      // Add class based on percentChange
      if (percentChange > 0) {
        priceSpan.classList.add("positive");
      } else if (percentChange < 0) {
        priceSpan.classList.add("negative");
      } else if (percentChange == 0) {
        priceSpan.classList.add("stable");
      }
    });
  }

  // Running Text
  const ticker = document.querySelector(".ticker");

  // Fungsi untuk menduplikasi konten
  function duplicateContent() {
    const items = ticker.innerHTML;
    ticker.innerHTML = items + items;
  }

  // Fungsi untuk menyesuaikan kecepatan scroll berdasarkan jumlah item ticker
  function adjustScrollSpeed() {
    const ticker = document.querySelector(".ticker");
    const numberOfItems = document.querySelectorAll(".ticker-item").length;

    // Set a base speed per item and calculate total duration
    const speedPerItem = 5; // in seconds (adjust as needed)
    const duration = numberOfItems * speedPerItem;
    DurationTime = duration;

    // Apply the calculated duration to the animation
    ticker.style.animation = `scroll ${duration}s linear infinite`;

    // Update keyframe dynamically to support the new duration
    const styleSheet = document.styleSheets[0];
    const keyframes = `
        @keyframes scroll {
          0% { transform: translateX(0); }
          100% { transform: translateX(-50%); }
        }
      `;
    styleSheet.insertRule(keyframes, styleSheet.cssRules.length);
  }

  // Observer to monitor scroll position and reset
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) {
          ticker.style.transform = "translateX(0)";
          ticker.style.transition = "none";
          requestAnimationFrame(() => {
            ticker.style.transform = "translateX(-50%)";
            ticker.style.transition = `transform ${DurationTime}s linear`;
          });
        }
      });
    },
    {
      threshold: 0,
    }
  );

  // Start observation
  observer.observe(ticker);

  generateTickerItems();

  function handleMouseOver() {
    ticker.style.animationPlayState = "paused";
  }

  function handleMouseOut() {
    ticker.style.animationPlayState = "running";
  }

  ticker.addEventListener("mouseover", handleMouseOver);
  ticker.addEventListener("mouseout", handleMouseOut);
}
