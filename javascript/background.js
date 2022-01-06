
"use strict"

const URL = "http://localhost/test-php";


const disableSpinner = () => {
   const spinner = document.querySelector(".backload");
   spinner.classList.add("hide");
}


const disableServerAlert = () => {
   const delay = 3000; // <== miliseconds
   const serverAlert = document.querySelector(".server-alert");
   
   if(serverAlert) {
      setTimeout(() => serverAlert.classList.add("hide"), delay);
   }
}


window.addEventListener("load", () => {
   disableSpinner();
   disableServerAlert();
})