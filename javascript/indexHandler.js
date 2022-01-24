
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

   loginBtn.addEventListener("click", () => {
      enableSpinner();
   });
   
   signinBtn.addEventListener("click", () => {

      // if(signUserName.value !== ""
      // && signEmail.value !== ""
      // && signConfirmEmail.value !== ""
      // && signPassword.value !== ""
      // && signConfirmPsw.value !== "") {

      //    enableSpinner();
      // }
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