
"use strict"

const pagesSwap = () => {

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

const formSubmition = () => {
   
   // Forms & buttons
   const loginForm = document.querySelector(".login-form");
   const loginBtn = document.querySelector(".login-btn");
   const siginForm = document.querySelector(".signin-form");
   const signinBtn = document.querySelector(".signin-btn");
   const loadingSpinner = document.querySelector(".backload");

   // Log inputFields
   const logUserName = document.getElementById("logUserName");
   const logEmail = document.getElementById("logEmail");
   const logPassword = document.getElementById("logPassword");
   

   // Sign inputFields
   const signUserName = document.getElementById("signUserName");
   const signEmail = document.getElementById("signEmail");
   const signConfirmEmail = document.getElementById("signConfirmEmail");
   const signPassword = document.getElementById("signPassword");
   const signConfirmPsw = document.getElementById("signConfirmPsw");

   // let loginFormData = new FormData(loginForm);
   // let signinFormData = new FormData(signinForm);

   
   loginBtn.addEventListener("click", (event) => {
      // event.preventDefault();
      loadingSpinner.classList.remove("hide");
      
      // loginFormData.set(logUserName.name, logUserName.value);
      // loginFormData.set(logEmail.name, logEmail.value);
      // loginFormData.set(logPassword.name, logPassword.value);

      // loginFormData.forEach((key, value) => loginFormData[value] = key);

      // console.log(loginFormData);
   });
   
   signinBtn.addEventListener("click", (event) => {
      // event.preventDefault();
      loadingSpinner.classList.remove("hide");
   });
}


const alertMessage = (messageClass) => {
   const duration = 2500;
   messageClass.classList.remove("hide");
   setTimeout(() => messageClass.classList.add("hide"), duration);
}


window.addEventListener("load", () => {
   pagesSwap();
   formSubmition();
});