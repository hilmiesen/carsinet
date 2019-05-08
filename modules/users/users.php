<?php
class users extends mth {
	function online($data){
		if($data["userID"]=="" || $data["userUsername"]=="" || $data["userPassword"]==""){
			return false;	
		}else{
			$query = $this->query("SELECT id,username,password FROM users WHERE username='".$data["userUsername"]."' AND password='".$data["userPassword"]."'");	
			$rows = $this->rows($query);
			if($rows==1) return true; else return false;
		}
	}
}
?>