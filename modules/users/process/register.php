<?php
$name = $_POST["name"];
$username = $_POST["username"];
$password = $_POST["password"];
$password_2 = $_POST["password_2"];
$register_date = date("Y-m-d");

if($name=='') $mth->alert('Ad Soyad alanını doldurmalısınız.');
else if($username=='') $mth->alert('Kullanıcı Adı alanını doldurmalısınız.');
else if($password=='') $mth->alert('Şifre alanını doldurmalısnız.');
else if($password_2=='') $mth->alert('Şifre Tekrarı alanını doldurmalısınız.');
else{
	$query = $mth->query("SELECT * FROM users WHERE username='".$username."'");
	$rows = $mth->rows($query);
	if($rows!=0){
		$mth->alert('Bu kullanıcı adı sistemde kayıtlıdır.');	
	}else{
		$insert = $mth->db_->exec("
			INSERT INTO users
			(name,username,password,register_date) VALUES
			('".$name."','".$username."','".$password."','".$register_date."')
		");
		if($insert){
			$mth->alert('Kaydınız başarıyla tamamlandı.');	
			$mth->parentLocation('index.php');
		}else{
			$mth->alert('Kaydınız belirlenemeyen bir sorundan ötürü tamamlanamadı. Lütfen daha sonra tekrar deneyiniz.');	
		}
	}
}
?>