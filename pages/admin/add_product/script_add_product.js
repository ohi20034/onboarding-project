document.addEventListener("DOMContentLoaded", () => {
    const fontTypeSelect = document.getElementById("font-type");
    const boldButton = document.querySelector(".tool-item-3 button");
    const colorInput = document.getElementById("font-color");
    const bulletButton = document.querySelector(".tool-item-2 button");
    const textarea = document.getElementById("description-aera");
  
    function applyStyle(command, value = null) {
      document.execCommand(command, false, value);
    }
  
    bulletButton.addEventListener("click", () => {
      applyStyle('insertUnorderedList');
    });
  
    boldButton.addEventListener("click", () => {
      applyStyle("bold");
    });
  
    fontTypeSelect.addEventListener("change", (e) => {
      const sizeMapping = {
        "Normal Text": "16px",
        "Heading 1": "32px",
        "Heading 2": "24px",
      };
      document.execCommand("fontSize", false, "7");
      const elements = textarea.getElementsByTagName("font");
      for (let element of elements) {
        if (element.size === "7") {
          element.removeAttribute("size");
          element.style.fontSize = sizeMapping[e.target.value];
        }
      }
    });
  
    colorInput.addEventListener("input", (e) => {
      applyStyle("foreColor", e.target.value);
    });
  });
  

  