let data;
fetch("/utils/datasetbank.json")
  .then((response) => {
    return response.json();
  })
  .then((json) => {
    data = json;
    console.log(data);
  });

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
