const widthScreen = window.screen.width;
const mainComponent = document.querySelectorAll(".container-main-open");
const sideBar = document.querySelector(".open-container");
if (widthScreen <= 450) {
  if (mainComponent && mainComponent.length > 0) {
    mainComponent.forEach((item) => {
      item.classList.replace("container-main-open", "container-main-close");
    });
  }

  if (sideBar) {
    sideBar.classList.replace("open-container", "close-container");
  }
}

function openSideBar() {
  if (mainComponent && mainComponent.length > 0) {
    mainComponent.forEach((item) => {
      item.classList.replace("container-main-close", "container-main-open");
    });
  }

  if (sideBar) {
    sideBar.classList.replace("close-container", "open-container");
  }
}

function closeSideBar() {
  if (mainComponent && mainComponent.length > 0) {
    mainComponent.forEach((item) => {
      item.classList.replace("container-main-open", "container-main-close");
    });
  }

  if (sideBar) {
    sideBar.classList.replace("open-container", "close-container");
  }
}

let openSidebarValidation = true;
if (widthScreen <= 450) {
  openSidebarValidation = false;
}

document.querySelector(".bars").addEventListener("click", () => {
  if (openSidebarValidation) {
    closeSideBar();
    openSidebarValidation = false;
  } else {
    openSideBar();
    openSidebarValidation = true;
  }
});

document.querySelector(".arrow-close-side").addEventListener("click", () => {
  closeSideBar();
  openSidebarValidation = false;
});
