
"use strict"

const colorObj = {
   "Orange": "nav-orange",
   "Red": "nav-red",
   "Violet": "nav-violet",
   "Light Blue": "nav-light-blue",
   "Dark Blue": "nav-dark-blue",
   "Green": "nav-green",
};

const customizeNavbarColor = () => {

   const customColorBtn = document.querySelector(".custom-color-btn");
   const navColorsList = document.querySelector(".nav-colors-list");
   const navBar = document.querySelector(".navBar");
   const colorBtn = document.querySelectorAll(".nav-colors-list button");
   
   let isColorsMenu = false;

   customColorBtn.addEventListener("click", () => {

      if(!isColorsMenu) navColorsList.classList.add("show");
      if(isColorsMenu) navColorsList.classList.remove("show");
      return isColorsMenu = !isColorsMenu;
   });

   colorBtn.forEach(btn => {
      btn.addEventListener("click", () => {

         const btnText = btn.textContent;
         const navClass = navBar.classList;
         let pairsArray = Object.entries(colorObj);
         
         pairsArray.forEach(pair => {
            let key = pair[0];
            let value = pair[1];
            addNewColor(btnText, navClass, key, value);
         });

         navColorsList.classList.remove("show");
         return isColorsMenu = false;
      });
   });
}

const addNewColor = (btnText, navClass, btnColor, btnColorClass) => {
   
   if(btnText.includes(btnColor)) {
      navClass.add(btnColorClass);
   
      const colorArray = Object.values(colorObj);
      colorArray.forEach(pair => removeOldColor(navClass, pair, btnColorClass));

      saveColorChange(btnColorClass);
   }
}

const removeOldColor = (navClass, removeClass, btnColorClass) => {
   if(navClass.contains(removeClass) && btnColorClass !== removeClass) navClass.remove(removeClass);
}

const saveColorChange = (colorClass) => {
   let xhr = new XMLHttpRequest();

   xhr.open("POST", `${URL}/home.php`, true);
   xhr.setRequestHeader("Content-Type", "application/json");

   const data = {
      navClass: colorClass,
   }
   
   xhr.send(JSON.stringify(data));
}

window.addEventListener("load", () => {
   customizeNavbarColor();
});