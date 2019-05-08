$.users = {
	
	login: function(){
		var username = $('#login #username').val();
		var password = $('#login #password').val();
		if($.trim(username)==''){
			alert('Kullanıcı Adı alanını doldurmalısınız !');
		}else if($.trim(password)==''){
			alert('Parola alanını doldurmalısınız !');	
		}else{
			$.ajax({
				type: 'POST',
				data: 'username='+username+'&password='+password,
				url: 'process.php?dispatch=users.login',
				success: function(ret){
					$('#users.login_result').html(ret);	
				}
			});
		}
	},
	
	logout: function(){
		$.get('process.php?dispatch=users.logout','',function(res){
				$('#users.process').html(res);
			}
		);
	},
	
	register: function(){
		var username = $('#register #username').val();
		var password = $('#register #password').val();
		var password_2 = $('#register #password_2').val();
		var name = $('#register #name').val();
		if($.trim(name)==''){
			alert('Adı Soyadı alanını doldurmalısınız !');
		}else if($.trim(username)==''){
			alert('Kullanıcı Adı alanını doldurmalısınız !');	
		}else if(password==''){
			alert('Parola alanını doldurmalısınız !');
		}else if(password_2==''){
			alert('Parola Tekrarı alanını doldurmalısınız !');	
		}else if(password!=password_2){
			alert('Parola ve Parola tekrarı uyuşmuyor !');	
		}else{
			$.ajax({
				type: 'POST',
				data: 'username='+username+'&password='+password+'&password_2='+password_2+'&name='+name,
				url: 'process.php?dispatch=users.register',
				success: function(ret){
					$('#users.register_result').html(ret);	
				}
			});						
		}
	}
	
}