<?php
class baseController{
	public $ws;
	public $fd;
	function __construct($ws,$fd){
		$this->ws = $ws;
		$this->fd = $fd;
		
 	}
 	//参数出错
 	static function param_error(){
 		$this->ws->push($this->fd, json_encode('params error!!!'));
 		exit();
 	}
 	//读取用户信息
 	function load_user($user = ""){
 		if(!$user){
 			$u = $this->ws->user->get($this->fd);
 			$user =  $db->getfirst($db->query("select a.*,b.* from user as a
								left join userinfo as b on a.id = b.uid
								where a.id='".$u['id']."' "));
 		}
 		return  $this->ws->user->set($this->fd, array('id' => $user["id"], 'username' => $user["username"], 'gold' =>$user["gold"], 'diamonds' =>$user["diamonds"], 'glamour' =>$user["glamour"], 'max_win' =>$user["max_win"], 'all_win' =>$user["all_win"], 'all_played' =>$user["all_played"], 'bet_time' =>$user["bet_time"], 'win_time' =>$user["win_time"], 'showdown_time' =>$user["showdown_time"], 'sex' =>$user["sex"],'show_pic'=>$user["show_pic"] ));
 	}
 	
 	//保存用户信息
 	function save_user(){
 		$db = new db();
 		$user = $this->ws->user->get($this->fd);
 		return $db->update("userinfo", "username ='".$user['username']."',gold ='".$user['gold']."',diamonds ='".$user['diamonds']."',glamour ='".$user['glamour']."',max_win ='".$user['max_win']."',all_played ='".$user['all_played']."',bet_time ='".$user['bet_time']."',win_time ='".$user['win_time']."',showdown_time ='".$user['showdown_time']."',sex ='".$user['sex']."',show_pic ='".$user['show_pic']."'", "uid = ".$user['id']); 		
 	}
}



?>
