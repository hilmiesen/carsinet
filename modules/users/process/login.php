<?php
$username = $_POST["username"];
$fPassword = $_POST["password"];
$password = $mth->password($_POST["password"]);
if($username==''){
	$mth->alert('Kullanıcı Adı alanı boş bırakılamaz !');	
}elseif($fPassword==''){
	$mth->alert('Parola alanı boş bırakılamaz !');
}else{
	$query = $mth->query("SELECT id,username,password FROM users WHERE username='".$username."' AND password='".$password."'");
	$rows = $mth->rows($query);
	if($rows==1){
		$user = $mth->assoc($query);
		$_SESSION["userID"] = $user["id"];
		$_SESSION["userUsername"] = $user["username"];
		$_SESSION["userPassword"] = $user["password"];
		$mth->parentLocation('index.php');
	}else{
		$mth->alert('Giriş Yapılamadı.');	
	}
}
?>