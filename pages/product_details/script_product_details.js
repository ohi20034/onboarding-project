
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

document. addEventListener("scroll", function () {
  console.log(window.scrollY);
  if (window.scrollY >= 58.0) {
    header_container.style.backgroundColor = "#b0d1c8";
  } else {
    header_container.style.backgroundColor = "";
  }
});





let imageZoom = document.getElementById("imageZoom");

imageZoom.addEventListener("mousemove", (event) => {
  imageZoom.style.setProperty("--display", "block");
  
  // Calculate the percentage based on the element's dimensions
  let rect = imageZoom.getBoundingClientRect();
  let pointer = {
    x: (event.offsetX * 100)/imageZoom.offsetWidth, /* ((event.clientX - rect.left) / rect.width) * 100 */
    y: (event.offsetY * 100)/imageZoom.offsetHeight/* ((event.clientY - rect.top) / rect.height) * 100 */,
  };

  imageZoom.style.setProperty('--zoom-x', pointer.x + '%'); 
  imageZoom.style.setProperty('--zoom-y', pointer.y + '%');
});

imageZoom.addEventListener('mouseout', () => {
  imageZoom.style.setProperty('--display', 'none');
});
