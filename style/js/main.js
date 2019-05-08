$(document).ready(function(){
	$('a[rel*=prettyPhoto]').prettyPhoto({theme: 'facebook', show_title: true, social_tools: false, deeplinking: false});	
	$("input[name=telephone]").mask("0(999) 999 99 99");
	$("#slideshow ul").dpUniSlider({fixedHeight: 338, autoSlide: true, autoSlideSpeed: 6000});
	$('#menu ul li:last').css({'border':'none'});
	$('#links ul li a:last').css({'border':'none'});
	/*$('#products .product:eq(1)').css({'margin':'0 12px'});*/
	$('.news').cycle();
	// $("img").error(function(){
		// $(this).attr("src","temp/images/logo.png");
	// });
});