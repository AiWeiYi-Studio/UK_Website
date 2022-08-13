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
 * UK云官网程序用户注册
**/
include("../includes/common.php");
$title="用户注册录";
if($conf['repair']==0){
	sysmsg("<h3>站点已被管理员停止！<h3>");
}
if($islogins==1){
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $conf['title']?> -  <?=$title?></title>
  <link rel="icon" href="../assets/img/favicon.ico" type="image/ico">
  <meta name="keywords" content="<?php echo $conf['keywords']; ?>"/>
  <meta name="description" content="<?php echo $conf['description']; ?>"/>
  <link href="//cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="//cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="../assets/appui/css/main.css">
  <link rel="stylesheet" href="../assets/appui/css/themes.css">
  <script src="//cdn.staticfile.org/modernizr/2.8.3/modernizr.min.js"></script>
  <script src="//cdn.staticfile.org/jquery/2.1.4/jquery.min.js"></script>
  <script src="//cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="../assets/appui/js/plugins.js"></script>
  <script src="../assets/appui/js/app2.js"></script>
    <script src="//lib.baomitu.com/layer/2.3/layer.js"></script>
  <!--[if lt IE 9]>
    <script src="//cdn.staticfile.org/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
<img src="<?php echo $conf["bjurl"] ?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
<div id="login-container">
<h1 class="h2 text-light text-center push-top-bottom animation-slideDown">
<i class="fa fa-cloud"></i> <strong><?php echo $conf['title'] ?></strong>
</h1>
<div class="block animation-fadeInQuickInv">
<div class="block-title">
<div class="block-options pull-right">
<a href="./login.php" class="btn btn-effect-ripple btn-primary" data-toggle="tooltip" data-placement="left" title="返回登录"><i class="fa fa-user"></i></a>
</div>
<h2>用户注册</h2>
</div>

<form action="./reg.php" method="POST" role="form" class="form-horizontal">

<div class="form-group">
<div class="col-xs-12">
<input type="text" name="user" class="form-control" maxlength="16" placeholder="输入登录用户名"/>
</div></div>
			
<div class="form-group">
<div class="col-xs-12">
<input type="password" name="pass" class="form-control" maxlength="16" placeholder="输入6~16位登录密码"/>
</div></div>

<div class="form-group">
<div class="col-xs-12">
<input type="text" name="qq" class="form-control" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="10" placeholder="输入您的联系QQ号"/>
</div></div>


<div class="input-group">
<input type="text" class="form-control input-lg" name="code" onkeyup="this.value=this.value.replace(/\D/g,'')" maxlength="4" placeholder="输入验证码" autocomplete="off" required>
<span class="input-group-addon" style="padding: 0">
<img src="../includes/code.php?r=<?php echo time();?>"height="43"onclick="this.src='../includes/code.php?r='+Math.random();" title="点击更换验证码">
</span>
</div><br/>
                    <div class="form-group form-actions">
                        <div class="col-xs-8">
                            <label class="csscheckbox csscheckbox-primary">
                                <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> 确定注册?
                            </label>
                        </div>
                        <div class="col-xs-4 text-right">
                            <button type="submit" class="btn btn-effect-ripple btn-sm btn-success">注册</button>
                        </div>
                    </div>
                </form>
                <hr>
<div class="push text-center">- Or -</div>
<div class="row push">
<div class="col-xs-6">
<a href="./login.php" class="btn btn-effect-ripple btn-sm btn-info btn-block">返回登录</a>
</div>
<div class="col-xs-6">
<a href="./social.php" class="btn btn-effect-ripple btn-sm btn-primary btn-block">ＱＱ登录</a>
</div>
<hr>
      <footer class="col-sm-12 text-center">
        <p class="m-b-0">Copyright © 2019 <a href="<?php echo $conf["weburl"] ?>"><?php echo $conf["banquan"] ?></a></p>
      </footer>
</form>
    </div>
<?php
if(isset($_POST['user']) && isset($_POST['pass']) && isset($_POST['qq'])){
$user=daddslashes($_POST['user']);
$pass=daddslashes($_POST['pass']);
$qq=daddslashes($_POST['qq']);
$code=daddslashes($_POST['code']);
if($user==NULL or $pass==NULL or  $qq==NULL){
exit ("<script language='javascript'>alert('注册失败，请不要留空！');window.location.href='./reg.php';</script>");
}elseif(!$code || strtolower($_SESSION['ukyun_code'])!=strtolower($code)){
exit ("<script language='javascript'>alert('注册失败，验证码错误！');window.location.href='./reg.php';</script>");
}
$rows=$DB->get_row("select * from ukyun_daili where user='$user' limit 1");
$row=$DB->get_row("select * from ukyun_daili where qq='$qq' limit 1");
$sql="insert into `ukyun_daili` (`user`, `pass`, `qq`, `active`, `boss`) values ('".$user."','".$pass."','".$qq."','1','1')";
}
?>
<?php
if($rows){
exit ("<script language='javascript'>alert('注册失败，用户名已存在！');window.location.href='./reg.php';</script>");
}elseif($row){
exit ("<script language='javascript'>alert('注册失败，绑定QQ已被使用！');window.location.href='./reg.php';</script>");
}elseif($DB->query($sql)){
exit("<script language='javascript'>alert('注册成功，返回登录！');window.location.href='./login.php';</script>");
}
?>