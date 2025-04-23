function sideMenu(menu) {
    const SelectedMenu = document.getElementById(`link-grup-${menu}`);
    if (SelectedMenu.style.display == "none") {
        SelectedMenu.style.display = "flex";
    } else {
        SelectedMenu.style.display = "none";
    }
}

const handphone = window.screen.width < 900;

const bars = document.getElementById("bars");
bars.addEventListener("click", () => {
    const sidebar = document.getElementById("sidebar");
    const mainLink = document.querySelectorAll(".main-link");
    const header = document.getElementById("header");
    let px4 = document.querySelectorAll(".px-4");
    const main = document.querySelector("main");

    sidebar.classList.forEach((item) => {
        //Side Menutup
        if (item.includes("w-[20%]") || item.includes("w-[60px]")) {
            if (handphone) {
                sidebar.classList.replace("w-[20%]", "w-[60px]");
                sidebar.classList.replace("ml-0", "-ml-20");
            } else {
                sidebar.classList.replace("w-[20%]", "w-[5%]");
                header.classList.replace("lg:w-[80%]", "lg:w-[95%]");
                main.classList.replace("lg:w-[80%]", "lg:w-[95%]");
            }
            mainLink.forEach((item) => {
                item.classList.add("hidden");
            });

            px4.forEach((item) => {
                item.classList.replace("px-4", "pl-2");
            });
        }

        // Side Membuka
        if (item.includes("w-[5%]") || item.includes("w-[60px]")) {
            px4 = document.querySelectorAll(".pl-2");
            if (handphone) {
                sidebar.classList.replace("w-[60px]", "w-[80%]");
                sidebar.classList.replace("-ml-20", "ml-0");
            } else {
                sidebar.classList.replace("w-[5%]", "w-[20%]");
                header.classList.replace("lg:w-[95%]", "lg:w-[80%]");
                main.classList.replace("lg:w-[95%]", "lg:w-[80%]");
            }

            mainLink.forEach((item) => {
                item.classList.remove("hidden");
            });

            px4.forEach((item) => {
                item.classList.replace("pl-2", "px-4");
            });
        }

        //tampilan HP Membuka
        if (item.includes("w-[80%]")) {
            px4 = document.querySelectorAll(".px-4");
            sidebar.classList.replace("w-[80%]", "w-[60px]");
            header.classList.replace("w-[100%]", "w-[85%]");
            sidebar.classList.replace("ml-0", "-ml-20");

            mainLink.forEach((item) => {
                item.classList.add("hidden");
            });

            px4.forEach((item) => {
                item.classList.replace("px-4", "pl-2");
            });
        }
    });
});

if (handphone) {
    bars.click();
}
