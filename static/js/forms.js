// ECMAScript 5
"use strict";

function login(event){
    event.preventDefault();

    let email = document.getElementById("user-email").value;
    let password = document.getElementById("user-password").value;

    let responseDiv = document.getElementById("login-response");
    if (email === "" || password === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else{
        let loginForm = new FormData();

        loginForm.append("email",email);
        loginForm.append("password",password);

        let xhr = new XMLHttpRequest();

        xhr.open("post","ajax/login.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
        };
        xhr.send(loginForm);
    }
}

function register(event){
    event.preventDefault();
    let name = document.getElementById("register-name").value;
    let email = document.getElementById("register-email").value;
    let phoneNumber = document.getElementById("register-phone").value;
    let password = document.getElementById("register-password").value;
    let confirmPassword = document.getElementById("register-confirm-password").value;

    let passwordRegex = "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$";

    let responseDiv = document.getElementById("response-div");

    if (name === "" || email === "" || phoneNumber === "" || password === "" || confirmPassword === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else if(!password.match(passwordRegex)){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\"><p align=\"center\"><strong>\n" +
            "                    <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Password should be at least 8 characters, one uppercase letter, one lowercase letter" +
            " one digit and one special character </p></div>";
    }else if(password !== confirmPassword){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Passwords do not match </p></div>";
    }else if(phoneNumber.length < 10){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Invalid phone number </p></div>";
    }else{
        let registerForm = new FormData();

        registerForm.append("name",name);
        registerForm.append("email",email);
        registerForm.append("phone_number",phoneNumber);
        registerForm.append("password",password);

        let xhr = new XMLHttpRequest();
        xhr.open("post","ajax/register.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
        };
        xhr.send(registerForm);
    }
}

function updateUserDetails(event){
    event.preventDefault();
    let name = document.getElementById("update-name").value;
    let userID = document.getElementById("update-user").value;
    let phoneNumber = document.getElementById("update-phone").value;

    let responseDiv = document.getElementById("update-error-message-div");

    if (name === "" || userID === "" || phoneNumber === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else if(phoneNumber.length < 10){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Invalid phone number </p></div>";
    }else{
        let updateDetailsForm = new FormData();

        updateDetailsForm.append("name",name);
        updateDetailsForm.append("user_id",userID);
        updateDetailsForm.append("phone",phoneNumber);

        let xhr = new XMLHttpRequest();

        xhr.open("post","ajax/update-details.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
        };
        xhr.send(updateDetailsForm);
    }
}

function updatePassword(event) {
    event.preventDefault();
    let userID = document.getElementById("update-user-id").value;
    let oldPassword = document.getElementById("edit-old-password").value;
    let newPassword = document.getElementById("edit-new-password").value;
    let confirmNewPassword = document.getElementById("edit-confirm-new-password").value;

    let responseDiv = document.getElementById("update-password-error-message-div");

    let passwordRegex = "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$";

    if (oldPassword === "" || newPassword === "" || confirmNewPassword === "" || userID === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else if(!newPassword.match(passwordRegex)){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\"><p align=\"center\"><strong>\n" +
            "                    <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Password should be at least 8 characters, one uppercase letter, one lowercase letter" +
            " one digit and one special character </p></div>";
    }else if (newPassword !== confirmNewPassword){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\"><p align=\"center\"><strong>\n" +
            "                    <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Passwords do no match</p></div>";
    }else{
        let updatePasswordForm = new FormData();

        updatePasswordForm.append("old_password",oldPassword);
        updatePasswordForm.append("new_password",newPassword);
        updatePasswordForm.append("user_id",userID);

        let xhr = new XMLHttpRequest();

        xhr.open("post","ajax/update-password.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
        };
        xhr.send(updatePasswordForm);
    }
}

function verifyBuyer(e) {
    e.preventDefault();
    let userID = document.getElementById("verify-user-id").value;
    let verifyBuyerID = document.getElementById("verify-buyer-copy-of-id").files[0];
    let verifyBuyerStatement = document.getElementById("verify-buyer-statement").files[0];

    let responseDiv = document.getElementById("buyer-response-div");

    if (userID === "" || verifyBuyerID === "" || verifyBuyerStatement === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else{
        let verifyBuyerForm = new FormData();

        verifyBuyerForm.append("user_id",userID);
        verifyBuyerForm.append("id_file",verifyBuyerID);
        verifyBuyerForm.append("statement_file",verifyBuyerStatement);

        let xhr = new XMLHttpRequest();

        xhr.open("post","ajax/verify-buyer.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
            console.log(xhr.responseText);
        };
        xhr.send(verifyBuyerForm);
    }

}

function verifySeller(e){
    e.preventDefault();
    let userID = document.getElementById("verify-user-id").value;
    let propertyID = document.getElementById("verify-seller-property-id").value;
    let verifySellerID = document.getElementById("verify-seller-copy-of-id").files[0];
    let verifySellerTitle = document.getElementById("verify-seller-title").files[0];
    let mpesaTransactionCode = document.getElementById("verify-seller-transaction-code").value;

    let responseDiv = document.getElementById("verify-seller-response-div");
    if (userID === "" || verifySellerID === "" || verifySellerTitle === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else if(mpesaTransactionCode === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Provide mpesa transaction code </p></div>";
    }else{
        let verifySellerForm = new FormData();

        verifySellerForm.append("user_id",userID);
        verifySellerForm.append("property_id",propertyID);
        verifySellerForm.append("id_file",verifySellerID);
        verifySellerForm.append("seller_title",verifySellerTitle);
        verifySellerForm.append("transaction_code",mpesaTransactionCode);

        let xhr = new XMLHttpRequest();


        xhr.open("post","ajax/verify-seller.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
            console.log(xhr.responseText);
        };
        xhr.send(verifySellerForm);
    }

}

function contactUs(e){
    e.preventDefault();
    let contactName = document.getElementById("contact-name").value;
    let contactEmail = document.getElementById("contact-customer-mail").value;
    let contactSubject = document.getElementById("contact-subject").value;
    let contactMessage = document.getElementById("contact-message").value;

    let responseDiv = document.getElementById("contact-response-div");

    if (contactName === "" || contactEmail === "" || contactSubject === "" || contactMessage === ""){
        responseDiv.innerHTML = "<hr><div class=\"alert alert-danger\">" +
            "<p align=\"center\"><strong> <i class=\"fa fa-exclamation-triangle\"></i> Error Processing Request!</strong>\n" +
            "                Fill in all the required fields </p></div>";
    }else{
        let contactForm = new FormData();

        contactForm.append("name",contactName);
        contactForm.append("email",contactEmail);
        contactForm.append("subject",contactSubject);
        contactForm.append("message",contactMessage);

        let xhr = new XMLHttpRequest();

        xhr.open("post","ajax/contact-us.php",true);
        xhr.onload = function () {
            responseDiv.innerHTML = "";
            responseDiv.insertAdjacentHTML("beforeend", xhr.responseText);
            if (document.getElementById("results-ajax") !== null){
                eval(document.getElementById("results-ajax").innerHTML);
            }
            console.log(xhr.responseText);
        };
        xhr.send(contactForm);
    }
}