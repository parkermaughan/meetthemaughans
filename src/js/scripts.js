(function( root, $, undefined ) {
	"use strict";

$(document).ready(function(){
    $('.hvr-float-shadow').hover(function(){
        $('.magnify').fadeIn(500)
    },function(){
        $('.magnify').fadeOut(500)
    })
});

} ( this, jQuery ));