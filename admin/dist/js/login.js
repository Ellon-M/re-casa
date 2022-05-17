// ECMAScript 5
"use strict";

function loginAdmin(e) {
    e.preventDefault();
    let email = document.getElementById("user-email").value;
    let password = document.getElementById("user-password").value;

    let loginResponseDiv = document.getElementById("login-response");


    if (email === "" || password === ""){
        loginResponseDiv.insertAdjacentHTML("beforeend", "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>");
    }else{
        let loginForm = new FormData();

        loginForm.append("email",email);
        loginForm.append("password",password);


        let xhr = new XMLHttpRequest();
        xhr.open("post","ajax/login.php",true);

        xhr.onload = function () {
            loginResponseDiv.innerHTML = "";
            loginResponseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
        };

        xhr.send(loginForm);
    }
}