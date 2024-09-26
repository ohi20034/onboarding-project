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


/* document.addEventListener('DOMContentLoaded', function() {
  const loginForm = document.getElementById('loginForm');

  loginForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const email = document.getElementById('email').value;
      const password = document.getElementById('password').value;

      const formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);

      fetch('login.php', {
          method: 'POST',
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              window.location.href = 'index.php';
          } else {
              alert(data.message || 'Login failed. Please try again.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('An error occurred. Please try again.');
      });
  });
}); */