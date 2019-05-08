<head>
	<script type="text/javascript" src="libraries/jquery.js"></script>
	<script type="text/javascript" src="libraries/mth.js"></script>
	<script type="text/javascript" src="modules/users/users.js"></script>
	<link rel="stylesheet" href="modules/users/users.css" />
</head>

<div id="register">
	<form action="javascript:$.users.register();">
	<div class="title">
		<span>ÜYE KAYIT</span>
	</div>
	<div class="form">
		<div class="line">
			<label for="name">Adınız Soyadınız</label>
			<input type="text" name="name" id="name" />
		</div>
		<div class="line">
			<label for="email">Kullanıcı Adınız</label>
			<input type="text" name="username" id="username" />
		</div>
		<div class="line">
			<label for="password">Şifreniz</label>
			<input type="password" name="password" id="password" />
		</div>
		<div class="line">
			<label for="password">Şifreniz (Tekrar)</label>
			<input type="password" name="password_2" id="password_2" />
		</div>
		<div class="line">
			<input type="hidden" name="register_date" value="<?=date("Y-m-d");?>" />
			<input type="submit" value="Kayıt Ol" />
		</div>
	</div>
	</form>
	<div id="users" class="register_result"></div>
</div>