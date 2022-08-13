<?php
/**
 * UK云工作室官网程序用户日志
**/
include("../includes/common.php");
$title='用户日志';
if($islogins==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<?php
$my=isset($_GET['my'])?$_GET['my']:null;

echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">用户日志</h3></div>
<ul class="list-group">
';

if($my=='search') {
	if($_GET['column']=='data'){
		$sql=" `data` LIKE '%{$_GET['value']}%'";
	}else{
		$sql=" `{$_GET['column']}`='{$_GET['value']}'";
	}
	$numrows=$DB->count("SELECT count(*) from ukyun_log WHERE{$sql}");
	$con=' <h4>您的账号'.$_GET['value'].' 的共有 <b>'.$numrows.'</b> 条记录</h4>';
	$link='&my=search&column='.$_GET['column'].'&value='.$_GET['value'];
}
echo $con;
?>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead><tr><th>操作用户</th><th>操作类型</th><th>时间</th><th>城市</th><th>数据</th></tr></thead>
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

$rs=$DB->query("SELECT * FROM ukyun_log WHERE{$sql} order by date desc limit $offset,$pagesize");
while($res = $DB->fetch($rs))
{
echo '<tr><td><b>'.$res['uid'].'</b></td><td>'.$res['type'].'</td><td>'.$res['date'].'</td><td>'.$res['city'].'</td><td>'.$res['data'].'</td></tr>';
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
echo '<li><a href="log.php?page='.$first.$link.'">首页</a></li>';
echo '<li><a href="log.php?page='.$prev.$link.'">&laquo;</a></li>';
} else {
echo '<li class="disabled"><a>首页</a></li>';
echo '<li class="disabled"><a>&laquo;</a></li>';
}
for ($i=1;$i<$page;$i++)
echo '<li><a href="log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '<li class="disabled"><a>'.$page.'</a></li>';
if($pages>=10)$pages=10;
for ($i=$page+1;$i<=$pages;$i++)
echo '<li><a href="log.php?page='.$i.$link.'">'.$i .'</a></li>';
echo '';
if ($page<$pages)
{
echo '<li><a href="log.php?page='.$next.$link.'">&raquo;</a></li>';
echo '<li><a href="log.php?page='.$last.$link.'">尾页</a></li>';
} else {
echo '<li class="disabled"><a>&raquo;</a></li>';
echo '<li class="disabled"><a>尾页</a></li>';
}
echo'</ul>';
#分页
?>
    </div>
  </div>