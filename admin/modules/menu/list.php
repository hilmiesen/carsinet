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
			</div>
			<div class="process float-right">
				<?php
				$unlink = array('image','thumb');
				if($_GET["deleteID"]){
					$mth->delete(module_table,"WHERE id='".$_GET["deleteID"]."'",$unlink);
				}
				if($_POST){
					foreach($_POST as $id=>$row){
						$mth->db_->exec("UPDATE ".module_table." SET row='".$row."' WHERE id='".$id."'");
					}
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
                    <th width="25%">Başlık</th> 
                    <th width="35%">Link</th> 
                    <th width="10%">Sıra</th> 
                    <th width="10%">İşlemler</th> 
                </tr> 
            </thead> 
            <tbody> 
			<?php
			$query = $mth->query("SELECT * FROM ".module_table." ORDER BY row ASC LIMIT ".$pager->start.", ".$pager->per_page."");
			if($mth->rows($query)==0) echo '<tr><td colspan="5">Henüz İçerik Girilmemiş.</td></tr>';
			while($list = $mth->assoc($query)){
			?>
                <tr id="data<?=$list["id"]?>"> 
                    <td><?=$list["title"]?></td> 
                    <td><?=$list["link"]?></td> 
					<td><input type="text" name="<?=$list["id"]?>" value="<?=$list["row"]?>" style="width: 20px; font-size: 11px; text-align: center; height: 10px; padding: 5px;" /></td>
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
				<tr>
					<td colspan="4"><input type="submit" class="submit-button" value="Sıralamayı Güncelle" /></td>
				</tr>
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