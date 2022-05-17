// ECMAScript 5
"use strict";

function searchProperties(event) {
    event.preventDefault();

    let ownershipType = document.getElementById("ownership-type").value;
    let location = document.getElementById("location").value;
    let zone = document.getElementById("property-zone").value;
    let area = document.getElementById("area-from").value;
    let price = document.getElementById("search-minprice").value;


    let encodedUrl = encodeURI('ownership_type='+ownershipType+'&location='+
        location+'&zone='+zone+'&acreage='+area+'&value='+price);
    window.location.href = 'property-listing?'+encodedUrl;
}