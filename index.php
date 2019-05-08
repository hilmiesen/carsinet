<?php
session_start();
include("class/class.site.php"); $mth = new mth;
include("libraries/pager/class.php"); $pager = new pager;
include("modules/users/users.php"); $users = new users;
$site = $mth->in('site','*',"WHERE active='1'");
$online = $mth->in('users','*',"WHERE id='".$_SESSION["userID"]."'");
// $page = sqlite_escape_string($_GET["s"]);

$page = $_GET["s"];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<base href="<?=$site->link?>" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php
	$site_title = $site->title;
	if($page=="product"){
		$data = $mth->ins("products","title","WHERE id='".$_GET["id"]."'");
		$title = $data["title"]." - ".$site_title;
	}elseif($page=="about"){
		$data = $mth->ins("about","title","WHERE id='".$_GET["id"]."'");
		$title = $data["title"]." - ".$site_title;
	}elseif($page=="pages"){
		$data = $mth->ins("pages","title","WHERE id='".$_GET["id"]."'");
		$title = $data["title"]." - ".$site_title;	
	}else{
		$title = $site_title;
	}
	?>
	<title><?=$title?></title>
	<meta name="description" content="<?=$site->description?>" />
	<meta name="keywords" content="<?=$site->keywords?>" />
	
	<link href="/style/css/base.css" rel="stylesheet" type="text/css" />
	<link href="/style/css/slider.css" rel="stylesheet" type="text/css" />
	<link href="/style/css/style.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="/libraries/jquery.js"></script>
	
	<script type="text/javascript" src="/libraries/pholder.js"></script>
	<script type="text/javascript" src="/libraries/mth.js"></script>
	
	<script type="text/javascript" src="/libraries/prettyPhoto/prettyPhoto.js"></script>
	<link rel="stylesheet" href="/libraries/prettyPhoto/prettyPhoto.css" />
	
	<script type="text/javascript" src="/modules/orders/orders.js"></script>
	<link rel="stylesheet" href="/modules/orders/orders.css" />
	
	<script type="text/javascript" src="/libraries/pnotify/jquery.pnotify.min.js"></script>
	<link rel="stylesheet" href="/libraries/pnotify/jquery.pnotify.default.css" />
	
	<script type="text/javascript" src="/libraries/unislider.js"></script>

	<script type="text/javascript" src="/libraries/slideshow.js"></script>
	
	<script type="text/javascript" src="/libraries/mask.js"></script>
	
	<script type="text/javascript" src="/style/js/main.js"></script>
	<?=$site->analytics;?>
</head>

<body>
	<div id="process"></div>
	<div id="wrapper">
		<div id="site">
			<div id="header">
				<a href="/" class="logo">
					<img src="/<?=$site->site_logo;?>" alt="" />
				</a>
				<div class="users links">
					<?php if(! $users->online($_SESSION)){ ?>
					<a title="Üye Girişi" href="/login.php">Üye Girişi</a> | 
					<a rel="prettyPhoto" title="Üye Ol" href="/display.php?dispatch=users.register&width=200&height=300&iframe=true">Üye Ol</a>
					<?php } ?>
				</div>
				<div class="users welcome">
					<?php if($users->online($_SESSION)){ ?>
					<div class="float-left">Hoşgeldin; <span><?=$online->name?></span></div>
					<a href="/?s=display&dispatch=orders.orders">Siparişlerim</a>
					<a rel="prettyPhoto" title="Adreslerim" href="/display.php?dispatch=users.addresses&width=600&height=360&iframe=true">Adreslerim</a>
					<a rel="prettyPhoto" title="Bilgilerimi Düzenle" href="/display.php?dispatch=users.edit_info&width=200&height=280&iframe=true">Bilgilerimi Düzenle</a>
					<a rel="prettyPhoto" title="Şifremi Değiştir" href="/display.php?dispatch=users.edit_password&width=200&height=280&iframe=true">Şifremi Değiştir</a>
					<a href="/?s=process&dispatch=users.logout">Çıkış Yap</a>
					<?php } ?>
					<div class="clear"></div>
				</div>
				<div class="search">
					<form action="/?s=search" method="post">
						<input type="text" name="search" placeholder="Arama yapın" />
						<input type="submit" value="" />
					</form>
				</div>
				<a class="card" style="display: block;" href="/?s=display&dispatch=orders.cart">
					Sepetinizde <strong id="cart_total_product">0</strong> adet ürün bulunmaktadır.
				</a>
			</div>
			<div id="menu">
				<ul>
					<?php
					$result = $mth->query("SELECT * FROM menu ORDER BY row ASC");
					while($row = $mth->assoc($result)) {
					?>
					<li><a href="/<?=$row["link"]?>"><?=$row["title"]?></a></li>
					<?php } ?>
				</ul>
			</div>
			<?php
			if($page=="") $page = "home";
			if(file_exists($page.".php")) include($page.".php");
			?>			
		</div>
	</div>
	<div id="footer">
		<div class="logo">
			<img src="/<?=$site->footer_logo?>" width="200" height="90" alt=""/>
		</div>
		<div class="links">
			<h2>Müşteri Hizmetleri</h2>
			<ul>
				<?php
				$result = $mth->query("SELECT id,title FROM about ORDER BY title");
				while($row = $mth->assoc($result)) {
				?>
				<li><a href="/sayfa/<?=$row["id"]?>/<?=$mth->seoUrl($row["title"])?>.html"><?=$row["title"]?></a></li>
				<?php } ?>
			</ul>
		</div>
		<div class="feed">
			<h2>Yeniliklerden Haberdar Olun</h2>
			<span>İndirimlerden ilk sizin haberiniz olsun.</span>
			<form action="" method="post">
				<input type="text" placeholder="Email Adresinizi Girin" />
				<input type="submit" value="Kaydol" />
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>