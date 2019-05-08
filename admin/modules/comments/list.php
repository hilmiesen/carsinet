<?php
require("settings.php");
require("functions.php");
$totals = $mth->in(module_table,'*',$cond); $total = $mth->inRows;
$pager->pager_set(module_link.'/list&no=',$total,10,20,$_GET["no"],'class="active"','Önceki','Sonraki','','','');
?>

<script type="text/javascript">
$(document).ready(function(){
	$('#delete').click(function(){
		$('#process').val('delete');
		$('form#list').submit();
	});
	$('#active').click(function(){
		$('#process').val('active');
		$('form#list').submit();
	});
});
</script>

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
				<a id="active" class="icon-button submit" href="#">
					<img width="18" height="18" alt="icon" src="img/icons/button/arrow-up.png" />
					<span>Seçilileri Onayla</span>
				</a>
				<a id="delete" class="icon-button submit" href="#">
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
				if($_GET["commentID"]){
					$update = $mth->db_->exec("UPDATE comments SET statu='".$_GET["statu"]."' WHERE id='".$_GET["commentID"]."'");	
				}
				if($_POST["process"]=='delete'){
					$delete = $_POST["select"];
					foreach($delete as $deleted){
						$del = $mth->delete(module_table,"WHERE id='".$deleted."'",$unlink,1);
					}
					echo '<div class="albox succesbox">Kayıtlar Başarıyla Silindi.</div>';	
				}elseif($_POST["process"]=='active'){
					$active = $_POST["select"];
					foreach($active as $actived){
						$active = $mth->db_->exec("UPDATE comments SET statu='1' WHERE id='".$actived."'");
					}
					echo '<div class="albox succesbox">Kayıtlar Başarıyla Onaylandı.</div>';	
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
                    <th width="20%">Adı Soyadı / Email</th> 
                    <th width="50%">Yorum</th> 
                    <th width="15%" align="center">Durum</th>
                    <th width="15%">İşlemler</th> 
                </tr> 
            </thead> 
            <tbody> 
			<?php
			$query = $mth->query("SELECT * FROM ".module_table." ORDER BY id DESC LIMIT ".$pager->start.", ".$pager->per_page."");
			if($mth->rows($query)==0) echo '<tr><td colspan="5">Henüz İçerik Girilmemiş.</td></tr>';
			while($list = $mth->assoc($query)){
			?>
                <tr id="data<?=$list["id"]?>"> 
                    <td><input id="data<?=$list["id"]?>" type="checkbox" name="select[]" value="<?=$list["id"]?>" /></td> 
                    <td><strong><?=$list["name"]?></strong> <br /> <span style="font-size: 10px; color: #060;"><?=$list["email"]?></span></td> 
                    <td><?=substr(strip_tags($list["comment"]),0,110);?>...</td> 
                    <td align="center"><?=statu($list["statu"]);?></td> 
                    <td>
						<?php if($list["statu"]==1){ ?>
						<a class="tips" title="Onayı Kaldır" href="<?=module_link?>/list&no=<?=$_GET["no"]?>&commentID=<?=$list["id"]?>&statu=0">
							<img src="img/icons/error/cross.png" alt="" />
						</a>						
						<?php }else{ ?>
						<a class="tips" title="Onayla" href="<?=module_link?>/list&no=<?=$_GET["no"]?>&commentID=<?=$list["id"]?>&statu=1">
							<img src="img/icons/error/accept.png" alt="" />
						</a>						
						<?php } ?>
						<a class="tips" title="Yorumu İncele / Düzenle" href="<?=module_link?>/edit&id=<?=$list["id"]?>">
							<img src="img/icons/sidemenu/file_edit.png" alt="" />
						</a>
						<a class="tips" title="Yorumu Sil" href="<?=module_link?>/list&deleteID=<?=$list["id"]?>">
							<img src="img/icons/sidemenu/trash.png" alt="" />
						</a>
					</td> 
                </tr> 
			<?php } ?>
            </tbody> 
        </table>
		<input type="hidden" name="process" id="process" value="" />
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