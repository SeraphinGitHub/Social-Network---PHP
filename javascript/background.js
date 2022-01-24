
"use strict"

const URL = "http://localhost/test-php";

const textRegEx = new RegExp(/^[A-Za-zÜ-ü0-9!@#$%^&*_-]+$/);
const userNameRegEx = new RegExp(/^[A-Za-zÜ-ü0-9_-]+$/);
const emailRegEx = new RegExp(/^[A-Za-z0-9._-]+[@]+[A-Za-z0-9]+[.]+[A-Za-z]+$/);
const passwordRegEx = new RegExp(/^[A-Za-zÜ-ü0-9!@#$%^&*].{9,}$/);


const ajaxRequest = (name, objData) => {
   
   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax.php", true);
   xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");   
   xhr.send(JSON.stringify( [name, objData] ));
}


// ===================================================================
// Disable Loading Spinner
// ===================================================================
const disableSpinner = () => {
   const spinner = document.querySelector(".backload");
   spinner.classList.add("hide");
}


// ===================================================================
// Enable Loading Spinner
// ===================================================================
const enableSpinner = () => {
   const spinner = document.querySelector(".backload");
   spinner.classList.remove("hide");
}


// ===================================================================
// Hide Server Alert
// ===================================================================
const disableServerAlert = () => {
   const delay = 3000; // <== miliseconds
   const serverAlert = document.querySelector(".server-alert");
   
   if(serverAlert) {
      setTimeout(() => serverAlert.classList.add("hide"), delay);
   }
}


// ===================================================================
// Form Validation
// ===================================================================
const formValidation = (formdata, inputField, regEx) => {

   // if empty
   if(inputField.value === "") return;

   // if wrong regEx
   else if(!regEx.test(inputField.value)) return;
  
   // if all is correct
   else formdata.set(inputField.name, inputField.value);
}


window.addEventListener("load", () => {
   disableServerAlert();
})