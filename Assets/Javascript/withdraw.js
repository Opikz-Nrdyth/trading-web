const data = [
  {
    name: "Bank Mandiri",
    logo: "https://logo.clearbit.com/bankmandiri.co.id",
  },
  {
    name: "BCA",
    logo: "https://cdn3.iconfinder.com/data/icons/banks-in-indonesia-logo-badge/100/BCA-512.png",
  },
  {
    name: "BRI",
    logo: "https://logo.clearbit.com/bri.co.id",
  },
  {
    name: "BNI",
    logo: "https://logo.clearbit.com/bni.co.id",
  },
  {
    name: "BSI",
    logo: "https://logo.clearbit.com/bankbsi.co.id",
  },
  {
    name: "Sea Bank",
    logo: "https://logo.clearbit.com/seabank.co.id",
  },
  {
    name: "OVO",
    logo: "https://logo.clearbit.com/ovo.id",
  },
  {
    name: "GoPay",
    logo: "https://logo.clearbit.com/gopay.co.id",
  },
  {
    name: "DANA",
    logo: "https://logo.clearbit.com/dana.id",
  },
  {
    name: "LinkAja",
    logo: "https://logo.clearbit.com/linkaja.id",
  },
  {
    name: "ShopeePay",
    logo: "https://logo.clearbit.com/shopee.co.id",
  },
];

const dropdown = document.getElementById("dropdown");
const searchInput = document.getElementById("searchInput");

function createDropdownItem(item) {
  return `
        <div class="dropdown-item" onclick="selectItem('${item.name}')">
            <img src="${item.logo}" alt="${item.name}" onerror="this.src='https://via.placeholder.com/40'">
            <span>${item.name}</span>
        </div>
    `;
}

function renderDropdown(items) {
  dropdown.innerHTML = items.map((item) => createDropdownItem(item)).join("");
}

function filterItems() {
  const searchTerm = searchInput.value.toLowerCase();
  const filteredData = data.filter((item) =>
    item.name.toLowerCase().includes(searchTerm)
  );
  renderDropdown(filteredData);
}

function showDropdown() {
  dropdown.style.display = "block";
  filterItems();
}

function hideDropdown() {
  setTimeout(() => {
    dropdown.style.display = "none";
  }, 200);
}

function selectItem(name) {
  searchInput.value = name;
  hideDropdown();
}

// Initial render
renderDropdown(data);

// Prevent hiding dropdown when clicking inside it
dropdown.addEventListener("mousedown", (e) => {
  e.preventDefault();
});
