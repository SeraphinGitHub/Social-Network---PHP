
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

const submitLogForms = () => {
   
   const loginBtn = document.querySelector(".login-btn");
   const signinBtn = document.querySelector(".signin-btn");
   const loadingSpinner = document.querySelector(".backload");
   
   loginBtn.addEventListener("click", (event) => {
      // event.preventDefault();
      loadingSpinner.classList.remove("hide");
   });
   
   signinBtn.addEventListener("click", (event) => {
      // event.preventDefault();
      loadingSpinner.classList.remove("hide");
   });
}

window.addEventListener("load", () => {
   swapLogPages();
   submitLogForms();
});