function initTradingViewWidget() {
  new TradingView.widget({
    width: "100%",
    height: "calc(100vh - 260px)",
    symbol: "BINANCE:BTCUSD",
    interval: "D",
    timezone: "Etc/UTC",
    theme: "dark",
    style: "1",
    locale: "en",
    toolbar_bg: "#132f4c",
    enable_publishing: false,
    allow_symbol_change: true,
    container_id: "tradingview-widget-container",
    studies: ["MASimple@tv-basicstudies"],
    show_popup_button: true,
    popup_width: "1000",
    popup_height: "650",
    hide_side_toolbar: false,
    watchlist: Object.keys(assetMap).map(
      (pair) => "BINANCE:" + pair.replace("/", "")
    ),
  });
}

// Initialize on page load
document.addEventListener("DOMContentLoaded", () => {
  const initTrading = initTradingViewWidget();
});
