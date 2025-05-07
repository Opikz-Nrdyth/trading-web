document.addEventListener("DOMContentLoaded", function (event) {
    let toogle_menu = document.getElementById("menu-toggle");
    let mobile_menu = document.getElementById("mobile-menu");
    let section_header = document.getElementById("section-header");

    toogle_menu.addEventListener("click", function () {
        if (mobile_menu.classList.contains("hidden")) {
            mobile_menu.classList.replace("hidden", "flex");
        } else {
            mobile_menu.classList.replace("flex", "hidden");
        }
    });

    if (window.scrollY > 1) {
        section_header.classList.add("bg-blue-600/20", "backdrop-blur-sm");
    }
    window.addEventListener("scroll", () => {
        if (window.scrollY > 1) {
            section_header.classList.add("bg-blue-600/20", "backdrop-blur-sm");
        } else {
            if (section_header.classList.contains("bg-blue-600/20")) {
                section_header.classList.remove("bg-blue-600/20");
            }

            if (section_header.classList.contains("backdrop-blur-sm")) {
                section_header.classList.remove("backdrop-blur-sm");
            }
        }
    });
});
