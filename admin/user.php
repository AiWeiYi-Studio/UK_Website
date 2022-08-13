<?php
/**
 * UK云工作室官网程序站长管理
**/
include("../includes/common.php");
$title='站长管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
if($udata['power']==普通管理) {
exit("<script language='javascript'>alert('您当前的等级不能进入此页面哦！');window.location.href='javascript:window.history.back(-1);';</script>");
}
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">站长管理</h3></div>
<div class="card-body">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索站长</h4>
      </div>
      <div class="modal-body">
      <form action="user.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入站长名或QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="搜索"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php

$my=isset($_GET['my'])?$_GET['my']:null;

if($my=='add')
{
echo '<form action="./user.php?my=add_submit" method="POST">
<div class="form-group">
<label>站长用户名:</label><br>
<input type="text" class="form-control" name="user" value="" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="pwd" value="" required>
</div>
<div class="form-group">
<label>联系QQ:</label><br>
<input type="text" class="form-control" name="qq" value="">
</div>
<div class="form-group">
<label>站长名:</label><br>
<input type="text" class="form-control" name="name" value="">
</div>
<div class="form-group">
<label>站长状态:</label>
<select name="actives" class="form-control"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<div class="form-group">
<label>站长权限:</label>
<select name="power" class="form-control"><option value="超级管理">超级管理</option><option value="普通管理">普通管理</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
echo '<br/><a href="./user.php">>>返回站长列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=intval($_GET['id']);
$row=$DB->get_row("select * from ukyun_user where uid='$id' limit 1");
echo '<form action="./user.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>站长用户名:</label><br>
<input type="text" class="form-control" name="user" value="'.$row['user'].'" required>
</div>
<div class="form-group">
<label>密码:</label><br>
<input type="text" class="form-control" name="pwd" value="'.$row['pass'].'" required>
</div>
<div class="form-group">
<label>联系QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'">
</div>
<div class="form-group">
<label>站长名:</label><br>
<input type="text" class="form-control" name="name" value="'.$row['name'].'">
</div>
<div class="form-group">
<label>站长状态:</label>
<select name="actives" class="form-control" default="'.$row['actives'].'"><option value="1">1_激活</option><option value="0">0_封禁</option></select>
</div>
<div class="form-group">
<label>站长权限:</label>
<select name="power" class="form-control" default="'.$row['power'].'"><option value="超级管理">1_超级</option><option value="普通管理">0_普通</option></select>
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
echo '<br/><a href="./user.php">>>返回站长列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$qq=$_POST['qq'];
$actives=$_POST['actives'];
$power=$_POST['power'];
$name=$_POST['name'];
if($user==NULL or $pwd==NULL or  $qq==NULL or $actives==NULL or $power==NULL or $name==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$rows=$DB->get_row("select * from ukyun_user where user='$user' limit 1");
if($rows)
exit("<script language='javascript'>alert('站长名已存在！');window.location.href='user.php?my=add';</script>");
$sql="insert into `ukyun_user` (`user`,`pass`,`qq`,`actives`,`power`,`name`,`boss`) values ('".$user."','".$pwd."','".$qq."','".$actives."','".$power."','".$name."','".$udata['uid']."')";
if($DB->query($sql)){
    $city=get_ip_city($clientip);
	 $users=$udata['user'];
	 $DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$users."','添加站长$user','".$date."','".$city."','IP:".$clientip."')");
	showmsg('添加站长成功！<br/><br/><a href="./user.php">>>返回站长列表</a>',1);
}else
	showmsg('添加站长失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from ukyun_user where uid='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$user=$_POST['user'];
$pwd=$_POST['pwd'];
$qq=$_POST['qq'];
$actives=$_POST['actives'];
$power=$_POST['power'];
$name=$_POST['name'];
if($user==NULL or $pwd==NULL or $actives==NULL or $power==NULL or $name==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$city=get_ip_city($clientip);
$users=$udata['user'];
$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$users."','修改站长$user','".$date."','".$city."','IP:".$clientip."')");
if($DB->query("update ukyun_user set user='$user',pass='$pwd',qq='$qq',actives='$actives',power='$power',name='$name' where uid='{$id}'"))
	showmsg('修改站长成功！<br/><br/><a href="./user.php">>>返回站长列表</a>',1);
else
	showmsg('修改站长失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=intval($_GET['id']);
$sql="DELETE FROM ukyun_user WHERE uid='$id'";
	$city=get_ip_city($clientip);
	$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$user."','添加站长','".$date."','".$city."','IP:".$clientip."')");
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./user.php">>>返回站长列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from ukyun_user");
if(isset($_GET['id'])){
	$sql = " uid={$_GET['id']}";
}elseif(isset($_GET['kw'])){
	$sql = " user='{$_GET['kw']}' or qq='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个站长<br/><a href="./user.php?my=add" class="btn btn-primary">添加站长</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>UID</th><th>站长名</th><th>站长用户名</th><th>密码</th><th>QQ</th><th>状况</th><th>权限</th><th>操作</th></tr></thead>
          <tbody>
<?php
$pagesize=30;
$pages=intval($numrows/$pagesize);
if ($numrows%$pagesize)
{
 $pages++;
 }
if (isset($_GET['page'])){
$page=intval($_GET['page']);
}
else{
$page=1;
}
$offset=$pagesize*($page - 1);

$rs=$DB->query("SELECT * FROM ukyun_user WHERE{$sql} order by uid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
if($res['actives']==0){$q="封禁";}elseif($res['actives']==1){$q="正常";}
echo '<tr><td><b>'.$res['uid'].'</b></td><td>'.$res['name'].'</td><td>'.$res['user'].'</td><td>'.$res['pass'].'</td><td><a href="http://wpa.qq.com/msgrd?v=3&uin='.$res['qq'].'&site=qq&menu=yes">'.$res['qq'].'</a></td><td>'.$q.'</td><td>'.$res['power'].'</td><td><a href="./user.php?my=edit&id='.$res['uid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./log.php?my=search&column=uid&value='.$res['user'].'" class="btn btn-success btn-xs">日志</a>&nbsp;<a href="./user.php?my=delete&id='.$res['uid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此站长吗？\');">删除</a></td></tr>';
}
?>
          </tbody>
        </table>
      </div>
<?php
echo'<ul class="pagination">';
$first=1;
$prev=$page-1;
$next=$page+1;
$last=$pages;
if ($page>1)
{
echo '<li><a href="user.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="user.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="user.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="user.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="user.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="user.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>