<?php
/**
 * UK云工作室官网程序骗子大全
**/
include("../includes/common.php");
$title='骗子大全';
if($islogins==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">骗子大全</h3></div>
<div class="panel-body">
<div class="modal fade" align="left" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">查询骗子</h4>
      </div>
      <div class="modal-body">
      <form action="liar.php" method="GET">
<input type="text" class="form-control" name="search" placeholder="请输入需要查询的QQ"><br/>
<input type="submit" class="btn btn-primary btn-block" value="查询骗子"></form>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php
{

$numrows=$DB->count("SELECT count(*) from ukyun_liar");
if(isset($_GET['uid'])){
	$sql = " uid={$_GET['uid']}";
}elseif(isset($_GET['search'])){
	$sql = " qq='{$_GET['search']}'";
}else{
	$sql = " 1";
}
$con='系统共有 <b>'.$numrows.'</b> 个骗子<br><a href="#" data-toggle="modal" data-target="#search" id="search" class="btn btn-success">查询骗子</a>';

echo '<div class="alert alert-info">';
echo $con;
echo '</div>';

?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>ID</th><th>骗子QQ</th><th>警戒程度</th><th>案例回放</th></tr></thead>
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
echo '<tr><td><b>'.$res['uid'].'</b></td><td>'.$res['qq'].'</td><td>'.$res['dengji'].'</td><td>'.$res['xx'].'</td></tr>';
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