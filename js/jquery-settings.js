/* Tipsy */
$(function(){ $('.tips').tipsy({gravity: 's',html: true}); });
$(function(){ $('.tips-right').tipsy({gravity: 'w',html: true}); });
$(function(){ $('.tips-left').tipsy({gravity: 'e',html: true}); });
$(function(){ $('.tips-bottom').tipsy({gravity: 'n',html: true}); });

$(function() {
    var zIndexNumber = 1000;
    $('div').each(function() {
        $(this).css('zIndex', zIndexNumber);
        zIndexNumber -= 10;
    });
});

$(function(){
	$(".st-forminput").focus(function(){
		$(this).attr('class','st-forminput-active ');
	});

	$(".st-forminput").blur(function(){
		$(this).attr('class','st-forminput');
	});
});

$(function(){
	$(".login-input-pass").focus(function(){
		$(this).attr('class','login-input-pass-active ');
	});

	$(".login-input-pass").blur(function(){
		$(this).attr('class','login-input-pass');
	});
});

$(function(){
	$(".login-input-user").focus(function(){
		$(this).attr('class','login-input-user-active ');
	});
	
	$(".login-input-user").blur(function(){
		$(this).attr('class','login-input-user');
	});
});

$(function(){
	$(".uniform").uniform();
});

$(document).ready( function(){ 
	$(".cb-enable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});
	
	$('a[rel=prettyPhoto]').prettyPhoto();
	
	$('.list tr').click(function(){
		var dataID = $(this).attr('id');
		var inputCheck = $('input#'+dataID).attr('checked');
		if(inputCheck=='checked'){
			$('input#'+dataID).removeAttr('checked');	
		}else{
			$('input#'+dataID).attr('checked','checked');	
		}
	});
	
	$('.icon-button.submit').click(function(){
		$('form#'+$(this).attr('id')).submit();
	});
	
});


