$.orders = {
	
	add_to_cart: function($product_id){
		$.get('/process.php?dispatch=orders.add_to_cart','product_id='+$product_id,function(res){
				$("#process").html(res);
				$.orders.cart_total_product();
			}
		);
	},
	
	cart_total_product: function(){
		$.get('/process.php?dispatch=orders.cart_total_product','',function(res){
				$('#cart_total_product').html(res);
			}
		);
	},
		
	get_chekout_type: function($type_id){
		$.get('display.php?dispatch=orders.checkout_type','type_id='+$type_id,function(res){
				$('#ct.article').html(res);
			}
		);
	}
}

$(document).ready(function(e) {
	$.orders.cart_total_product();
	
	$('select[name=checkout_type]').change(function(e){
		$.orders.get_chekout_type($(this).val());
	});;
	
	$('form#cart_finish').submit(function(e){
		var name = $('input[name=name]').val();
		var telephone = $('input[name=telephone]').val();
		var email = $('input[name=email]').val();
		var address = $('select[name=address]').val();
		var note = $('textarea[name=note]').val();
		var contract = ('input[name=contract]').val();
		if($.trim(name)==""){
			alert('Ad Soyad alanı doldurulmalıdır.');
			e.preventDefault();	
		}else if($.trim(telephone)==""){
			alert('Telefon alanı doldurulmalıdır.');
			e.preventDefault();	
		}else if($.trim(email)==""){
			alert('Email alanı doldurulmalıdır.');
			e.preventDefault();	
		}else if(! $.mth.emailControl(email)){
			alert('Geçersiz email adresi girdiniz !');
			e.preventDefault();
		}else if($.trim(address)==""){
			alert('Adres alanı doldurulmalıdır.');
			e.preventDefault();	
		}else if($.trim(contract)=="" || $.trim(contract)==0){
			alert('Sözleşme şartlarını kabul etmek zorundasınız.');
			e.preventDefault();	
		}else{
			return true;	
		}
	});
	
});