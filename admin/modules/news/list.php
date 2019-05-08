<?php
require("settings.php");
$totals = $mth->in(module_table,'*',$cond); $total = $mth->inRows;
$pager->pager_set(module_link.'/list&no=',$total,10,20,$_GET["no"],'class="active"','Önceki','Sonraki','','','');
?>
<div class="page-title">
	<div class="in">
		<div class="titlebar">
			<h2><?=module_title?></h2>
			<p><?=module_description?></p>
		</div>
			
		<div class="shortcuts-icons">
			<a class="shortcut tips" onclick="javascript:location.reload();" title="Sayfayı Yenile">
				<img src="img/icons/shortcut/refresh.png" width="25" height="25" alt="icon" />
			</a>
			<a class="shortcut tips" href="#" title="<?=module_big_description?>">
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
				<a class="icon-button" href="<?=module_link?>/add">
					<img width="18" height="18" alt="icon" src="img/icons/button/create.png" />
					<span>Yeni <?=module_keyword?> Ekle</span>
				</a>
				<a class="icon-button submit" id="list" href="#">
					<img width="18" height="18" alt="icon" src="img/icons/button/cut.png" />
					<span>Seçilileri Sil</span>
				</a>
			</div>
			<div class="process float-right">
				<?php
				$unlink = array('image','thumb');
				if($_GET["deleteID"]){
					$mth->delete(module_table,"WHERE id='".$_GET["deleteID"]."'",$unlink);
				}
				if($_POST["delete"]){
					$delete = $_POST["delete"];
					foreach($delete as $deleted){
						$del = $mth->delete(module_table,"WHERE id='".$deleted."'",$unlink,1);
					}
					echo '<div class="albox succesbox">Kayıtlar Başarıyla Silindi.</div>';	
				}
				?>			
			</div>
		</div>
		<div class="clear"></div>
		<div class="titleh">
            <h3><?=module_keyword?> Listesi</h3>
            <div class="shortcuts-icons">
                
            </div>
		</div>
		<form action="" name="list" id="list" method="post">
        <table class="tablesorter list"> 
            <thead> 
                <tr> 
                    <th width="2%"></th> 
                    <th>Haber Başlığı</th> 
                    <th>Haber Açıklaması</th> 
                    <th>Yayın Tarihi</th>
                    <th>İşlemler</th> 
                </tr> 
            </thead> 
            <tbody> 
			<?php
			$query = $mth->query("SELECT * FROM ".module_table." ORDER BY id DESC LIMIT ".$pager->start.", ".$pager->per_page."");
			if($mth->rows($query)==0) echo '<tr><td colspan="5">Henüz İçerik Girilmemiş.</td></tr>';
			while($list = $mth->assoc($query)){
			?>
                <tr id="data<?=$list["id"]?>"> 
                    <td><input id="data<?=$list["id"]?>" type="checkbox" name="delete[]" value="<?=$list["id"]?>" /></td> 
                    <td><?=$list["title"]?></td> 
                    <td><?=$list["description"]?></td> 
                    <td><?=$mth->trDate($list["date"]);?></td> 
                    <td>
						<a class="tips" title="Kaydı Düzenle" href="<?=module_link?>/edit&id=<?=$list["id"]?>">
							<img src="img/icons/sidemenu/file_edit.png" alt="" />
						</a>
						<a class="tips" title="Kaydı Sil" href="<?=module_link?>/list&deleteID=<?=$list["id"]?>">
							<img src="img/icons/sidemenu/trash.png" alt="" />
						</a>
					</td> 
                </tr> 
			<?php } ?>
            </tbody> 
        </table>
		</form>
	</div>
	
	<ul class="pagination">
		<?php		
		echo $pager->previous_page;
		echo $pager->page_links;
		echo $pager->next_page;
		?>
	</ul>

</div>