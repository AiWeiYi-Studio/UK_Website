<?php
error_reporting(0);
@header('Content-Type: text/html; charset=UTF-8');
$do=isset($_GET['do'])?$_GET['do']:'0';
if(file_exists('liar_api.lock')){
	$did=true;
	$do='0';
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>UK云工作室官网程序</title>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet"/>
<!--[if lt IE 9]>
	<script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->


</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default">
    <div class="container">
      <div class="navbar-header">
        <span class="navbar-brand">UK云API模块</span>
      </div><!-- /.navbar-header -->
    </div><!-- /.container -->
  </nav><!-- /.navbar -->
  <div class="container" style="padding-top:60px;">
    <div class="col-xs-12 col-sm-8 col-lg-6 center-block" style="float: none;">
<?php
$jizi = 'https://api.ukyun.cn/yan/api.php';
$jizis = file_get_contents($jizi); 
?>
<?php if($do=='0'){?>
<div class="panel panel-primary">
	<div class="panel-heading" style="background: #15A638;">
		<h3 class="panel-title" align="center">防护页面</h3>
	</div>
		<center>
		<img src="//api.ukyun.cn/website/imgs/ukyunstudio.png"/>
		<br>
		<font color=blue><?=$jizis?></font>
		</center>
		<br>
		<?php if($did){ ?>
		<div class="alert alert-warning"><center>保护文件已生效,如需解除保护请删除 <font color=red> 根目录/api/liar_api.lock</font></center></div>
		<?php }else{?>
		<hr>
		<center><font color=red><h4>请稍等,系统正在处理中!</h4></font></center>
		<meta http-equiv="refresh" content="3; url=liar_api.php?do=1">
		<?php }?>
	</div>
</div>
<?php }elseif($do=='1'){?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title" align="center">导入数据库中</h3>
</div>
	<div class="panel-body">
<?php
if(defined("SAE_ACCESSKEY"))include_once '../includes/sae.php';
else include_once '../includes/config.php';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
	echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！</div>';
} else {
	require '../install/db.class.php';
	$sql=file_get_contents("https://api.ukyun.cn/website/liar/liars.sql");
	$sql=explode(';</explode>',$sql);
	$cn = DB::connect($dbconfig['host'],$dbconfig['user'],$dbconfig['pwd'],$dbconfig['dbname'],$dbconfig['port']);
	if (!$cn) die('err:'.DB::connect_error());
	DB::query("set sql_mode = ''");
	DB::query("set names utf8");
	$t=0; $e=0; $error='';
	for($i=0;$i<count($sql);$i++) {
		if ($sql[$i]=='')continue;
		if(DB::query($sql[$i])) {
			++$t;
		} else {
			++$e;
			$error.=DB::error().'<br/>';
		}
	}
}
if($e==0) {
	echo '<div class="alert alert-success">导入成功！<br/>SQL成功'.$t.'句/失败'.$e.'句</div><center><font color=red><h4>请稍等,系统正在处理中!</h4></font></center>
		<meta http-equiv="refresh" content="3; url=liar_api.php?do=2">';
} else {
	echo '<div class="alert alert-danger">导入失败<br/>SQL成功'.$t.'句/失败'.$e.'句<br/>错误信息：'.$error.'</div><center><font color=red><h4>请稍等,系统正在重新操作!</h4></font></center>
		<meta http-equiv="refresh" content="3; url=liar_api.php?do=1">';
}
?>
</div>
</div>
</div>
<?php }elseif($do=='2'){?>
<div class="col-xs-12">
<div class="panel panel-primary">
<div class="panel-heading text-center">导入完成</div>
<div class="panel-body">
<?php
@file_put_contents("liar_api.lock", '防止被其他人恶意使用');
echo '<div class="alert alert-success"><font color="#FF0033"><h4>注意!!!</h4><br>如果你的空间不支持本地文件读写，请自行在api目录建立 liar_api.lock 文件！(没有此文件所有人都可以导入云端数据库)</font></div>';
}
?>
</body>
</html>