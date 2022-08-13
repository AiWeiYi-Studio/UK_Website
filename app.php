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
?>
<?php
//查询禁止IP
$ip =$_SERVER['REMOTE_ADDR'];
$fileht="log/htaccess2";
if(!file_exists($fileht))file_put_contents($fileht,"");
$filehtarr=@file($fileht);
if(in_array($ip."\r\n",$filehtarr))die("警告:"."<br>"."您的IP地址被某些原因禁止！");
  
//加入禁止IP
$time=time();
$fileforbid="log/forbidchk.dat";
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
$file="log/ipdate.dat";
if(!file_exists("log")&&!is_dir("log"))mkdir("log",0777);
if(!file_exists($file))file_put_contents($file,"");
$allowTime = 30;//防刷新时间
$allowNum=5;//防刷新次数
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
file_put_contents("log/forbided_ip.log",$ip."--".date("Y-m-d H:i:s",time())."--".$uri."\r\n",FILE_APPEND);
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
include("./includes/common.php");
include("./includes/txprotect.php");
$url=isset($_GET['url'])?$_GET["url"]:pc;
?>
<?php
if($url=="pc"){
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $conf['title']?> - APP下载</title>
  <link rel="icon" href="../assets/favicon.ico" type="image/ico">
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
</head>
<body>
<img src="<?php echo $conf["bjurl"] ?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
<br><br><br>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/style.css">
<div class="block">
<div class="block-title"><h3 class="panel-title">APP下载</h3></div>
<div class="panel-body">
<center><h4><?php echo $conf['appname'] ?></h4>
		<img src="<?php echo $conf['appdemo1'] ?>" style="max-width: 200px;">
			<img src="<?php echo $conf['appdemo2'] ?>" style="max-width: 200px;">
				<img src="<?php echo $conf['appdemo3'] ?>" style="max-width: 200px;">
<br><br><br><br>
<a href="<?php echo $conf['appdown2'] ?>"class="all_button join_in_button wow fadeInUp">苹果下载</a>
<a href="<?php echo $conf['appdown1'] ?>"class="all_button join_in_button wow fadeInUp">安卓下载</a>
</div>
<center><p class="m-b-0">Copyright ©<a href="<?php echo $conf["weburl"] ?>"><?php echo $conf["banquan"] ?></a></p></center>
<script>
var uaTest = /Android|webOS|Windows Phone|iPhone|ucweb|ucbrowser|iPod|BlackBerry/i.test(navigator.userAgent.toLowerCase());var touchTest = 'ontouchend' in document;if(uaTest && touchTest){window.location.href = 'app.php?url=az';}
</script>
<?php
}elseif($url=="az"){
?>
<!DOCTYPE html>
<html class="no-js">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <title><?php echo $conf['title']?> - APP下载</title>
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
</head>
<body>
<img src="<?php echo $conf["bjurl"] ?>" alt="Full Background" class="full-bg full-bg-bottom animation-pulseSlow">
<br><br><br>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<link rel="stylesheet" type="text/css" href="<?php echo $conf['apiurl']?>/index/css/style.css">
<div class="block">
<div class="block-title"><h3 class="panel-title">APP下载</h3></div>
<div class="panel-body">
<center><h4><?php echo $conf['appname'] ?></h4>
		<img src="<?php echo $conf['appdemo1'] ?>" style="max-width: 90px;">
			<img src="<?php echo $conf['appdemo2'] ?>" style="max-width: 90px;">
				<img src="<?php echo $conf['appdemo3'] ?>" style="max-width: 90px;">
<br><br><br><br>
<a href="<?php echo $conf['appdown2'] ?>"class="all_button join_in_button wow fadeInUp">苹果下载</a>
<a href="<?php echo $conf['appdown1'] ?>"class="all_button join_in_button wow fadeInUp">安卓下载</a>
</div>
<center><p class="m-b-0">Copyright ©<a href="<?php echo $conf["weburl"] ?>"><?php echo $conf["banquan"] ?></a></p></center>

<?php }?>