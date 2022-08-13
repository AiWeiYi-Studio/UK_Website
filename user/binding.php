<?php 
$mod='blank';
include("../includes/common.php");
if($conf['repair']==0){
	sysmsg("<h3>站点已被管理员停止！<h3>");
}
if($islogins==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']. '/';//获取本地域名
$allapi	 ='http://api.cccyun.cc/';//QQ快捷登录API地址

class Oauth{

function __construct(){
	global $siteurl;
	$this->callback = $siteurl.'user/binding.php';//登录回调地址
}
public function login(){
	global $allapi;
	$state = md5(uniqid(rand(), TRUE));
	$_SESSION['Oauth_state'] = $state;
	$keysArr = array("act" => "login","media_type" => $_GET['type'],"redirect_uri" => $this->callback,"state" => $state);
	$login_url = $allapi.'social/connect.php?'.http_build_query($keysArr);
	header("Location:$login_url");
}

public function callback(){
	global $allapi;
	//--------验证state防止CSRF攻击
	if($_GET['state'] !== $_SESSION['Oauth_state']){
		sysmsg("<h2>The state does not match. You may be a victim of CSRF.</h2>");
	}
	$keysArr = array("act" => "callback","code" => $_GET['code'],"redirect_uri" => $this->callback);
	$token_url = $allapi.'/social/connect.php?'.http_build_query($keysArr);
	$response = get_curl($token_url);

	$arr = json_decode($response,true);

	if(isset($arr['error_code'])){
		sysmsg('<h3>error:</h3>'.$arr['error_code'].'<h3>msg  :</h3>'.$arr['error_msg']);
	}

	$_SESSION['Oauth_access_token']=$arr["access_token"];
	$_SESSION['Oauth_social_uid']=$arr["social_uid"];
	return $arr;
    }
}
$Oauth = new Oauth();
header("Content-Type: text/html; charset=UTF-8");
if ($_GET['code']) {
    $array = $Oauth->callback();
    $social_uid	  	=	 $array['social_uid'];
    $access_token 	=	 $array['access_token'];
    $gender		  	=	 $array['gender'];
	$nickname	 	=	 $array['nickname'];
    $figureurl_qq_1 =	 $array['figureurl_qq_1'];
    $figureurl_qq_2	=	 $array['figureurl_qq_2'];
	$vip	 	 	=	 $array['vip'];
    $level			=	 $array['level'];
	$is_yellow_year_vip= $array['is_yellow_year_vip'];
	$row = $DB->get_row("SELECT * FROM ukyun_daili WHERE access_token='$access_token' limit 1");
		if($row['access_token']==$access_token) {
		$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','绑定QQ,但未绑定成功(QQ已被使用)','".$date."','".$city."','IP:".$clientip."')");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('该QQ已绑定其他用户！');history.go(-1);</script>");
	}
	$DB->query("update `ukyun_daili` set `access_token` ='".$access_token."' where `uid`='".$udata['uid']."'");
	$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','绑定QQ,已成功','".$date."','".$city."','IP:".$clientip."')");
	@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('恭喜你，绑定成功！');window.location.href='./';</script>");
}elseif(isset($_GET['jiebang'])){
		$DB->query("update `ukyun_daili` set `access_token` ='' where `uid`='".$udata['uid']."'");
		$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','解绑QQ,已成功','".$date."','".$city."','IP:".$clientip."')");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('您已成功解绑QQ！');window.location.href='./';</script>");
} else {
    $Oauth->login();
}