// ECMAScript 5
"use strict";

function propertyVerification(userID,propertyID,isConfirmed) {
    let isConfirmedID ,isConfirmedTitle ;
    if (isConfirmed){
        isConfirmedID = 1;
        isConfirmedTitle = 1;
    }else{
        isConfirmedID = 0;
        isConfirmedTitle = 0;
    }

    let errorDiv = document.getElementById("verification-response");

    let propertyVerificationForm = new FormData();

    propertyVerificationForm.append("user_id",userID);
    propertyVerificationForm.append("is_confirmed_id",isConfirmedID);
    propertyVerificationForm.append("is_confirmed_title",isConfirmedTitle);
    propertyVerificationForm.append("property_id",propertyID);

    let xhr = new XMLHttpRequest();
    xhr.open("post","ajax/verify-seller.php",true);
    xhr.onload = function () {
        errorDiv.innerHTML = "";
        errorDiv.insertAdjacentHTML("beforeend", xhr.responseText);
        if (document.getElementById("results-ajax") !== null){
            eval(document.getElementById("results-ajax").innerHTML);
        }
    };
    xhr.send(propertyVerificationForm);
}

function buyerVerification(userID,isConfirmed) {
    let isConfirmedID ,isConfirmedStatement;
    if (isConfirmed){
        isConfirmedID = 1;
        isConfirmedStatement = 1;
    }else{
        isConfirmedID = 0;
        isConfirmedStatement = 0;
    }

    let errorDiv = document.getElementById("verification-response");

    let buyerVerificationForm = new FormData();

    buyerVerificationForm.append("user_id",userID);
    buyerVerificationForm.append("is_confirmed_id",isConfirmedID);
    buyerVerificationForm.append("is_confirmed_statement",isConfirmedStatement);

    let xhr = new XMLHttpRequest();
    xhr.open("post","ajax/verify-buyer.php",true);
    xhr.onload = function () {
        errorDiv.innerHTML = "";
        errorDiv.insertAdjacentHTML("beforeend", xhr.responseText);
        if (document.getElementById("results-ajax") !== null){
            eval(document.getElementById("results-ajax").innerHTML);
        }
    };
    xhr.send(buyerVerificationForm);
}

function confirmDeletion(propertyID) {
    let deletePropertyForm = new FormData();

    let errorDiv = document.getElementById("verification-response");

    deletePropertyForm.append("property_id",propertyID);

    let xhr = new XMLHttpRequest();
    xhr.open("post","ajax/delete-property.php",true);
    xhr.onload = function () {
        errorDiv.innerHTML = "";
        errorDiv.insertAdjacentHTML("beforeend", xhr.responseText);
        if (document.getElementById("results-ajax") !== null){
            eval(document.getElementById("results-ajax").innerHTML);
        }
    };
    xhr.send(deletePropertyForm);
}
