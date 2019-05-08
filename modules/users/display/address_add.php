<?php
$data = $_REQUEST;
?>
<head>
	<script type="text/javascript" src="libraries/jquery.js"></script>
	<script type="text/javascript" src="libraries/mth.js"></script>
	<script type="text/javascript" src="modules/users/users.js"></script>
	<link rel="stylesheet" href="modules/users/users.css" />
</head>
<div id="addresses">
	<form action="" method="post">
	<div class="title">
		<span>YENİ ADRES</span>
	</div>
	<?php
	if($_POST){
		$empty = array('title','name','address');
		$_POST["user_id"] = $online->id;
		if($mth->madd('addresses',$_POST,$empty)) unset($data);
	}
	?>
	<div class="form">
		<div class="line">
			<label for="name">Adres Adı</label>
			<input type="text" name="title" id="title" value="<?=$data["title"];?>" />
		</div>
		<div class="line">
			<label for="email">Adı Soyadı</label>
			<input type="text" name="name" id="name" value="<?=$data["name"];?>" />
		</div>
		<div class="line">
			<label for="email">Adres</label>
			<input type="text" name="address" id="address" value="<?=$data["address"];?>" />
		</div>
		<div class="line">
			<label for="email">Telefon</label>
			<input type="text" name="telephone" id="telephone" value="<?=$data["telephone"];?>" />
		</div>
		<div class="line">
			<label for="email">GSM</label>
			<input type="text" name="gsm" id="gsm" value="<?=$data["gsm"];?>" />
		</div>
		<div class="line">
			<input type="submit" value="Adresi Kaydet" />
		</div>
	</div>
	</form>
	
</div>