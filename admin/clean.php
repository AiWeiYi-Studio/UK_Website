<?php  include('../includes/common.php');
$title='系统数据清理';
include('./head.php');
if ($islogin!=1) {exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}echo '
    <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
if ($mod=='cleanlog') {$DB->query('TRUNCATE TABLE `ukyun_log`');
showmsg('清空日志成功！',1);
}
if ($mod=='cleanliar') {$DB->query('TRUNCATE TABLE `ukyun_liar`');
showmsg('清空骗子成功！',1);
} 
if ($mod=='cleanlist') {$DB->query('TRUNCATE TABLE `ukyun_list`');
showmsg('清空系统导航成功！',1);
}
else {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">系统数据清除</h3></div>
<div class="card-body">
<a href="./clean.php?mod=cleanlog" onclick="return confirm(\'你确实要清空所有的日志吗？\');" class="btn btn-block btn-default">清空系统日志</a><br/>
<a href="./clean.php?mod=cleanliar" onclick="return confirm(\'你确实要清空所有的骗子吗？\');" class="btn btn-block btn-default">清空骗子列表</a><br/>
<a href="./clean.php?mod=cleanlist" onclick="return confirm(\'你确实要清空所有的导航吗？\');" class="btn btn-block btn-default">清空导航列表</a><br/>
</form><br/>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
清理可减少数据库空间(推荐数据库空间少者使用)
</div>
</div>
';
}echo ' </div>
</div>';
?>