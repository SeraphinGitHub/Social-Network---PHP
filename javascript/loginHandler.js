
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


   // Have to contain: LETTER || letter || number || dot || under score || dash && @ && LETTER || letter || number && dot && LETTER || letter
   const emailRegEx = new RegExp(/^[A-Za-z0-9._-]+[@]+[A-Za-z0-9]+[.]+[A-Za-z]+$/);

   // Have to contain: LETTER || letter || accent letters || spaces || dash
   const normalTextRegEx = new RegExp(/^[A-Za-zÜ-ü\s-']+$/);

   // Have to contain: LETTER || letter || number || accent letters || number && minimum 10 characters 
   const passwordRegEx = new RegExp(/^[A-Za-zÜ-ü0-9!@#$%^&*].{9,}$/);


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

// const formValidation = (formData) => {

//    // if Empty Field
//    if(logFormInput.value === "") alertMessage(emptyFieldAlert);

//    // if player name is less than 4 characters
//    else if(logFormInput.value.length < 4) alertMessage(minCharsAlert);

//    // if player name is more than 10 characters
//    else if(logFormInput.value.length > 10) alertMessage(maxCharsAlert);

//    // if include white space
//    else if(includeSpaceRegEx.test(logFormInput.value)) alertMessage(whiteSpaceAlert);

//    // if include any special characters or number
//    else if(!playerNameRegEx.test(logFormInput.value)) alertMessage(invalidAlert);

//    // if everything's fine ==> Connect Player
//    else if(!isSocket) {

      
//    }
// }


const alertMessage = (messageClass) => {
   const duration = 2500;
   messageClass.classList.remove("hide");
   setTimeout(() => messageClass.classList.add("hide"), duration);
}


window.addEventListener("load", () => {
   pagesSwap();
   formSubmition();
});