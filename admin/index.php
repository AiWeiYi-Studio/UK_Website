<?php
/**
 * UK云工作室官网程序站长后台管理
**/
$mod='blank';
include("../includes/common.php");
include("../includes/version.php");
$title='平台首页';
if($islogin==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
?>
<?php
$juzi = 'https://api.ukyun.cn/yan/api.php';
$juzis = file_get_contents($juzi); 
$users=$DB->count("SELECT count(*) from ukyun_daili");
$admins=$DB->count("SELECT count(*) from ukyun_user");
$liars=$DB->count("SELECT count(*) from ukyun_liar");
$lists=$DB->count("SELECT count(*) from ukyun_list");
$configs=$DB->count("SELECT count(*) from ukyun_config");
$logs=$DB->count("SELECT count(*) from ukyun_log");
$shops=$DB->count("SELECT count(*) from ukyun_shops");
?>
<?php
if($udata['access_token']==''){
$kuaijie="<a href='./binding.php'>未绑定（点击绑定）</a>";
}elseif($udata['access_token'] !==''){
$kuaijie="<a href='./binding.php?jiebang'>已绑定（点击解绑）</a>";
}
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="block">
<div class="block-title"><h3 class="panel-title">后台首页</h3></div>
<ul class="list-group">
<center><li class="list-group-item"><img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?=$udata['qq']?>&spec=100" alt="Avatar" width="60" height="60" style="border:1px solid #FFF;-moz-box-shadow:0 0 3px #AAA;-webkit-box-shadow:0 0 3px #AAA;border-radius: 50%;box-shadow:0 0 3px #AAA;padding:3px;margin-right: 3px;margin-left: 6px;"><br>&nbsp;&nbsp;
&nbsp;UID：<font color="orange"><?=$udata['uid']?></b></font></br>昵称：<font color="orange"><b><?=$udata['name']?></b></font> </br>QQ：<font color="orange"><b><?=$udata['qq']?></b></font><font color="orange"></font> </br><b>尊敬的<?=$udata['name']?>，欢迎来到站长后台中心</b></li></center>

  <li class="list-group-item"><span class="glyphicon glyphicon-stats"></span> <b>统计：</b>站长数:<?=$admins?>,用户数:<?=$users?>,日志数:<?=$logs?>,配置数:<?=$configs?><br>骗子数:<?=$liars?>,导航数:<?=$lists?>,商品数:<?=$shops?>,总数据:<?=$admins+$users+$liars+$lists+$configs+$logs+$shops?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-time"></span> <b>时间：</b> <?=$date?></li>
            <li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> <b>权限：<?=$udata['power']?></li>
            <li class="list-group-item"><span class="fa fa-calendar sidebar-nav-icon"></span> <b>名言：</b> <?=$juzis?></li>
             <li class="list-group-item"><span class="glyphicon glyphicon-user"></span> <b>快捷登陆：</b><font color="#1701EA"><a href="#" onclick='<?=$login?>'"><?=$kuaijie?></a></font> &nbsp;</li>
            <li class="list-group-item"><span class="glyphicon glyphicon-list"></span> <b>菜单：</b> 
              <a href="./user.php" class="btn btn-xs btn-success">站长管理</a>
              <a href="./ulist.php" class="btn btn-xs btn-success">用户管理</a>
              <a href="./update.php" class="btn btn-xs btn-success">系统更新</a>
			  <a href="./password.php" class="btn btn-xs btn-danger">修改密码</a>
  </div>
<div class="panel panel-info">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tz" data-toggle="tab">用户通知</a></li>
			<li><a href="#text" data-toggle="tab">系统信息</a></li>
			<li><a href="#ukyun" data-toggle="tab">相关人员</a></li>
			<li><a href="#uplog" data-toggle="tab">更新日志</a></li>
			<li><a href="#cloud" data-toggle="tab">云端状态</a></li>
		</ul>
<div class="modal-body">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="tz">
<ul class="list-group">
 <li class="list-group-item"></b></span>

<?php echo $conf['tz']?>
</div>
<div class="tab-pane fade in" id="uplog">
<?php
$uplog = 'http://ob.ukyun.cn/api/uplog.php';
$uplogs = file_get_contents($uplog); 
?>
<ul class="list-group">
<li class="list-group-item"></b></span>
<?=$uplogs?>
</div>
<div class="tab-pane fade in" id="text">
	<ul class="list-group">
		<li class="list-group-item">
			<b>PHP 版本：</b><?php echo phpversion() ?>
			<?php if(ini_get('safe_mode')) { echo '线程安全'; } else { echo '非线程安全'; } ?>
		</li>
		<li class="list-group-item">
			<b>MySQL 版本：</b><?php
mysql_connect('127.0.0.1','root','');
echo mysql_get_server_info();
?>
		</li>
		<li class="list-group-item">
			<b>服务器软件：</b><?php echo $_SERVER['SERVER_SOFTWARE'] ?>
		</li>
		
		<li class="list-group-item">
			<b>程序最大运行时间：</b><?php echo ini_get('max_execution_time') ?>s
		</li>
		<li class="list-group-item">
			<b>POST许可：</b><?php echo ini_get('post_max_size'); ?>
		</li>
		<li class="list-group-item">
			<b>文件上传许可：</b><?php echo ini_get('upload_max_filesize'); ?>
		</li>
		<li class="list-group-item">
			<b>程序当前版本：</b>
			<?php echo VERSIONS ?>
		</li>
	</ul>
</div>
<div class="tab-pane fade in" id="ukyun">
<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
<tbody>
<tr class="shuaibi-tip animation-bigEntrance">
<td class="text-center" style="width: 100px;">
<img src="http://www.ukyun.cn/assets/favicon.ico" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
</td>
<td>
<h4><strong>UK云工作室</strong></h4>
<i class="fa fa-globe sidebar-nav-icon"></i> www.ukyun.cn<br><i class="fa fa-fw fa-history text-danger"></i>本程序版权所有者
</td>
<td class="text-right" style="width: 20%;">
<a href="http://www.ukyun.cn" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">进入</a>
</td>
</tr>
</tbody>
</table>
<br>
<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
<tbody>
<tr class="shuaibi-tip animation-bigEntrance">
<td class="text-center" style="width: 100px;">
<img src="//q4.qlogo.cn/headimg_dl?dst_uin=2874992246&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
</td>
<td>
<h4><strong>辉辉很乖</strong></h4>
<i class="fa fa-fw fa-qq text-primary"></i>2874992246<br><i class="fa fa-fw fa-history text-danger"></i>程序开发者、程序维护者
</td>
<td class="text-right" style="width: 20%;">
<a href="http://wpa.qq.com/msgrd?v=3&uin=2874992246&site=qq&menu=yes" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系</a>
</td>
</tr>
</tbody>
</table>
<br>
<table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
<tbody>
<tr class="shuaibi-tip animation-bigEntrance">
<td class="text-center" style="width: 100px;">
<img src="http://www.ukyun.cn/assets/favicon.ico" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
</td>
<td>
<h4><strong>官方客服</strong></h4>
<i class="fa fa-cog sidebar-nav-icon"></i> kefu.ukyun.cn<br><i class="fa fa-fw fa-history text-danger"></i>UK云工作室客服
</td>
<td class="text-right" style="width: 20%;">
<a href="http://kefu.ukyun.cn/" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系</a>
</td>
</tr>
</tbody>
</table>
</div>
<div class="tab-pane fade in" id="cloud">
	<ul class="list-group">
		<li class="list-group-item">
			<b>程序官方授权更新系统：</b>
<?php
$authapi = 'http://ob.ukyun.cn/api/api.php';
$authapis = file_get_contents($authapi); 
if($authapis=='1'){
echo 授权系统连接正常;
}else{
echo 授权系统连接失败;
}
?>
</li>
<li class="list-group-item">
			<b>云端模板资源连接状态：</b>
<?php
$ukyunapi = 'https://api.ukyun.cn/website/api.php';
$ukyunapis = file_get_contents($ukyunapi); 
if($ukyunapis=='1'){
echo 云端资源连接正常;
}else{
echo 云端资源连接失败;
}
?>
</li>
<li class="list-group-item">
			<b>UK云API程序连接状态：</b>
<?php
$ukyunapi1 = 'https://api.ukyun.cn/api.php';
$ukyunapis1 = file_get_contents($ukyunapi1); 
if($ukyunapis1=='1'){
echo UK云API连接正常;
}else{
echo UK云API连接失败;
}
?>
</li>
	</ul>
</div>