<?php
/**
 * UK云工作室官网程序骗子管理
**/
include("../includes/common.php");
$title='骗子管理';
if($islogin==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">骗子大全</h3></div>
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">搜索用户</h4>
      </div>
      <div class="modal-body">
      <form action="liar.php" method="GET">
<input type="text" class="form-control" name="kw" placeholder="请输入QQ查询"><br/>
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
echo '<form action="./liar.php?my=add_submit" method="POST">
<div class="form-group">
<label>骗子QQ:</label><br>
<input type="text" class="form-control" name="qq" value="" required>
</div>
<div class="form-group">
<label>骗子等级:</label>
<select name="dengji" class="form-control">
<option value="绿色警戒">绿色警戒</option>
<option value="蓝色警戒">蓝色警戒</option>
<option value="黄色警戒">黄色警戒</option>
<option value="橙色警戒">橙色警戒</option>
<option value="红色警戒">红色警戒</option>
</select>
</div>
<div class="form-group">
<label>诈骗信息:</label><br>
<input type="text" class="form-control" name="xx" value="">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定添加"></form>';
echo '<br/><a href="./liar.php">>>返回列表</a>';
echo '</div></div>';
}
elseif($my=='edit')
{
$id=intval($_GET['id']);
$row=$DB->get_row("select * from ukyun_liar where uid='$id' limit 1");
echo '<form action="./liar.php?my=edit_submit&id='.$id.'" method="POST">
<div class="form-group">
<label>骗子QQ:</label><br>
<input type="text" class="form-control" name="qq" value="'.$row['qq'].'" required>
</div>
<div class="form-group">
<label>骗子等级:</label>
<select name="dengji" class="form-control" default="'.$row['dengji'].'">
<option value="绿色警戒">绿色警戒</option>
<option value="蓝色警戒">蓝色警戒</option>
<option value="黄色警戒">黄色警戒</option>
<option value="橙色警戒">橙色警戒</option>
<option value="红色警戒">红色警戒</option>
</select>
</div>
<div class="form-group">
<label>诈骗信息:</label><br>
<input type="text" class="form-control" name="xx" value="'.$row['xx'].'">
</div>
<input type="submit" class="btn btn-primary btn-block" value="确定修改"></form>';
echo '<br/><a href="./liar.php">>>返回列表</a>';
echo '</div></div>';
}
elseif($my=='add_submit')
{
$qq=$_POST['qq'];
$dengji=$_POST['dengji'];
$xx=$_POST['xx'];
if($qq==NULL or $dengji==NULL or  $xx==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
$rows=$DB->get_row("select * from ukyun_liar where qq='$qq' limit 1");
if($rows)
exit("<script language='javascript'>alert('QQ已存在！');window.location.href='liar.php?my=add';</script>");
$sql="insert into `ukyun_liar` (`qq`,`dengji`,`xx`) values ('".$qq."','".$dengji."','".$xx."')";
if($DB->query($sql)){
	showmsg('添加成功！<br/><br/><a href="./liar.php">>>返回列表</a>',1);
}else
	showmsg('添加失败！'.$DB->error(),4);
}
}
elseif($my=='edit_submit')
{
$id=intval($_GET['id']);
$rows=$DB->get_row("select * from ukyun_liar where uid='$id' limit 1");
if(!$rows)
	showmsg('当前记录不存在！',3);
$qq=$_POST['qq'];
$dengji=$_POST['dengji'];
$xx=$_POST['xx'];
if($qq==NULL or $xx==NULL){
showmsg('保存错误,请确保每项都不为空!',3);
} else {
if($DB->query("update ukyun_liar set qq='$qq',dengji='$dengji',xx='$xx' where uid='{$id}'"))
	showmsg('修改成功！<br/><br/><a href="./liar.php">>>返回列表</a>',1);
else
	showmsg('修改失败！'.$DB->error(),4);
}
}
elseif($my=='delete')
{
$id=intval($_GET['id']);
$sql="DELETE FROM ukyun_liar WHERE uid='$id'";
if($DB->query($sql))
	showmsg('删除成功！<br/><br/><a href="./liar.php">>>返回列表</a>',1);
else
	showmsg('删除失败！'.$DB->error(),4);
}
else
{

$numrows=$DB->count("SELECT count(*) from ukyun_liar");
if(isset($_GET['id'])){
	$sql = " uid={$_GET['id']}";
}elseif(isset($_GET['kw'])){
	$sql = " qq='{$_GET['kw']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个骗子<br/><a href="./liar.php?my=add" class="btn btn-primary">添加骗子</a>&nbsp;<a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">查询骗子</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>UID</th><th>骗子QQ</th><th>警戒程度</th><th>诈骗信息</th><th>操作</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM ukyun_liar WHERE{$sql} order by uid desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['uid'].'</b></td><td>'.$res['qq'].'</td><td>'.$res['dengji'].'</td><td>'.$res['xx'].'</td><td><a href="./liar.php?my=edit&id='.$res['uid'].'" class="btn btn-info btn-xs">编辑</a>&nbsp;<a href="./liar.php?my=delete&id='.$res['uid'].'" class="btn btn-xs btn-danger" onclick="return confirm(\'你确实要删除此骗子吗？\');">删除</a></td></tr>';
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
echo '<li><a href="liar.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="liar.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="liar.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="liar.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="liar.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="liar.php?page='.$last.$link.'">尾页</a></li>';
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