<head>
	<script type="text/javascript" src="libraries/jquery.js"></script>
	<script type="text/javascript" src="libraries/mth.js"></script>
	<script type="text/javascript" src="modules/users/users.js"></script>
	<link rel="stylesheet" href="modules/users/users.css" />
</head>

<div id="register">
	<form action="" method="post">
	<div class="title">
		<span>Şifremi Değiştir</span>
	</div>
	<?php
	if($_POST){
		$l_password = $_POST["last_password"];
		$n_password = $_POST["new_password"];
		$n_password_2 = $_POST["new_password_2"];
		if($l_password=="" || $n_password=="" || $n_password_2==""){
			echo '<div class="error">Lütfen bütün alanları doldurunuz.</div>';	
		}else{
			if($n_password!=$n_password_2){
				echo '<div class="error">Parolalar eşleşmiyor.</div>';	
			}else{
				if($mth->password($l_password)!=$online->password){
					echo '<div class="error">Parolayı yanlış girdiniz.</div>';	
				}else{
					$update = $mth->db_->exec("UPDATE users SET password='".$mth->password($n_password)."' WHERE id='".$online->id."'");
					if($update){
						echo '<div class="success">Şifreniz başarıyla değiştirildi.</div>';
						$_SESSION["userPassword"] = $mth->password($n_password);
					}else{
						echo '<div class="error">Şifreniz değiştirilemedi.</div>';	
					}
				}
			}
		}
	}
	?>
	<div class="form">
		<div class="line">
			<label for="name">Eski Şifreniz</label>
			<input type="password" name="last_password" id="last_password" />
		</div>
		<div class="line">
			<label for="name">Yeni Şifreniz</label>
			<input type="password" name="new_password" id="new_password" />
		</div>
		<div class="line">
			<label for="name">Yeni Şifreniz (Tekrar)</label>
			<input type="password" name="new_password_2" id="new_password_2" />
		</div>
		<div class="line">
			<input type="submit" value="Şifremi Değiştir" />
		</div>
	</div>
	</form>
</div>