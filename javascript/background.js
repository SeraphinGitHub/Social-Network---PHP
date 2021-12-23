
"use strict"

const URL = "http://localhost/test-php";

const getUrlParams = (param) => {
   const params = new URLSearchParams(window.location.search);
   return params.get(param);
}