<?php
include("../includes/common.php");
if($conf['begrepair']==1){
	sysmsg("<h3>本站赞助系统未开启！<h3>");
}
$data = get_curl($alipay_config['apiurl'] . "api.php?act=orders&limit=10&pid=" . $alipay_config['partner'] . "&key=" . $alipay_config['key'] . "&url=" . $_SERVER["HTTP_HOST"]);
$arr = json_decode($data, true);
if ($arr["code"] == 0 - 2) {
	sysmsg("<h3>支付接口信息配置错误<h3>");
}
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
<title><?php echo $conf['sitename']; ?></title>
<meta name="keywords" content="<?php echo $conf['keywords']; ?>">
<meta name="description" content="<?php echo $conf['description']; ?>">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=0.9">
<link href="../assets/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://css.letvcdn.com/lc04_yinyue/201612/19/20/00/bootstrap.min.css">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<body background="https://ww2.sinaimg.cn/large/a15b4afegy1fpp139ax3wj200o00g073.jpg">
<div class="container" style="padding-top:20px;">
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<div class="panel panel-primary">
<div class="panel-heading" style="background: linear-gradient(to right,#8ae68a,#5ccdde,#b221ff);"><center><font color="#000000"><b><?php echo $conf['panel']; ?></b></font></center></div>
<div class="panel-body">
<center><div class="alert alert-success"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['kfqq']; ?>&site=qq&menu=yes"><img class="img-circle m-b-xs" style="border: 2px solid #1281FF; margin-left:3px; margin-right:3px;" src="https://q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['kfqq']; ?>&spec=100"; width="60px" height="60px" alt="<?php echo $conf['sitename']; ?>"><br></a><?php echo $conf['beggg']; ?>
</div></center>
<form name=alipayment action=pay.php method=post target="_blank">
<div class="input-group">			 
<span class="input-group-addon"><span class="glyphicon glyphicon-barcode"></span> 赞助单号</span>
<input size="30" name="WIDout_trade_no" value="<?php echo date("YmdHis").mt_rand(100,999); ?>"  class="form-control" />
</div>
<br/>
<div class="input-group">
<span class="input-group-addon"><span class="glyphicon glyphicon-shopping-cart"></span> 赞助留言</span>
<input size="30" name="WIDsubject" value="<?php echo $conf['liuyan']; ?>" class="form-control" required="required" />
</div>
<br/>
<div class="input-group">
<span class="input-group-addon"><span class="glyphicon glyphicon-yen"></span> 赞助金额</span>
<input size="30" name="WIDtotal_fee" value="<?php echo $conf['money']; ?>" class="form-control" required="required"/>			        
</div>        			
<br/> 
<center><div class="alert alert-warning">选择一种方式进行赞助...</div></center>
<center>
<div class="btn-group btn-group-justified" role="group" aria-label="...">
<div class="btn-group" role="group">
<button type="radio" name="type" value="alipay" class="btn btn-primary">支付宝</button>
</div>
<div class="btn-group" role="group">
<button type="radio" name="type" value="qqpay" class="btn btn-danger">QQ</button>
</div>
<div class="btn-group" role="group">
<button type="radio" name="type" value="wxpay" class="btn btn-info">微信</button>
</div>
</div>
</div>
</center> 
</div>
</form>
</div>
<?php
echo "<div class=\"col-xs-12 col-sm-10 col-lg-8 center-block\" style=\"float: none;\"><div class=\"panel panel-primary\"><div class=\"panel-heading\" style=\"background: linear-gradient(to right,#b221ff,#14b7ff,#8ae68a);\"><center><font color=\"#000000\"><b>大佬们的赞助记录</b></font></center></div><div class=\"table-responsive\">\r\n<table class=\"table table-striped\">\r\n<thead><tr><th>订单号</th><th>赞助方式</th><th>赞助金额</th><th>状态</th></tr></thead>\r\n<tbody>";
	foreach ($arr["data"] as $res) {
	echo "<tr><td>" . $res["trade_no"] . "</td><td>" . $res["type"] . "</b></td><td>" . $res["money"] . "元</b></td><td>" . ($res["status"] == 1 ? "<font color=green>已完成赞助</font>" : "<font color=red>未完成赞助</font>") . "</td></tr>";
	}
echo "</tbody>\r\n</table>\r\n</div>\r\n\t</div>";
?>
</div>
<p style="text-align:center">&copy; Powered by <a href="http://<?php echo $conf['ym']; ?>"><?php echo $conf['copy']; ?></a>!</p>
<audio autoplay="autoplay" height="100" width="100">
<source src="<?php echo $conf['begmusic']; ?>" type="audio/mp3" />
</audio>
</body>
</html>