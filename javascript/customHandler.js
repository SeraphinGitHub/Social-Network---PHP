
"use strict"

let customizeArray = [];

// If add new "querySelectorAll" ==> modify: addNewColor() & removeOldColor()
const htmlElements = {
   nav: document.querySelector(".nav-bar"),
   post: document.querySelectorAll(".post"),
   scroll: document.querySelector(".news"),
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

         saveColorChange();
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

const saveColorChange = () => {

   let xhr = new XMLHttpRequest();
   xhr.open("POST", "ajax.php", true);
   xhr.setRequestHeader("Content-Type", "application/json; charset=utf-8");

   const customData = {
      navClass: customizeArray[0],
      postClass: customizeArray[1],
      scrollClass: customizeArray[2],
   }

   const userData = {
      id: getUrlParams("id"),
   }
   
   xhr.send(JSON.stringify( [customData, userData] ));
   customizeArray = [];
}

window.addEventListener("load", () => {
   customColorMenu();
});