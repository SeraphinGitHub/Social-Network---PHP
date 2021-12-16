
"use strict"

const disableSpinner = () => {
   const spinner = document.querySelector(".backload");
   spinner.classList.add("hide");
}

window.addEventListener("load", () => {
   disableSpinner();
});