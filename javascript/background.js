
"use strict"

const URL = "http://localhost/test-php";

const getUrlParams = (param) => {
   const params = new URLSearchParams(window.location.search);
   return params.get(param);
}

const enableSpinner = () => {
   const spinner = document.querySelector(".backload");
   // spinner.classList.remove("hide");
   spinner.style = "display: flex !important";
}

const disableSpinner = () => {
   const spinner = document.querySelector(".backload");
   // spinner.classList.add("hide");
   spinner.style = "display: none !important";
}