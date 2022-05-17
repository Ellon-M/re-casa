// ECMAScript 5
"use strict";

let currentPage = 1;

handlePagination(1);

function handlePagination(page){
    currentPage = page;
    let allProperties  = value;

    let topPropertiesDiv = document.getElementById("top-all-properties");
    let bottomPropertiesDiv = document.getElementById("bottom-all-properties");

    let paginationDiv = document.querySelector(".pagination");

    let itemsPerPage = 8;

    let numberOfPages = allProperties.length / itemsPerPage;
    if (numberOfPages - parseInt(numberOfPages) > 0){
        numberOfPages++;
    }

    let start = (page -1) * itemsPerPage;
    topPropertiesDiv.innerHTML = "";
    bottomPropertiesDiv.innerHTML = "";
    paginationDiv.innerHTML = "";

    for (let i = start; i < page * itemsPerPage; i++) {
        if (typeof allProperties[i] === 'undefined'){
            break;
        }
        let property = allProperties[i];
        let propertyDetailUrl = 'property-detail?post='+property.property_id;

        let singleProperty = '<div class="col-xs-6 col-md-3 animation">\n' +
            '\t\t\t\t\t\t\t\t<div class="pgl-property">\n' +
            '\t\t\t\t\t\t\t\t\t<div class="property-thumb-info">\n' +
            '\t\t\t\t\t\t\t\t\t\t<div class="property-thumb-info-image">\n' +
            // '\t\t\t\t\t\t\t\t\t\t\t<img alt="" class="img-responsive" src="static/images/properties/property-1.jpg">\n' +
            //TODO handle image loading
            '\t\t\t\t\t\t\t\t\t\t\t<img class="img-responsive" src="'+images[property.property_id][0]+'" alt="'+property.description+'" >\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<span class="property-thumb-info-label">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t<span class="label price">Ksh '+property.value+'</span>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t<span class="label forrent">'+property.ownership_type+'</span>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t</span>\n' +
            '\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t<div class="property-thumb-info-content">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<h3><a href="'+propertyDetailUrl+'">'+property.title+'</a></h3>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<address> '+property.location+'</address>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<span class="badge badge-primary"> Verified Direct Seller</span>\n' +
            '\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t\t<div class="amenities clearfix">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<ul class="pull-left">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t\t<li><strong>Area:</strong> '+property.acreage+'<sup> acres</sup></li>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t</ul>\n' +
            '\t\t\t\t\t\t\t\t\t\t\t<ul class="pull-right">\n' +
            '\t\t\t\t\t\t\t\t\t\t\t</ul>\n' +
            '\t\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t\t</div>\n' +
            '\t\t\t\t\t\t\t</div>';

        if ((i-start) < 4){
            topPropertiesDiv.insertAdjacentHTML("beforeend", singleProperty);
        } else{
            bottomPropertiesDiv.insertAdjacentHTML("beforeend", singleProperty);
        }
    }

    for (let i = 1; i <= numberOfPages ; i++) {
        let singlePageNumber;
        if (i === currentPage){
            singlePageNumber = '<li class="active"><a href="javascript:handlePagination('+i+')">'+i+' <span class="sr-only">(current)</span></a></li>';
        }else{
            singlePageNumber = '<li><a href="javascript:handlePagination('+i+')">'+i+'</a></li>';
        }

        paginationDiv.insertAdjacentHTML("beforeend", singlePageNumber);
    }

}

