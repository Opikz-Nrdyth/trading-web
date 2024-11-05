const tableBody = document.querySelector("tbody");
const generateTabelItems = () => {
  tableBody.innerHTML = "";

  nameCoin.split(",").forEach((coin, index) => {
    const tr = document.createElement("tr");
    const coinNameTd = document.createElement("td");
    const coinIconDiv = document.createElement("div");
    const coinNameDiv = document.createElement("div");
    const rankTd = document.createElement("td");
    const priceTd = document.createElement("td");
    const changeTd = document.createElement("td");

    coinIconDiv.classList.add("coin-icon");
    coinNameDiv.classList.add("coin-name");

    coinIconDiv.innerHTML = `<img class="icon-crypt" src="/Assets/Images/CryptocurrencyIcons/${coin}.svg"/>`;
    coinNameDiv.textContent = coin;
    rankTd.textContent = index + 1;
    priceTd.textContent = "Loading...";
    changeTd.textContent = "Loading...";

    coinNameTd.appendChild(coinIconDiv);
    coinNameTd.appendChild(coinNameDiv);
    coinNameTd.classList.add("coin-name");
    tr.appendChild(coinNameTd);
    tr.appendChild(rankTd);
    tr.appendChild(priceTd);
    tr.appendChild(changeTd);
    tableBody.appendChild(tr);
  });
};

const updateTableItems = async () => {
  try {
    const response = await fetch("https://api.coincap.io/v2/assets");
    const data = await response.json();
    const coins = data.data;

    const tableRows = document.querySelectorAll("tbody tr");

    tableRows.forEach((row) => {
      const coinNameElement = row.querySelector(".coin-name");
      const coinName = coinNameElement.textContent.trim();

      // Ubah format nama koin untuk pencocokan
      const formattedCoinName = coinName.toLowerCase().replace(/\s+/g, "-");

      // Cari data koin berdasarkan id atau name yang sudah diformat
      const coinData = coins.find(
        (coin) =>
          coin.id === formattedCoinName ||
          coin.name.toLowerCase() === coinName.toLowerCase()
      );

      if (coinData) {
        // Update price
        const priceTd = row.querySelector("td:nth-child(3)");
        const price = parseFloat(coinData.priceUsd);
        priceTd.textContent = `$${price.toLocaleString("en-US", {
          minimumFractionDigits: 2,
          maximumFractionDigits: 2,
        })}`;

        // Update change percentage
        const changeTd = row.querySelector("td:nth-child(4)");
        const changePercent = parseFloat(coinData.changePercent24Hr);
        changeTd.textContent = `${
          changePercent >= 0 ? "+" : ""
        }${changePercent.toFixed(2)}%`;
        changeTd.className =
          changePercent >= 0 ? "positive-change" : "negative-change";
      }
    });
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};
