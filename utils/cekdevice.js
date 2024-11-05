document.addEventListener("DOMContentLoaded", function () {
  const userAgent = navigator.userAgent;
  const viewData = document.querySelector(".desktop");

  const containerPembayaran = document.querySelector(".table-desktop");

  if (/Mobi|Android/i.test(userAgent)) {
    if (viewData) {
      viewData.classList.replace("desktop", "mobile");
    }
    if (containerPembayaran) {
      containerPembayaran.classList.replace("table-desktop", "table-mobile");
    }
  } else {
    // alert("Hanya Mendukung Tampilan Mobile atau Tablet");
  }
});
