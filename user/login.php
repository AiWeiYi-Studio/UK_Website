<?php
//php防注入和XSS攻击通用过滤. 
$_GET     && SafeFilter($_GET);
$_POST    && SafeFilter($_POST);
$_COOKIE  && SafeFilter($_COOKIE);
  
function SafeFilter (&$arr)
{
   $ra=Array('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/','/script/','/javascript/','/vbscript/','/expression/','/applet/','/meta/','/xml/','/blink/','/link/','/style/','/embed/','/object/','/frame/','/layer/','/title/','/bgsound/','/base/','/onload/','/onunload/','/onchange/','/onsubmit/','/onreset/','/onselect/','/onblur/','/onfocus/','/onabort/','/onkeydown/','/onkeypress/','/onkeyup/','/onclick/','/ondblclick/','/onmousedown/','/onmousemove/','/onmouseout/','/onmouseover/','/onmouseup/','/onunload/');
   if (is_array($arr))
   {
     foreach ($arr as $key => $value)
     {
        if (!is_array($value))
        {
          if (!get_magic_quotes_gpc())             //不对magic_quotes_gpc转义过的字符使用addslashes(),避免双重转义。
          {
             $value  = addslashes($value);           //给单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符）加上反斜线转义
          }
          $value       = preg_replace($ra,'',$value);     //删除非打印字符，粗暴式过滤xss可疑字符串
          $arr[$key]     = htmlentities(strip_tags($value)); //去除 HTML 和 PHP 标记并转换为 HTML 实体
        }
        else
        {
          SafeFilter($arr[$key]);
        }
     }
   }
}
//查询禁止IP
$ip =$_SERVER['REMOTE_ADDR'];
$fileht="../log/htaccess2";
if(!file_exists($fileht))file_put_contents($fileht,"");
$filehtarr=@file($fileht);
if(in_array($ip."\r\n",$filehtarr))die("警告:"."<br>"."您的IP地址被某些原因禁止！");
  
//加入禁止IP
$time=time();
$fileforbid="../log/forbidchk.dat";
if(file_exists($fileforbid))
{ if($time-filemtime($fileforbid)>60)unlink($fileforbid);
else{
$fileforbidarr=@file($fileforbid);
if($ip==substr($fileforbidarr[0],0,strlen($ip)))
{
if($time-substr($fileforbidarr[1],0,strlen($time))>600)unlink($fileforbid);
elseif($fileforbidarr[2]>600){file_put_contents($fileht,$ip."\r\n",FILE_APPEND);unlink($fileforbid);}
else{$fileforbidarr[2]++;file_put_contents($fileforbid,$fileforbidarr);}
}
}
}
//防刷新
$str="";
$file="../log/ipdate.dat";
$allowTime = 30;//防刷新时间
$allowNum=10;//防刷新次数
$uri=$_SERVER['REQUEST_URI'];
$checkip=md5($ip);
$checkuri=md5($uri);
$yesno=true;
$ipdate=@file($file);
foreach($ipdate as $k=>$v)
{ $iptem=substr($v,0,32);
$uritem=substr($v,32,32);
$timetem=substr($v,64,10);
$numtem=substr($v,74);
if($time-$timetem<$allowTime){
if($iptem!=$checkip)$str.=$v;
else{
$yesno=false;
if($uritem!=$checkuri)$str.=$iptem.$checkuri.$time."1\r\n";
elseif($numtem<$allowNum)$str.=$iptem.$uritem.$timetem.($numtem+1)."\r\n";
else
{
if(!file_exists($fileforbid)){$addforbidarr=array($ip."\r\n",time()."\r\n",1);file_put_contents($fileforbid,$addforbidarr);}
file_put_contents("../log/forbided_ip.log",$ip."--".date("Y-m-d H:i:s",time())."--".$uri."\r\n",FILE_APPEND);
$timepass=$timetem+$allowTime-$time;
die("提示:"."<br>"."您的刷新频率过快,系统已启用防护措施,请等待 ".$timepass." 秒后继续使用!");
}
}
}
}
if($yesno) $str.=$checkip.$checkuri.$time."1\r\n";
file_put_contents($file,$str);
?>
<?php
/**
 * UK云官网程序用户登录
**/
include("../includes/common.php");
$title="用户登录";
if(isset($_POST['user']) && isset($_POST['pass'])){
	if(!$_SESSION['pass_error'])$_SESSION['pass_error']=0;
	$user=daddslashes($_POST['user']);
	$pass=daddslashes($_POST['pass']);
	$code=daddslashes($_POST['code']);
	$row = $DB->get_row("SELECT * FROM ukyun_daili WHERE user='$user' limit 1");
	if($user==NULL or $pass==NULL){
        @header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('请不要留空！');history.go(-1);</script>");
	}elseif(!$code || strtolower($_SESSION['ukyun_code'])!=strtolower($code)){
       exit ("<script language='javascript'>alert('登录失败，验证码错误！');history.go(-1)</script>");
	}elseif($_SESSION['pass_error']>5) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif($row['user']=='') {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif ($pass != $row['pass']) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}elseif ($row['active']==0) {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('您的账号已被封禁！');history.go(-1);</script>");
	}elseif($row['user']==$user && $row['pass']==$pass){
				$citylist=explode(',',$row['citylist']);
		$city=get_ip_city($clientip);
		if($row['citylist'] && !in_array($city,$citylist)){
			$DB->query("update ukyun_daili set active='0' where uid='{$row['uid']}'");
			$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','账号异常登陆','".$date."','".$city."','IP:".$clientip."')");
			@header('Content-Type: text/html; charset=UTF-8');
			exit("<script language='javascript'>alert('系统检测到您有异常登录，账号已封禁！');history.go(-1);</script>");
		}
		$session=md5($user.$pass.$password_hash);
		$token=authcode("{$user}\t{$session}", 'ENCODE', SYS_KEY);
		setcookie("ukyun_token2", $token, time() + 604800);
		@header('Content-Type: text/html; charset=UTF-8');
		$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','使用账号密码登陆平台','".$date."','".$city."','IP:".$clientip."')");
		exit("<script language='javascript'>alert('登陆成功！');window.location.href='./';</script>");
	}
}elseif(isset($_GET['logout'])){
	setcookie("ukyun_token2", "", time() - 604800);
	$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','注销账号登录','".$date."','".$city."','IP:".$clientip."')");
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}elseif($islogins==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
if($conf['repair']==0){
	sysmsg("<h3>站点已被管理员停止！<h3>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <title><?php echo $conf['title']?>-后台登录</title>
  <link rel="icon" href="../assets/img/favicon.ico" type="image/ico">
  <meta name="keywords" content="<?php echo $conf['keywords']; ?>"/>
  <meta name="description" content="<?php echo $conf['description']; ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/appui/css/main.css">
  <link rel="stylesheet" href="../assets/appui/css/themes.css">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="//cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../assets/appui/js/plugins.js"></script>
  <script src="../assets/appui/js/app2.js"></script>
  <link rel="stylesheet" href="../assets/appui/css/plugins.css">
</head>
<body>
	<img src="<?php echo $conf["bjurl"] ?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
      <div id="login-container">
            <h1 class="h2 text-light text-center push-top-bottom animation-pullDown">
                <i class="fa fa-cube text-light-op"></i> <strong><?php echo $conf['title']?></strong>
            </h1>
            <div class="block animation-fadeInQuick">
                <div class="block-title">
                    <h2>后台登录</h2>
                </div>
                <form id="form-login" action="login.php" method="post" class="form-horizontal">
                    <div class="form-group">
                        <label for="login-email" class="col-xs-12">账号</label>
                        <div class="col-xs-12">
                            <input type="text" name="user" class="form-control" placeholder="Your username.." required/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="login-password" class="col-xs-12">密码</label>
                        <div class="col-xs-12">
                            <input type="password" name="pass" class="form-control" placeholder="Your password.." required/>
                        </div>
                    </div>
                    <div class="input-group">
<input type="text" class="form-control input-lg" name="code" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="4" placeholder="输入验证码" autocomplete="off" required>
<span class="input-group-addon" style="padding: 0">
<img src="../includes/code.php?r=<?php echo time();?>"height="43"onclick="this.src='../includes/code.php?r='+Math.random();" title="点击更换验证码">
</span>
</div><br/>
                    <div class="form-group form-actions">
                        <div class="col-xs-8">
                            <label class="csscheckbox csscheckbox-primary">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> 记住我?
                            </label>
                        </div>
                        <div class="col-xs-4 text-right">
                            <button type="submit" class="btn btn-effect-ripple btn-sm btn-success">登录</button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="push text-center">- Or -</div>
                <div class="row push">
                    <div class="col-xs-6">
                        <a href="./reg.php" class="btn btn-effect-ripple btn-sm btn-info btn-block">注册</a>
                    </div>
                    <div class="col-xs-6">
                        <a href="./social.php" class="btn btn-effect-ripple btn-sm btn-primary btn-block">QQ</a>
                    </div>
      <hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href="<?php echo $conf["weburl"] ?>"><?php echo $conf["banquan"] ?></a></p>
      </footer>
</form>
    </div>