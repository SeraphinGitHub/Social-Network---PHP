
"use strict"

const URL = "http://localhost/test-php";

const getUrlParams = (param) => {
   const params = new URLSearchParams(window.location.search);
   return params.get(param);
}


const disableSpinner = () => {
   const spinner = document.querySelector(".backload");
   spinner.classList.add("hide");
}


const disableServerAlert = () => {
   const delay = 3000; // <== miliseconds
   
   const serverAlert = document.querySelector(".server-alert");
   setTimeout(() => serverAlert.classList.add("hide"), delay);
}