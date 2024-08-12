const searchInput = document.getElementById("searchInput");
const searchButton = document.getElementById("searchButton");
const navLastPart = document.querySelector(".nav-last-part");
const header_container = document.querySelector(".container");

let isSearchExpanded = true;

searchButton.addEventListener("click", function () {
  const screenWidth = window.innerWidth;
  if (screenWidth <= 450) {
    if (isSearchExpanded) {
      navLastPart.style.display = "none";
      searchInput.style.display = "flex";
      searchButton.style.borderRadius = "0 8px 8px 0";
      searchInput.style.fontSize = "16px";
    } else {
      navLastPart.style.display = "flex";
      searchInput.style.display = "none";
      searchButton.style.borderRadius = "8px";
    }
    isSearchExpanded = !isSearchExpanded;
  }
});

document.addEventListener("scroll", function () {
  console.log(window.scrollY);
  if (window.scrollY >= 58.0) {
    header_container.style.backgroundColor = "#b0d1c8";
  } else {
    header_container.style.backgroundColor = "";
  }
});

function changeValue(digit, rowId) {
  const numberInput = document.getElementById(rowId);
  const currentValue = parseInt(numberInput.value);

  if (currentValue === 1 && digit === -1) {
    return;
  }

  const newValue = currentValue + digit;
  numberInput.value = newValue;

  updateTotalPrice(rowId, newValue);
}

function updateTotalPrice(rowId, quantity) {
  const row = document.querySelector(`tr[data-row-id="${rowId}"]`);

  const unitPriceCell = row.querySelector(".cart-table-unitprice");
  const unitPrice = parseFloat(
    unitPriceCell.textContent.replace(/[^0-9.-]+/g, "")
  );

  const totalPrice = quantity * unitPrice;

  const totalPriceCell = document.getElementById(`total-${rowId}`);
  totalPriceCell.textContent = totalPrice.toFixed(2);
}
