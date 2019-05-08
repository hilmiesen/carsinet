<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2>İLETİŞİM MESAJLARI</h2>
			<p>Bu modül ile iletişim mesajlarını okuyabilirsiniz.</p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="Bu modül ile iletişim mesajlarını okuyabilirsiniz.">
				<img src="img/icons/shortcut/question.png" width="25" height="25" alt="icon" />
			</a>
		</div>
		
		<div class="clear"></div>
	</div>
</div>

<div class="content">
	
	<div class="simplebox grid740">
		<div style="height: 32px;">
			<div class="buttons float-left">
				<a class="icon-button submit" id="list" href="#">
					<img width="18" height="18" alt="icon" src="img/icons/button/cut.png" />
					<span>Seçilileri Sil</span>
				</a>
			</div>
			<div class="process float-right">
				<?php
				$unlink = array();
				if($_GET["deleteID"]){
					$mth->delete("messages","WHERE id='".$_GET["deleteID"]."'",$unlink);
				}
				if($_POST["delete"]){
					$delete = $_POST["delete"];
					foreach($delete as $deleted){
						$del = $mth->delete("messages","WHERE id='".$deleted."'",$unlink,1);
					}
					echo '<div class="albox succesbox">Kayıtlar Başarıyla Silindi.</div>';	
				}
				?>			
			</div>
		</div>
		<div class="clear"></div>
		<div class="titleh">
            <h3>Mesaj Listesi</h3>
            <div class="shortcuts-icons">
                
            </div>
		</div>
		<form action="" name="list" id="list" method="post">
        <table class="tablesorter list"> 
            <thead> 
                <tr> 
                    <th width="2%"></th> 
                    <th width="40%">Adı Soyadı / Telefon / Email</th> 
                    <th>Konu</th> 
                    <th align="center">Tarih</th> 
                    <th width="10%">İşlemler</th> 
                </tr> 
            </thead> 
            <tbody> 
			<?php
			$query = $mth->query("SELECT * FROM messages ORDER BY id DESC");
			if($mth->rows($query)==0) echo '<tr><td colspan="5">Henüz İçerik Girilmemiş.</td></tr>';
			while($list = $mth->assoc($query)){
			?>
                <tr id="data<?=$list["id"]?>"> 
                    <td><input id="data<?=$list["id"]?>" type="checkbox" name="delete[]" value="<?=$list["id"]?>" /></td> 
                    <td>
						<div><?=$list["name_surname"]?> / <?=$list["telephone"]?></div>
						<a href="mailto:<?=$list["email"];?>"><?=$list["email"];?></a>
					</td>
					<td><?=$list["subject"]?></td> 
					<td align="center" valign="middle"><?=$mth->trDate($list["date"]);?></td>
                    <td>
						<a rel="prettyPhoto" class="tips" title="Mesajı İncele"  href="../display.php?dispatch=detail.contact&id=<?=$list["id"]?>&width=400&height=250&iframe=true">
							<img src="img/icons/sidemenu/magnify.png" alt="" />
						</a>
					</td> 
                </tr> 
			<?php } ?>
            </tbody> 
        </table>
		</form>
	</div>

</div>