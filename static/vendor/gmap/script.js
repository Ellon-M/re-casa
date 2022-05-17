var PGL;
(function(e) {
    "use strict";
	e(document).on('click.closePopup', '.close-info', function(e){
        var $target = $(e.target),
            $popup = $target.closest('.infobox');

        $popup.length && $popup.parent().empty();
    });
    e(document).ready(function() {
        PGL = {
            initialized: false,
            agency_mapInitialLatitude: agency_mapInitialLatitude,
            agency_mapInitialLongitude: agency_mapInitialLongitude,
            properties_cluster_marker: properties_cluster_marker,
            properties_cluster_textcolor: properties_cluster_textcolor,
            properties_initialZoom: properties_initialZoom,
            properties_selectedZoom: properties_selectedZoom,
            properties_mapInitialLatitude: properties_mapInitialLatitude,
            properties_mapInitialLongitude: properties_mapInitialLongitude,
            use_default_map_style: use_default_map_style,
            init: function() {
                var e = this;
                if (e.initialized) {
                    return
                }
                e.initialized = true;
            },
            propertiesMap: function(e, t, n) {
                var r = this,
                    i = {},
                    s = [],
                    o, u, a, f, l, c, h, p, d;
                i.pics = null;
                i.map = null;
                i.markerClusterer = null;
                i.markers = [];
                i.infoWindow = null;
                if (!this.use_default_map_style) {
                    s = [{
                        featureType: "all",
                        elementType: "all",
                        stylers: [{
                            saturation: 0
                        }]
                    }]
                }
                o = new google.maps.StyledMapType(s, {
                    name: "PGL"
                });
                if (n !== undefined || n === null) {
                    u = new google.maps.LatLng(e[n].latitude, e[n].longitude);
                    r.properties_initialZoom = r.properties_selectedZoom
                } else {
                    u = new google.maps.LatLng(r.properties_mapInitialLatitude, r.properties_mapInitialLongitude)
                }
                a = {
                    zoom: r.properties_initialZoom,
                    center: u,
                    scrollwheel: false
                };
                i.map = new google.maps.Map(document.getElementById(t), a);
                i.map.mapTypes.set("map_style", o);
                i.map.setMapTypeId("map_style");
                i.pics = e;
                i.infoWindow = new InfoBox();
                f = function(e, t) {
                    return function(n) {
                        n.cancelBubble = true;
                        n.returnValue = false;
                        if (n.stopPropagation) {
                            n.stopPropagation();
                            n.preventDefault()
                        }
                        var s = '<div class="infobox pgl-property-detail pgl-bg-light"><div class="property-detail-thumb-info">' + '<div class="property-detail-thumb-info-image">' + '<a href="javascript:;" class="close-info">x</a>' + '<a href="' + e.link + '"><img class="img-responsive" src="' + e.image + '" alt="' + e.title + '"></a>' + '<span class="property-detail-thumb-info-label"><span class="label price">' + e.price + '</span><span class="label forrent">' + e.forrea + '</span></span>' + '</div>' + '<div class="property-detail-thumb-info-content">' + '<h3>' + e.title + "</h3>" + e.description + '</div>' + '<div class="amenities clearfix">' + '<ul class="pull-left"><li>' + e.area + '</li></ul>' + '<ul class="pull-right"><li>' + e.bedroom + '</li><li>' + e.bathroom + '</li></ul>' + '</div></div></div>';

                        i.infoWindow.setContent(s);
                        i.infoWindow.setPosition(t);
                        i.infoWindow.open(i.map);
						
						
						
                    }
                };
                for (l = 0; l < i.pics.length; l += 1) {
                    c = new google.maps.LatLng(i.pics[l].latitude, i.pics[l].longitude);
                    h = new google.maps.Marker({
                        position: c,
                        map: i.map,
                        icon: i.pics[l].map_marker_icon
                    });
                    p = f(i.pics[l], c);
                    google.maps.event.addListener(h, "click", p);
                    i.markers.push(h);
                }
                d = {
                    styles: [{
                        height: 33,
                        url: r.properties_cluster_marker,
                        width: 26,
                        textColor: r.properties_cluster_textcolor,
                        anchorText: [0, 0],
                        textSize: 14,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }, {
                        height: 33,
                        url: r.properties_cluster_marker,
                        width: 26,
                        textColor: r.properties_cluster_textcolor,
                        anchorText: [0, 0],
                        textSize: 14,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }, {
                        height: 33,
                        url: r.properties_cluster_marker,
                        width: 26,
                        textColor: r.properties_cluster_textcolor,
                        anchorText: [0, 0],
                        textSize: 14,
                        fontWeight: "normal",
                        fontFamily: "Open Sans, Arial, sans-serif"
                    }],
                    maxZoom: 7
                };
                i.markerClusterer = new MarkerClusterer(i.map, i.markers, d)
				
            }
        };
        PGL.init()
    })
})(jQuery);