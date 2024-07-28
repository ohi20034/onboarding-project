const searchInput = document.getElementById("searchInput");
const searchButton = document.getElementById("searchButton");
const navLastPart = document.querySelector(".nav-last-part");
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