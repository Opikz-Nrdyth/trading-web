const inputFields = document.querySelectorAll("input");

inputFields.forEach((input) => {
  // Scroll ke atas saat blur
  input.addEventListener("blur", () => {
    window.scrollTo(0, 0);
  });
});
