<?php
error_reporting(0);
@header('Content-Type: text/html; charset=UTF-8');
$do=isset($_GET['do'])?$_GET['do']:'0';
if(file_exists('sql_v1.0.3.lock')){
	$updated=true;
	$do='0';
}
if(!file_exists("../install/sql_v1.0.2.lock")) {
exit("<script language='javascript'>alert('sql_v1.0.2 数据库需更新,请立即前往更新！');window.location.href='/install/sql_update_v1.0.1.php';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0,user-scalable=no,minimal-ui">
<title>UK云工作室官网程序-数据库更新模块</title>
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
        <span class="navbar-brand">数据库 V1.0.3 更新模块</span>
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
		<h3 class="panel-title" align="center">UK云工作室</h3>
	</div>
		<center>
		<img src="//api.ukyun.cn/website/imgs/ukyunstudio.png"/>
		<br>
		<font color=blue><?=$jizis?></font>
		</center>
		<br>
		<?php if($updated){ ?>
		<div class="alert alert-warning">当前版本数据库您已经更新过,如需重新更新请删除<font color=red>sql_v1.0.3.lock 文件</font></div>
		<?php }else{?>
		<p align="center"><a class="btn btn-primary" href="?do=1">开始安装</a></p>
		<?php }?>
	</div>
</div>

</div>
<?php }elseif($do=='1'){?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title" align="center">创建数据表</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
	<span class="sr-only">70%</span>
  </div>
</div>
	<div class="panel-body">
<?php
if(defined("SAE_ACCESSKEY"))include_once '../includes/sae.php';
else include_once '../includes/config.php';
if(!$dbconfig['user']||!$dbconfig['pwd']||!$dbconfig['dbname']) {
	echo '<div class="alert alert-danger">请先填写好数据库并保存后再安装！<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a></div>';
} else {
	require './db.class.php';
	$sql=file_get_contents("sql_v1.0.3.sql");
	$sql=explode(';',$sql);
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
	echo '<div class="alert alert-success">安装成功！<br/>SQL成功'.$t.'句/失败'.$e.'句</div><p align="right"><a class="btn btn-block btn-primary" href="?do=2">下一步>></a></p>';
} else {
	echo '<div class="alert alert-danger">安装失败<br/>SQL成功'.$t.'句/失败'.$e.'句<br/>错误信息：'.$error.'</div><p align="right"><a class="btn btn-block btn-primary" href="?do=1">点此进行重试</a></p>';
}
?>
	</div>
</div>

<?php }elseif($do=='2'){?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title" align="center">安装完成</h3>
	</div>
<div class="progress progress-striped">
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
	<span class="sr-only">100%</span>
  </div>
</div>
	<div class="panel-body">
<?php
	@file_put_contents("sql_v1.0.3.lock",'数据库V1.0.3更新锁');
	echo '<div class="alert alert-info"><font color="green"><center>更新完成！</font><br/><br/><a href="../">>>网站首页</a><hr/>UK云工作室版权所有</center></font></div>';
?>
	</div>
</div>


<?php }?>
</div>
</body>
</html>
