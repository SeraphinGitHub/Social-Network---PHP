
"use strict"

const swapLogPages = () => {

   const createAccBtn = document.querySelector(".create-account-btn");
   const backBtn = document.querySelector(".back-btn");
   const login = document.querySelector(".login-container");
   const signin = document.querySelector(".signin-container");

   createAccBtn.addEventListener("click", () => {
      login.classList.add("hide");
      signin.classList.remove("hide");
   });
   
   backBtn.addEventListener("click", () => {
      login.classList.remove("hide");
      signin.classList.add("hide");
   });
}

window.addEventListener("load", () => {
   swapLogPages();
});