<?php
error_reporting(1);
class mth {  
	var $mth = array();
	var $inRows = 0;
	var $loginPage = false;
	var $cpTitle = 'Gelişmiş Yönetim Paneli';
	var $uploadFileName = '';
	var $types = array('.jpg','.jpeg','.gif','.png','.pdf','.doc','.csv');
	var $uploadError = '';
	
	function __construct(){
		session_start(); ob_start();
		$this->db_ = new SQLite3('database/data.sqlite');
	}
	
	function __destruct(){
		ob_end_flush();	
	}
	
	function query($query){
		return $this->db_->query($query);
	}
	
	function rows($query){
		$numRows = 0;
		while($query->fetchArray()) {
			++$numRows;
		}
		return $numRows;
	}
	
	function assoc($query){
		while($row = $query->fetchArray()) {
		return $row;
		}	
	}
	
	function in($table,$columns,$cond,$queryWrite=0){
		$query = "SELECT $columns FROM $table $cond";	
		$sql = $this->db_->query($query);
		$this->inRows = $this->rows($sql);
		return (object)$sql->fetchArray();
	}

	function ins($table,$columns,$cond,$queryWrite=0){
		$query = "SELECT $columns FROM $table $cond";
		if($queryWrite==1) echo $query;
		$sql = $this->db_->query($query);
		$this->inRows = $this->rows($sql);
		if($this->rows($sql)!=0){
			return $this->assoc($sql);	
		}
	}

	function sqlAdd($table, $postData = array()){
		$fieldNames = implode(',', array_keys($postData));
		$fieldValues = '\''.implode('\', \'', array_values($postData)).'\'';	
		$query = "INSERT INTO $table ($fieldNames) VALUES ($fieldValues)";	 
		$insert = $this->db_->exec($query);
		if($insert){
			return true;
		}
		else{
			return false;	
		}
	}

	function sqlEdit($table, $postData = array(), $kosul){	
		$values = '';
		foreach($postData as $key => $value){
			$values = $values.$key . "='" . $value . "',";
		}

		$values = substr_replace($values ,"",-1);
		$query = "UPDATE $table SET $values $kosul"; //echo "<h2>$update</h2>";
		$update = $this->db_->exec($query);
		if($update){
			return true;
		}
		else{
			return false;	
		}		
	}
	
	function madd($table,$data,$empty=array(),$success='',$error=''){
		$error = false;
		if($this->emp($data,$empty)){
			$this->message('Lütfen Gerekli Alanları Doldurunuz','error','div');
			$error = true;
		}else{
			if($error==false and $this->sqlAdd($table,$data)){
				if($success=='') $this->message('Kayıt Başarıyla Eklendi.','success','div'); else $this->message($success,'success','div');
				return true;
				unset($v);
			}else{
				if($error=='') $this->message('Kayıt Eklenemedi','error','div'); else $this->message($error,'error','div'); 
				return false;
				extract($v);
			}
		}
	}

	function medit($table,$cond,$data,$empty=array(),$success='',$error=''){
		$error = false;
		if($this->emp($data,$empty)){
			$this->message('Lütfen Gerekli Alanları Doldurunuz','error','div');
			$error = true;
		}else{
			$da = $this->ins($table,'*',$cond);
			if($data["image"]!="" and ($da["image"]!=$data["image"])){
				@unlink($da["image"]);
				if($da["thumb"]!="") @unlink($da["thumb"]);
				$data["thumb"] = 0;
			}
			if($error==false and $this->sqlEdit($table,$data,$cond)){
				if($success=='') $this->message('Kayıt Başarıyla Düzenlendi.','success','div'); else $this->message($success,'success','div');
				return true;
				unset($v);
			}else{
				if($error=='') $this->message('Kayıt Düzenlenemedi.','error','div'); else $this->message($error,'error','div'); 
				return false;
				extract($v);
			}
		}
	}
	
	function getGallery($gal,$type,$w='',$h='',$ac='',$ic=''){
		$sql = $this->query("SELECT * FROM gallery WHERE gallery='".$gal."'");
		while($gal = $this->assoc($sql)){
			if($type=='img'){
				echo '<img class="'.$ic.'" src="'.$gal["image"].'" width="'.$w.'" height="'.$h.'" />';
			}else if($type=='a_img'){
				echo '<a rel="prettyPhoto[gal]" href="'.$gal["image"].'" class="'.$ac.'">';
				echo '<img class="'.$ic.'" src="'.$gal["thumb"].'" width="'.$w.'" height="'.$h.'" />';
				echo '</a>';
			}
		}
	}

	function upload($input,$folder,$name){
		$fname = $_FILES[$input]["name"]; $ftmp = $_FILES[$input]["tmp_name"];
		if($fname!=""){
			$type = strrchr($fname,'.'); $type = strtolower($type);
			if(!in_array($type,$this->types)){
				$this->uploadError = 'Kabul Edilmeyen Dosya Formatı !';
				return false;
			}else{
				$fileName = $name.$type; $ffileName = $folder.$fileName;
				if(move_uploaded_file($ftmp,$ffileName)){
					$this->uploadFileName = $ffileName; 
					return true;
				}else{
					$this->uploadError = 'Başarısız Upload !';
					return false;
				}
			}
		}
	}
	
	function thumb($w,$h,$table,$cond,$ex,$im,$uploadFolder,$thumbFolder){
		require_once 'libraries/thumb/ThumbLib.inc.php';
		$sql = $this->query("SELECT * FROM ".$table." $cond");
		while($result = $this->assoc($sql)){
			if(($result[$ex]!="" and file_exists($result[$ex])) and $result["thumb"]==0){
				$thumb = PhpThumbFactory::create($result[$ex]);
				$newName = str_replace($uploadFolder,$thumbFolder,$result[$ex]);
				if($thumb->adaptiveResize($w,$h)->save($newName)){
					$update =$this->db_->exec("UPDATE ".$table." SET $im='".$newName."' WHERE id='".$result["id"]."' ");		
				}
			}
		}
	}
	
	function permalink(){
	 return "http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] ."?".$_SERVER['QUERY_STRING'];	
	}

	function editor(){
		include('libraries/editor/editor.php');	
	}
	
	function emp($data,$is){
		$s = count($is);
		$error = false;
		for($i=0; $i<$s; $i++){
			if($error==false){
				if($data[$is[$i]]==NULL) $error=true;
			}elseif($error==true) break;
		}
		return $error;
	}
	
	function emailControl($email){
		return preg_match('#^[a-z0-9.!\#$%&\'*+-/=?^_`{|}~]+@([0-9.]+|([^\s\'"<>]+\.+[a-z]{2,6}))$#si', $email); 
	}
	
	function id2t($table,$data,$sutun){
		$ss = $this->ins($table,'*',"WHERE id='$data'");
		return $ss[$sutun];
	}

	function delete($table,$cond,$unlink=array()){
		$un = count($unlink);
		if($un!=0){
			$d = $this->ins($table,'*',$cond);
			for($i=0; $i<$un; $i++){
				if($d[$unlink[$i]]!="") @unlink($d[$unlink[$i]]);
			}
		}
		if($this->query("DELETE FROM $table $cond")){
			$this->message('Kayıt Başarıyla Silindi.','success','div');	
		}else{
			$this->message('Kayıt Silinemedi.','error','div');	
		}
	}
	
	function message($message,$code,$type){
		if($code=='error' and $type=='div'){
			echo '<div class="'.$code.'">'.$message.'</div>';
		}elseif($code=='success' and $type=='div'){
			echo '<div class="'.$code.'">'.$message.'</div>';
		}elseif($code=='information' and $type=='div'){
			echo '<div class="'.$code.'">'.$message.'</div>';
		}elseif($code=='warning' and $type=='div'){
			echo '<div class="'.$code.'">'.$message.'</div>';
		}
	}
			
	function button($text,$link,$type=""){
		if($type!="") echo '<a href="'.$link.'" class="button '.$type.'">'.$text.'</a>'; 
	}

	function seoUrl($s) {
		$tr = array('ş','Ş','ı','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç');
		$eng = array('s','s','i','i','g','g','u','u','o','o','c','c');
		$s = str_replace($tr,$eng,$s);
		$s = strtolower($s);
		$s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
		$s = preg_replace('/[^%a-z0-9 _-]/', '', $s);
		$s = preg_replace('/\s+/', '-', $s);
		$s = preg_replace('|-+|', '-', $s);
		$s = trim($s, '-');
		return $s;
	}
	
	function categorySeoLink($id){
		$info = $this->ins('categories','*',"WHERE id='".$id."'");
		if($info){
			$link = 'kategori/'.$info["id"].'-'.$this->seoUrl($info["title"]).'/1/';
		}
		return $link;
	}

	function newSeoLink($id){
		$info = $this->ins('news','*',"WHERE id='".$id."'");
		if($info){
			$link = 'haber/'.$info["id"].'-'.$this->seoUrl($info["title"]).'/';
		}
		return $link;
	}
	
	function productSeoLink($id){
		$info = $this->ins('products','*',"WHERE id='".$id."'");
		if($info){
			$link = 'urun/'.$info["id"].'-'.$this->seoUrl($info["title"]).'/';
		}
		return $link;
	}

	function contact($data){
		$empty = array('name_surname','email','message');
		$this->madd('messages',$data,$empty,'Mesajıınz iletişim departmanına iletildi.','Mesajınız kaydedilemedi.');
	}

	function detLink($table,$id){
		return '?s=detail&t='.$table.'&id='.$id;	
	}

	function listLink($table){
		return '?s=list&t='.$table;	
	}

	function cl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		$browser = $_SERVER['HTTP_USER_AGENT'];
		curl_setopt($ch, CURLOPT_USERAGENT,"googlebot");
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com/");
		$source = curl_exec($ch);
		curl_close($ch);
		return $source;
	}
	function ep($baslangic,$bitis,$veri){
		$veri = explode($baslangic,$veri);
		$veri = $veri[1];
		$veri = explode($bitis,$veri);
		$veri = $veri[0];
		return $veri;
	}
	
	function password($password){
		return md5(sha1($password));	
	}
	
	function alert($message){
		echo '<script type="text/javascript">alert("'.$message.'");</script>';	
	}
	
	function reload(){
		echo '<script type="text/javascript">location.reload();</script>';	
	}

	function location($url){
		echo '<script type="text/javascript">window.location="'.$url.'";</script>';	
	}
	
	function parentLocation($url){
		echo '<script type="text/javascript">window.parent.location="'.$url.'";</script>';	
	}

	function connectFile($feed){
        $ch = curl_init();
        $timeout = 0;
        curl_setopt ($ch, CURLOPT_URL, $feed);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 1);
		curl_setopt ($ch, CURLOPT_REFERER, 'http://www.google.com/');
        $veri= curl_exec($ch);
        curl_close($ch);
        return $veri;
	}
	
	function notify($type,$title,$message){
		echo '
			<script type="text/javascript">
			$(document).ready(function(){
				$.pnotify({
				title: "'.$title.'",
				text: "'.$message.'",
				type: "'.$type.'",
				hide: true
				});
			});
			</script>
		';	
	}
	
	function loginControl($session = array()){
		if($_SESSION["userID"]=="" or $_SESSION["userPassword"])
		{
			session_destroy();
			$this->location('/display.php?dispatch=users.login&width=200&height=200&iframe=true',0);
			die;
		}
	}
	
}
?>