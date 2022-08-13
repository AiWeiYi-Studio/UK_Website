<?php
/**
 * UK云工作室官网程序网站导航
**/
include("../includes/common.php");
$title='网站导航';
if($islogin==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">网址导航</h3></div>
<div class="card-body">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索网站</h4>
      </div>
      <div class="modal-body">
      <form action="url.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入站点标题"><br/>
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
echo '<form action="./url.php?my=add_submit" method="POST">
<div class="form-group">
<label>名字:</label><br>
<input type="text" class="form-control" name="name" value="" required>
</div>
<div class="form-group">
<label>URL:</label><br>
<input type="text" class="form-control" name="url" value="">
</div>
<div class="form-group">
<label>QQ:</label><br>
<input type="text" class="form-control" name="qq" value="">
</div>
<div class="form-group">
<label>介绍:</label><br>
<input type="text" class="form-control" name="js" value="">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
echo '<br/><a href="./url.php">>>返回列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=intval($_GET['id']);
$row=$DB->get_row("select * from ukyun_list where id='$id' limit 1");
echo '<form action="./url.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>TITLE:</label><br>
<input type="text" class="form-control" name="name" value="'.$row['name'].'" required>
</div>
<div class="form-group">
<label>URL:</label><br>
<input type="text" class="form-control" name="url" value="'.$row['url'].'">
</div>
<div class="form-group">
<label>QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'">
</div>
<div class="form-group">
<label>介绍:</label><br>
<input type="text" class="form-control" name="js" value="'.$row['js'].'">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
echo '<br/><a href="./url.php">>>返回列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$url=$_POST['url'];
$name=$_POST['name'];
$qq=$_POST['qq'];
$js=$_POST['js'];
if($url==NULL or  $name==NULL or  $js==NULL or  $qq==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$rows=$DB->get_row("select * from ukyun_list where id='$url' limit 1");
if($rows)
exit("<script language='javascript'>alert('添加失败，链接已存在！');window.location.href='url.php?my=add';</script>");
$sql="insert into `ukyun_list` (`id`,`url`,`name`,`qq`,`js`) values ('".$url."','".$name."','".$qq."','".$js."')";
if($DB->query($sql)){
	showmsg('添加成功！<br/><br/><a href="./url.php">>>返回列表</a>',1);
}else
	showmsg('添加失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from ukyun_list where id='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$url=$_POST['url'];
$name=$_POST['name'];
$qq=$_POST['qq'];
$js=$_POST['js'];
if($id==NULL or $url==NULL or  $name==NULL or  $js==NULL or  $qq==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update ukyun_list set id='$id',name='$name',url='$url',qq='$qq',js='$js' where id='{$id}'"))
	showmsg('修改成功！<br/><br/><a href="./url.php">>>返回列表</a>',1);
else
	showmsg('修改失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=intval($_GET['id']);
$sql="DELETE FROM ukyun_list WHERE id='$id'";
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./url.php">>>返回列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from ukyun_list");
if(isset($_GET['id'])){
	$sql = " id={$_GET['id']}";
}elseif(isset($_GET['kw'])){
	$sql = " name='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个链接<br/><a href="./url.php?my=add" class="btn btn-primary">添加</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">搜索</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>标题</th><th>URL</th><th>QQ</th><th>介绍</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM ukyun_list WHERE{$sql} order by id desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['id'].'</b></td><td>'.$res['name'].'</td><td><a href="http://'.$res['url'].'">'.$res['url'].'</a></td><td><a href="http://wpa.qq.com/msgrd?v=3&uin='.$res['qq'].'&site=qq&menu=yes">'.$res['qq'].'</a></td><td>'.$res['js'].'</td><td><a href="./url.php?my=edit&id='.$res['id'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="http://'.$res['url'].'" class="btn btn-success btn-xs">进入</a>&nbsp;<a href="http://wpa.qq.com/msgrd?v=3&uin='.$res['qq'].'&site=qq&menu=yes" class="btn btn-success btn-xs">联系</a>&nbsp;<a href="./url.php?my=delete&id='.$res['id'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除吗？\');">删除</a></td></tr>';
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
echo '<li><a href="url.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="url.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="url.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="url.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="url.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="url.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
}
?>
    </div>
  </div>