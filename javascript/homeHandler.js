
"use strict"

// ===================================================================
// Custom Colors
// ===================================================================
let customizeArray = [];

// If add new "querySelectorAll" ==> modify: addNewColor() & removeOldColor()
const htmlElements = {
   nav: document.querySelector(".nav-bar"),
   post: document.querySelectorAll(".post"),
   scroll: document.querySelector(".news"),
   publish: document.querySelector(".publish"),
}

const colorsRange = (elem) => {
   const colorsObj = {

      "Orange": `${elem}-orange`,
      "Red": `${elem}-red`,
      "Violet": `${elem}-violet`,
      "Light Blue": `${elem}-light-blue`,
      "Dark Blue": `${elem}-dark-blue`,
      "Green": `${elem}-green`,

   };
   return colorsObj;
}

const customColorMenu = () => {
   const customColorBtn = document.querySelector(".custom-color-btn");
   const colorsList = document.querySelector(".colors-list");
   const colorBtn = document.querySelectorAll(".colors-list button");
   
   let showColorsMenu = false;
   
   customColorBtn.addEventListener("click", () => {
      if(!showColorsMenu) colorsList.classList.add("show");
      if(showColorsMenu) colorsList.classList.remove("show");
      return showColorsMenu = !showColorsMenu;
   });
   
   colorBtn.forEach(btn => {
      btn.addEventListener("click", () => {

         let elemPairs = Object.entries(htmlElements);

         elemPairs.forEach(elemPair => {       
            let elemName = elemPair[0];
            let elemClass = elemPair[1];

            let colorsPairs = Object.entries( colorsRange(elemName) );

            colorsPairs.forEach(colorsPair => {
               let colorName = colorsPair[0];
               let colorClass = colorsPair[1];
               
               removeOldColor(elemName, elemClass, colorClass);
               addNewColor(btn, elemName, elemClass, colorName, colorClass);
            });
         });

         // Set Request
         const customData = {
            navClass: customizeArray[0],
            postClass: customizeArray[1],
            scrollClass: customizeArray[2],
            publishClass: customizeArray[3],
         }

         // Send to DB
         ajaxRequest("custom", customData);
         customizeArray = [];
         
         colorsList.classList.remove("show");
         showColorsMenu = false;
      });
   });
}

const addNewColor = (btn, elemName, elemClass, colorName, colorClass) => {
   
   if(btn.textContent === colorName) {
      if(elemName === "post" /* || "new querySelectorAll element" */ ) {
         elemClass.forEach(elem => elem.classList.add(colorClass));
      }
      else elemClass.classList.add(colorClass);

      customizeArray.push(colorClass);
   }
}

const removeOldColor = (elemName, elemClass, colorClass) => {

   if(elemName === "post" /* || "new querySelectorAll element" */ ) {
      elemClass.forEach(elem => elem.classList.remove(colorClass));
   }
   else elemClass.classList.remove(colorClass);
}


// ===================================================================
// Logout Button
// ===================================================================
const logout = () => {
   const logoutBtn = document.querySelector(".logout-btn");

   logoutBtn.addEventListener("click", () => {

      ajaxRequest({ logout: "" });
      window.location.href = "index.php";
   });
}


// ===================================================================
// Toggle Publish
// ===================================================================
const togglePublish = () => {
   
   const animDuration = 700; // Seconds 

   const showPublishBtn = document.querySelector(".show-publish-btn");
   const hidePublishBtn = document.querySelector(".hide-publish-btn");

   const news = document.querySelector(".news");
   const publish = document.querySelector(".publish");
   const textContainer = document.querySelector(".publish-field-container");
   const btnContainer = document.querySelector(".btn-container");


   // Show Publish
   showPublishBtn.addEventListener("click", () => {
      
      showPublishBtn.classList.add("hide");
      news.classList.remove("news-height");
      publish.classList.add("publish-height");
      
      setTimeout(() => {
         textContainer.classList.remove("hide");
         btnContainer.classList.remove("hide");

      }, animDuration);
   });


   // Hide Publish
   hidePublishBtn.addEventListener("click", () => {

      news.classList.add("news-height");
      publish.classList.remove("publish-height");
      textContainer.classList.add("hide");
      btnContainer.classList.add("hide");

      setTimeout(() => showPublishBtn.classList.remove("hide"), animDuration);
   });
}


// ===================================================================
// Publish Post
// ===================================================================
const publishPost = () => {
   
   const publishBtn = document.querySelector(".publish-btn");
   const publishForm = document.querySelector(".publish-field-container");
   const title = document.getElementById("title");
   const content = document.getElementById("content");

   // Publish
   publishBtn.addEventListener("click", () => {
      
      let formData = new FormData(publishForm);
      formData.forEach((key, value) => formData[value] = key );
      
      formValidation(formData, title, textRegEx);
      formValidation(formData, content, textRegEx);
      
      if(formData.title !== ""
      && formData.content !== "") {

         ajaxRequest("publishPost", formData);
         title.value = "";
         content.value = "";
      }
   });
}


// ===================================================================
// Modify Post
// ===================================================================
const modifyPost = (postID) => {
   
   console.log( "Nothing here !" );
}


// ===================================================================
// Delete Post
// ===================================================================
const deletePost = (postID) => {

   ajaxRequest("deletePost", { id: postID });
}


// ===================================================================
// Several Buttons Loop
// ===================================================================
const severalBtnsEvent = (allBtns, callback) => {
   
   if(allBtns) allBtns.forEach(btn => {
      btn.addEventListener("click", (event) => {
      
         const postID = event.target.parentElement.parentElement.parentElement.id;
         callback(postID);
      });
   });
}


window.addEventListener("load", () => {

   customColorMenu();
   // logout();
   togglePublish();
   publishPost();

   const allDeleteBtns = document.querySelectorAll(".delete-btn");
   const allModifyBtns = document.querySelectorAll(".edit-btn");

   severalBtnsEvent(allDeleteBtns, deletePost);
   severalBtnsEvent(allModifyBtns, modifyPost);
});