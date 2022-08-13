<?php
/**
 * UK云工作室官网程序站长修改密码
**/
$mod='blank';
include("../includes/common.php");
$title='修改密码';
if($islogins==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
include './head.php';
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
?>
<?php
if(isset($_POST['submit'])) {
$oldpass=daddslashes($_POST['oldpass']);
$oldpass=($oldpass);
if($oldpass!=$udata['pass']) {
	showmsg('原密码错误',4);
	exit;
}
$olduser=$udata['user'];
$user=daddslashes($_POST['user']);
$newpass=daddslashes($_POST['newpass']);
$newpass=($newpass);
$sql="update `ukyun_daili` set `user` ='{$user}',`pass` ='{$newpass}' where `uid`='{$udata['uid']}'";
if($DB->query($sql)){
	setcookie("admin_token", "", time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	$city=get_ip_city($clientip);
		$DB->query("insert into `ukyun_log` (`uid`,`type`,`date`,`city`,`data`) values ('".$udata['user']."','修改密码','".$date."','".$city."','原密码".$oldpass."|新密码".$newpass."|原账号".$olduser."|新账号".$user."')");

	exit("<script language='javascript'>alert('修改成功，请重新登陆！');window.location.href='./login.php';</script>");
}else{
	showmsg('修改失败！<br/>'.$DB->error(),4,$_POST['backurl']);
	exit();
	}
}
?>
<main class="lyear-layout-content">
<div class="container-fluid">
			<div class="block">
				<div class="block-title">
					<h3 class="panel-title">修改密码</h3></div>
        <div class="panel-body">
          <form action="./password.php" method="post" class="form-horizontal" role="form">
                        <div class="input-group">
                       <span class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span></span>
              <input type="user" name="user"  class="form-control" placeholder="新账号" required="required"/>
            </div><br/>
                        <div class="input-group">
             <span class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="oldpass" value="<?php echo @$_POST['oldpass'];?>" class="form-control" placeholder="旧密码" required="required"/>
            </div><br/>
            <div class="input-group">
             <span class="input-group-addon"> <span class="glyphicon glyphicon-lock"></span></span>
              <input type="password" name="newpass" class="form-control" placeholder="新密码" required="required"/>
            </div><br/>
            <div class="form-group">
              <div class="col-xs-12"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/></div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>