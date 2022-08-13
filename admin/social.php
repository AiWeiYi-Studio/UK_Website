<?php 
$mod='blank';
include("../includes/common.php");
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST']. '/';//获取本地域名
$allapi	 ='http://api.cccyun.cc/';//QQ快捷登录API地址

class Oauth{

function __construct(){
	global $siteurl;
	$this->callback = $siteurl.'admin/social.php';//登录回调地址
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
    $social_uid	  	=	 $array['social_uid'];//固定值 可作为账号
    $access_token 	=	 $array['access_token'];//固定值 可作为密码
    $gender		  	=	 $array['gender'];//性别
	$nickname	 	=	 $array['nickname'];//QQ名称
    $figureurl_qq_1 =	 $array['figureurl_qq_1'];//大小为40×40像素的QQ头像URL
    $figureurl_qq_2	=	 $array['figureurl_qq_2'];//[大小为100×100像素的QQ头像URL。不是所有的用户都拥有QQ的100×100的头像。]
	$vip	 	 	=	 $array['vip'];//标识用户是否为黄钻用户（0：不是；1：是）
    $level			=	 $array['level'];//黄钻等级
	$is_yellow_year_vip= $array['is_yellow_year_vip'];//标识是否为年费黄钻用户（0：不是； 1：是）

	$row = $DB->get_row("SELECT * FROM ukyun_user WHERE access_token='$access_token' limit 1");
	if($row['access_token']=='') {
		$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('未登录','使用QQ登录平台,未成功(该QQ未绑定)','".$date."','".$city."','IP:".$clientip."')");
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('该QQ未绑定用户！');history.go(-1);</script>");
	}elseif($row['access_token']==$access_token){
		$user=$row['user'];
		$pass=$row['pass'];
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', UKYUN);
		setcookie("ukyun_token", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','使用QQ登录平台','".$date."','".$city."','IP:".$clientip."')");
		exit("<script language='javascript'>alert('恭喜您登录成功了哟！');window.location.href='./';</script>");
	}
} else {
    $Oauth->login();
}