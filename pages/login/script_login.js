document.addEventListener("scroll", function () {
  console.log(window.scrollY);
  if (window.scrollY >= 30.0) {
    header_container.style.backgroundColor = "#b0d1c8";
  } else {
    header_container.style.backgroundColor = "";
  }
});

window.addEventListener('resize', function() {
  var formDiv = document.querySelector('form > div');
  if (window.innerWidth <= 768) {
      formDiv.style.width = '100%';
  } else {
      formDiv.style.width = '50%';
  }
});
