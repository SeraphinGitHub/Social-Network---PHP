
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
const togglePublishDuration = 700; // Milliseconds

const togglePublish = () => {

   const showPublishBtn = document.querySelector(".show-publish-btn");
   const hidePublishBtn = document.querySelector(".hide-publish-btn");
   const publishBtn = document.querySelector(".publish-btn");

   let hidePublishBtnsArray = [
      hidePublishBtn,
      publishBtn,
   ];

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

      }, togglePublishDuration);
   });


   // Hide Publish
   hidePublishBtnsArray.forEach((btn) => {
      btn.addEventListener("click", () => {
   
         news.classList.add("news-height");
         publish.classList.remove("publish-height");
         textContainer.classList.add("hide");
         btnContainer.classList.add("hide");
   
         setTimeout(() => showPublishBtn.classList.remove("hide"), togglePublishDuration);
      });
   });
}


// ===================================================================
// Publish Base
// ===================================================================
const publish_Base = (formData, title, content, state) => {

   formData.forEach((key, value) => formData[value] = key );
      
   formValidation(formData, title, textRegEx);
   formValidation(formData, content, textRegEx);
   
   if(formData.title !== ""
   && formData.content !== "") {

      ajaxRequest(state, formData);

      if(state === "publishPost") {
         title.value = "";
         content.value = "";
      }
      
      setTimeout(() => location.reload(), togglePublishDuration);
   }
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
      publish_Base(formData, title, content, "publishPost");
   });
}


// ===================================================================
// Re Publish Post
// ===================================================================
const republishPost = (post) => {
   
   const modifTitle = post.querySelector(".post-title-input");
   const modifContent = post.querySelector(".post-content-textarea");
   
   let formData = new FormData();
   formData.set("id", post.id);
   formData.set("title", modifTitle.value);
   formData.set("content", modifContent.value);
   
   publish_Base(formData, modifTitle, modifContent, "modifyPost");
}


// ===================================================================
// Modify Post
// ===================================================================
const modifyPost = (post, btn) => {

   const postTitle = post.querySelector(".post-title");
   const postContent = post.querySelector(".post-content");
   const modifPostTitle = post.querySelector(".post-title-input");
   const modifPostContent = post.querySelector(".post-content-textarea");
   const republishContainer = post.querySelector(".republish-btn-container");

   // Edit Post
   if(btn.textContent !== "Retour") {

      btn.textContent = "Retour";
      btn.classList.add("violet-btn");

      postTitle.classList.add("erase");
      postContent.classList.add("erase");
      modifPostTitle.classList.remove("erase");
      modifPostContent.classList.remove("erase");
      republishContainer.classList.remove("erase");

      modifPostTitle.focus();
      modifPostTitle.value = postTitle.textContent;
      modifPostContent.value = postContent.textContent;
   }

   // Back
   else {
      btn.textContent = "Modifier";
      btn.classList.remove("violet-btn");

      postTitle.classList.remove("erase");
      postContent.classList.remove("erase");
      modifPostTitle.classList.add("erase");
      modifPostContent.classList.add("erase");
      republishContainer.classList.add("erase");
   }
}


// ===================================================================
// Delete Post
// ===================================================================
const deletePost = (post) => {

   ajaxRequest("deletePost", { id: post.id });
   setTimeout(() => location.reload(), 100);
}


// ===================================================================
// Post Buttons Event
// ===================================================================
const postButtonsEvent = (post, btn, callback) => {

   if(btn) btn.addEventListener("click", () => callback(post, btn));
}


window.addEventListener("load", () => {
   
   customColorMenu();
   // logout();
   togglePublish();
   publishPost();

   const allPosts = document.querySelectorAll(".post");
   
   allPosts.forEach((post) => {
      const modifBtn = post.querySelector(".edit-btn");
      const deleteBtn = post.querySelector(".delete-btn");
      const republishBtn = post.querySelector(".republish-btn");
      
      postButtonsEvent(post, modifBtn, modifyPost);
      postButtonsEvent(post, deleteBtn, deletePost);
      postButtonsEvent(post, republishBtn, republishPost);
   });
});