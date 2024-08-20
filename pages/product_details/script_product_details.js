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
