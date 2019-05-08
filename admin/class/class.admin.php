<?php
define("admin_title","CARSINET");
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
		$this->db_ = new SQLite3(dirname(__FILE__).'/../../database/data.sqlite');
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
	
	function login($v){
		$error = false;
		if($this->emp($v,array('user','password'))){
			$this->message('Gerekli Alanları Doldurunuz !','error','div');
			$error = true;			
		}else if($error==false){
			$user = $this->in('admins','*',"WHERE user='".$v["user"]."' and password='".$v["password"]."'");
			if($this->inRows!=1){
				$this->message('Böyle bir kullanıcı bulunamadı veya şifre hatalı','error','div');
			}elseif($this->inRows==1){
				$_SESSION['admin_id'] = $user->id;
				$_SESSION['admin_user'] = $user->user;
				$_SESSION['admin_password'] = $user->password;
				$this->message('...Giriş Başarılı, Yönlendiriliyorsunuz...','succes','div');
				$this->location('index.php',3,1);
			}
		}
	}
	
	function madd($table,$data,$empty=array(),$succes='',$error=''){
		$error = false;
		if($this->emp($data,$empty)){
			$this->message('Lütfen Gerekli Alanları Doldurunuz','error','div');
			$error = true;
		}else{
			if($error==false and $this->sqlAdd($table,$data)){
				if($succes=='') $this->message('Kayıt Başarıyla Eklendi.','succes','div'); else $this->message($succes,'succes','div');
				return true;
				unset($v);
			}else{
				if($error=='') $this->message('Kayıt Eklenemedi','error','div'); else $this->message($error,'error','div'); 
				return false;
				extract($v);
			}
		}
	}

	function medit($table,$cond,$data,$empty=array(),$succes='',$error=''){
		$error = false;
		if($this->emp($data,$empty)){
			$this->message('Lütfen Gerekli Alanları Doldurunuz','error','div');
			$error = true;
		}else{
			$da = $this->ins($table,'*',$cond);
			if($data["image"]!="" and ($da["image"]!=$data["image"])){
				@unlink("../".$da["image"]);
				if($da["thumb"]!="") @unlink("../".$da["thumb"]);
				$data["thumb"] = 0;
			}
			if($error==false and $this->sqlEdit($table,$data,$cond)){
				if($succes=='') $this->message('Kayıt Başarıyla Düzenlendi.','succes','div'); else $this->message($succes,'succes','div');
				return true;
				unset($v);
			}else{
				if($error=='') $this->message('Kayıt Düzenlenemedi.','error','div'); else $this->message($error,'error','div'); 
				return false;
				extract($v);
			}
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
	
	function delete($table,$cond,$unlink=array(),$noMessage=0){
		$un = count($unlink);
		if($un!=0){
			$d = $this->ins($table,'*',$cond);
			for($i=0; $i<$un; $i++){
				if($d[$unlink[$i]]!="") @unlink("../".$d[$unlink[$i]]);
			}
		}
		if($this->query("DELETE FROM $table $cond")){
			if($noMessage==0) $this->message('Kayıt Başarıyla Silindi.','succes','div');	
		}else{
			if($noMessage==0) $this->message('Kayıt Silinemedi.','error','div');	
		}
	}
	
	function seoUrl($s){
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
	
	function trDate($date){
		if($date!='0000-00-00'){
			$ex = explode('-',$date);
			$ay = array (
				"01" => "Ocak",
				"02" => "Şubat",
				"03" => "Mart",
				"04" => "Nisan",
				"05" => "Mayıs", 
				"06" => "Haziran",
				"07" => "Temmuz", 
				"08" => "Ağustos", 
				"09" => "Eylül", 
				"10" => "Ekim", 
				"11" => "Kasım", 
				"12" => "Aralık"
			);
			$newDate = $ex[2]." ".$ay[$ex[1]]." ".$ex[0];
			return $newDate;
		}
	}
	
	function loginControl($session = array()){
		if(($_SESSION["admin_user"]=="" or $_SESSION["admin_password"]=="") and ($this->loginPage!=true)){
			session_destroy();
			$this->location('login.php',0);
			die;
		}
		$total = $this->in('admins','*',"WHERE user='".$_SESSION["admin_user"]."' AND password='".$_SESSION["admin_password"]."'");
		$total = $this->inRows;
		if($total!=1 and $this->loginPage!=true){
			session_destroy();
			$this->location('login.php',0);
			die;
		}
	}
	
	function module($module){
		$mth = new mth; $pager = new kgPager;
		$this->module = ($module!="") ? "modules/".$module.".php" : "modules/main.php";
		if(! file_exists($this->module)) $this->message('messages red','div','Ulaşmaya çalıştığınız modül bulunamadı veya yapım aşamasında !');
		else include($this->module);
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
				if(move_uploaded_file($ftmp,'../'.$ffileName)){
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
		require_once '../libraries/thumb/ThumbLib.inc.php';
		$sql = $this->query("SELECT * FROM ".$table." $cond");
		while($result = $this->assoc($sql)){
			if(($result[$ex]!="" and file_exists("../".$result[$ex])) and $result["thumb"]==0){
				$thumb = PhpThumbFactory::create("../".$result[$ex]);
				$newName = str_replace($uploadFolder,$thumbFolder,$result[$ex]);
				if($thumb->adaptiveResize($w,$h)->save("../".$newName)){
					$update = $this->db_->exec("UPDATE ".$table." SET $im='".$newName."' WHERE id='".$result["id"]."' ");		
				}
			}
		}
	}
	
	function thumb_resize($w,$h,$table,$cond,$ex,$im,$uploadFolder,$thumbFolder){
		require_once '../libraries/thumb/ThumbLib.inc.php';
		$sql = $this->query("SELECT * FROM ".$table." $cond");
		while($result = $this->assoc($sql)){
			if(($result[$ex]!="" and file_exists("../".$result[$ex])) and $result["thumb"]==0){
				$thumb = PhpThumbFactory::create("../".$result[$ex]);
				$newName = str_replace($uploadFolder,$thumbFolder,$result[$ex]);
				if($thumb->resize($w,$h)->save("../".$newName)){
					$update = $this->db_->exec("UPDATE ".$table." SET $im='".$newName."' WHERE id='".$result["id"]."' ");		
				}
			}
		}
	}	

	function editor(){
		include('../libraries/editor/editor.php');	
	}
		
	function selectbox($table,$cond,$selected,$select,$bilesen,$topCond='',$active=""){
		echo '<select name="'.$select.'">';
		if($active!=""){
			if($selected=="") $s = 'selected="selected"';
			echo '<option value="" '.$s.'>'.$active.'</option>';
		}
		if($topCond==""){
			$ls = $this->query("SELECT * FROM $table $cond");
			while($l = $this->assoc($ls)){
				$s = "";
				if($selected==$l["id"]) $s = 'selected="selected"';
				echo '<option value="'.$l["id"].'" '.$s.'>'.$l[$bilesen].'</option>';
			}
		}else{
			$topSQL = $this->query("SELECT * FROM $table $topCond");
			while($topCAT = $this->assoc($topSQL)){
				echo '<optgroup label="'.$topCAT["title"].'">';
				$mSQL = $this->query("SELECT * FROM $table WHERE top='".$topCAT["id"]."'");
				while($mCAT = $this->assoc($mSQL)){
					if($mCAT["id"]==$selected) $ss = 'selected="selected"'; else $ss = '';
					echo '<option value="'.$mCAT["id"].'" '.$ss.'>'.$mCAT[$bilesen].'</option>';
				}
				echo '</optgroup>';
			}
		}
		echo '</select>';
	}
	
	function id2t($table,$data,$sutun){
		$ss = $this->ins($table,'*',"WHERE id='$data'");
		return $ss[$sutun];
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
	
	function location($url,$second,$parent=0){
		echo '<meta http-equiv="refresh" content="'.$second.';url='.$url.'">';
 		header("Refresh:".$second."; url=".$url);
		if($parent==1){
		echo '	<SCRIPT LANGUAGE="JAVASCRIPT" TYPE="TEXT/JAVASCRIPT">
				document.location.href="'.$url.'";
				</SCRIPT> 
			';
		}
	}	
	
	function message($message,$code,$type){
		if($type=='div'){
			echo '<div class="albox '.$code.'box">'.$message.'</div>';
		}
	}
		
	function online(){
		if($_SESSION["username"]=='' or $_SESSION["email"]=='' or $_SESSION["password"]=='') return false;
		else return true;
	}
	
	function button($text,$link,$type=""){
		if($type!="") echo '<a href="'.$link.'" class="button '.$type.'">'.$text.'</a>'; 
	}

	function yesNo($name, $data){
		if($data==1) $v1 = 'checked="checked"'; else $v2 = 'checked="checked"';
		echo '<input id="'.$name.'1" type="radio" name="'.$name.'" value="1" '.$v1.' /> <label for="'.$name.'1">Evet</label> &nbsp; &nbsp;';
		echo '<input id="'.$name.'0" type="radio" name="'.$name.'" value="0" '.$v2.' /> <label for="'.$name.'0">Hayır</label>';	
	}
	
	function reload(){
		echo '<script type="text/javascript">location.reload();</script>';	
	}

}
?>