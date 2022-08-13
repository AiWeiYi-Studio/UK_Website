<?php
include("./includes/common.php");
include("./includes/txprotect.php");
if($conf['shoprepair']==0){
	sysmsg("<h3>当前站点未开启商城功能<h3>");
}
$qq=isset($_GET['qq'])?strip_tags($_GET['qq']):null;

$rs=$DB->query("SELECT * FROM ukyun_shops WHERE 1 order by sort asc");
$select='';
while($res = $DB->fetch($rs)){
	$ukyun_func[$res['tid']]=$res['name'];
	$select.='<option value="'.$res['tid'].'" price="'.$res['price'].'">'.$res['name'].'</option>';
}
@header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title><?php echo $conf['title']?>-云商城</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="keywords" content="<?php echo $conf['keywords']?>"/>
  <meta name="description" content="<?php echo $conf['description']?>"/>
  <meta name="author" content="UK云工作室" />
  <link rel="icon" href="assets/favicon.ico" type="image/ico">
  <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
  <script src="//cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
  <link rel="stylesheet" href="<?php echo $conf['apiurl']?>/shop/simple/css/main.css">

<style>
.shuaibi-tip {
    background: #fafafa repeating-linear-gradient(-45deg,#fff,#fff 1.125rem,transparent 1.125rem,transparent 2.25rem);
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    margin: 20px 0px;
    padding: 15px;
    border-radius: 5px;
    font-size: 14px;
    color: #555555;
}
</style>
</head>
<style>body{ background:#ecedf0 url("https://api.ukyun.cn/sjbz/api.php?lx=meizi") fixed;background-repeat:no-repeat;background-size:100% 100%;}</style></head>
<body>
<img src="https://api.ukyun.cn/sjbz/api.php?lx=meizi" alt="Full Background" class="full-bg full-bg-bottom animated pulse " ondragstart="return false;" oncontextmenu="return false;">
<div class="modal fade" align="left" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">好的</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $conf['title']?></h4>
      </div>
      <div class="modal-body">
	  <?php echo $conf['modal']?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">好的</button>
      </div>
    </div>
  </div>
</div>

<br>
<!--div class="container"-->
<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 center-block" style="float: none;">
<div class="panel panel-primary">
<div class="panel-body" style="text-align: center;">
<h1><?php echo $conf['title']?></h1>
</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading"><h3 class="panel-title" ><font color="#FFFFFF"><i class=""></i><b> <script type="text/javascript">
var now=(new Date()).getHours();
if(now>0&&now<=6){
document.write("❤熬夜对身体不好哦 快睡觉！");
}else if(now>6&&now<=11){
document.write("❤早上好 心情好来下一单吧~");
}else if(now>11&&now<=14){
document.write("❤停下手中的工作 去吃饭~");
}else if(now>14&&now<=18){
document.write("❤累了一上午了 休息会吧~");
}else{
document.write("❤晚上好 下一单醒来有惊喜哟~");
}
</script></font> </b></h3></div>
	<div>
<?php echo $conf['anounce']?>
	</div>
</div>

<div class="panel panel-info">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#onlinebuy" data-toggle="tab">在线下单</a></li>
			<li><a href="#cardbuy" data-toggle="tab">卡密下单</a></li>
			<li><a href="#query" data-toggle="tab">进度查询</a></li>
			<li><a href="#gdgn" data-toggle="tab">更多功能</a></li>
		</ul>
<div class="modal-body">
			<div id="myTabContent" class="tab-content">
			<div class="tab-pane fade in active" id="onlinebuy">
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">选择商品</div>
					<select name="tid" id="tid" class="form-control" onchange="getPoint();"><?php echo $select?></select>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">商品价格</div>
					<input type="text" name="need" id="need" class="form-control" disabled/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">下单账号</div>
					<input type="text" name="qq" placeholder="请输入正确的QQ" id="qq1" value="<?php echo $qq?>" class="form-control" required/>
				</div></div>
				<div id="pay_frame" class="form-group text-center" style="display:none;">
				<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon">订单号</div>
					<input class="form-control" name="orderid" id="orderid" value="" disabled>
					</div>
				</div>
				<div class="form-group">
					<div class="input-group">
					<div class="input-group-addon">共需支付</div>
					<input class="form-control" name="needs" id="needs" value="" disabled>
					</div>
				</div>
<?php if($conf['alipay_api']==0 and $conf['qqpay_api']==0 and $conf['wxpay_api']==0 and $conf['tenpay_api']==0){
echo '<div class="alert alert-danger">当前站点关闭了所以支付接口，您暂时无法支付，抱歉</div>';
  }else{
echo '<div class="alert alert-success">订单保存成功，请点击以下链接支付！</div>';
}?>
<?php
if($conf['alipay_api'])echo '<button type="submit" class="btn btn-default" id="buy_alipay"><img src="assets/icon/alipay.ico" class="logo">支付宝</button>&nbsp;';
if($conf['qqpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_qqpay"><img src="assets/icon/qqpay.ico" class="logo">QQ钱包</button>&nbsp;';
if($conf['wxpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_wxpay"><img src="assets/icon/wechat.ico" class="logo">微信支付</button>&nbsp;';
if($conf['tenpay_api'])echo '<button type="submit" class="btn btn-default" id="buy_tenpay"><img src="assets/icon/tenpay.ico" class="logo">财付通</button>&nbsp;';
?>
				</div>
				<input type="submit" id="submit_buy" class="btn btn-block btn-info" value="立即购买">
			</div>
									<div class="tab-pane fade in" id="gdgn">
    <div class="row">
		<div class="col-sm-6">
              <a href="../" class="widget">
                <div class="widget-content themed-background-warning text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-paper-plane-o"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>返回首页</strong>
                    </h2>
                    <span>返回官网首页</span>
                </div>
            </a>
        </div>
	<div class="col-sm-6">
            <a href="./app.php" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-cloud-download"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>APP下载</strong>
                    </h2>
                    <span>下载APP，下单更方便</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6">
            <a href="./user/reg.php" class="widget">
                <div class="widget-content themed-background-success text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-rocket"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>注册用户</strong>
                    </h2>
                    <span>注册用户账号</span>
                </div>
            </a>
        </div>
		<div class="col-sm-6">
            <a  href="./user/" target="_blank" class="widget">
                <div class="widget-content themed-background-info text-right clearfix" style="color: #fff;">
                    <div class="widget-icon pull-left">
                        <i class="fa fa-certificate"></i>
                    </div>
                    <h2 class="widget-heading h3">
                        <strong>用户登录</strong>
                    </h2>
                    <span>登录用户后台</span>
                </div>
            </a>
        </div>
	</div>
</div>
						<div class="tab-pane fade in" id="cardbuy">
				<div class="form-group">
					<a href="<?php echo $conf['kaurl']?>" class="btn btn-default btn-block" target="_blank"/>点击进入购买卡密</a>
				</div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">输入卡密</div>
					<input type="text" name="km" id="km" value="" class="form-control" required/>
				</div></div>
				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">下单QQ</div>
					<input type="text" name="qq" id="qq2" value="<?php echo $qq?>" class="form-control" required/>
				</div></div>
				<input type="submit" id="submit_card" class="btn btn-primary btn-block" value="立即购买">
				<div id="result1" class="form-group text-center" style="display:none;">
				</div>
			</div>
			<div class="tab-pane fade in" id="query">
				              <table class="table table-striped table-borderless table-vcenter remove-margin-bottom">
         <tbody>
            <tr class="shuaibi-tip animation-bigEntrance">
                <td class="text-center" style="width: 100px;">
                    <img src="//q4.qlogo.cn/headimg_dl?dst_uin=<?php echo $conf['qq']?>&spec=100" alt="avatar" class="img-circle img-thumbnail img-thumbnail-avatar">
                </td>
                <td>
                    <h4><strong>站长</strong></h4>
					<i class="fa fa-fw fa-qq text-primary"></i><?php echo $conf['qq']?><br><i class="fa fa-fw fa-history text-danger"></i>售后订单问题请联系客服
                </td>
                <td class="text-right" style="width: 20%;">
                    <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $conf['qq']?>&site=qq&menu=yes" target="_blank" data-toggle="modal" class="btn btn-sm btn-info">联系</a>
                </td>
            </tr>
         </tbody>
        </table>
		<br>
		<div class="col-xs-12 well well-sm animation-pullUp" >
			<font color="blue">待处理</font>：说明订单还未开始，等待处理！<br>
<font color="green">已完成</font>：说明当前订单已完成<br></div>

				<div class="form-group">
					<div class="input-group"><div class="input-group-addon">下单账号</div>
					<input type="text" name="qq" placeholder="请输入下单时填写的QQ" id="qq3" value="<?php echo $qq?>" class="form-control" required/>
				</div></div>
				<input type="submit" id="submit_query" class="btn btn-block btn-info" value="立即查询">
				<div id="result2" class="form-group text-center" style="display:none;">
					<table class="table table-striped">
					<thead><tr><th>ＱＱ</th><th>商品名称</th><th>购买时间</th><th>状态</th></tr></thead>
					<tbody id="list">
					</tbody>
					</table>
				</div>
			</div>
			</div>
		</div>
		</div>
<?php
$count1=$DB->count("SELECT count(*) from ukyun_orders");
$count2=$DB->count("SELECT count(*) from ukyun_orders where status=1");
$count3=$DB->count("SELECT count(*) from ukyun_shops");
$mysqlversion=$DB->count("select VERSION()");
?>
<div class="panel panel-primary" >
<div class="panel-heading"><h3 class="panel-title"><font color="#000000"><i class="fa fa-bar-chart-o"></i>&nbsp;&nbsp;<b>数据统计</b></font></h3></div>
<table class="table table-bordered">
<tbody>
<tr>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-tint"></span>订单总数量</b></br><?php echo $count1?>条
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-check"></i>已处理订单</b></br></span><?php echo $count2?>条
</font></td>
</tr>
<tr>
<td align="center"><font color="#808080"><b><span class="glyphicon glyphicon-exclamation-sign"></span>商品总数量</b></br><?php echo $count3?>个
<td align="center"><font color="#808080"><b><i class="glyphicon glyphicon-time"></i>当前的时间</b></br></span><?=$date?>
</font></td>
</tr>
</tbody>
</table>
</div>
<!--底部导航-->
<div class="panel panel-default">
<center>
<div class="panel-body">
<span style="font-weight:bold">
<?php echo $conf['title']?>
<i class="fa fa-heart text-danger">
</i></span></span><a href="./"><span style="font-weight:bold"><?php echo $conf['weburl']?></span></a><br/></div>
</div>
<!--底部导航-->

</div>
<script type="text/javascript">
function getPoint() {
	var price = $('#tid option:selected').attr('price');
	$('#need').val('￥'+price);
}
getPoint();
$(document).ready(function(){
	$("#submit_buy").click(function(){
		var tid=$("#tid").val();
		var qq=$("#qq1").val();
		if(qq=='' || tid==''){alert('请确保每项不能为空！');return false;}
		if(qq.length<5 || qq.length>20){alert('请输入正确的QQ号！');return false;}
		$('#pay_frame').hide();
		$('#submit_buy').val('Loading');
		$.ajax({
			type : "POST",
			url : "ajax.php?act=pay",
			data : {tid:tid,qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$('#tid').attr("disabled",true);
					$('#qq1').attr("disabled",true);
					$('#submit_buy').hide();
					$('#orderid').val(data.trade_no);
					$('#needs').val("￥"+data.need);
					$("#pay_frame").slideDown();
				}else{
					alert(data.msg);
				}
				$('#submit_buy').val('立即购买');
			} 
		});
	});
	$("#submit_card").click(function(){
		var km=$("#km").val();
		var qq=$("#qq2").val();
		if(qq=='' || km==''){alert('请确保每项不能为空！');return false;}
		if(qq.length<5 || qq.length>20){alert('请输入正确的QQ号！');return false;}
		$('#submit_card').val('Loading');
		$('#result1').hide();
		$.ajax({
			type : "POST",
			url : "ajax.php?act=card",
			data : {km:km,qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$('#result1').html('<div class="alert alert-success"><img src="assets/img/ico_success.png">&nbsp;'+data.msg+'</div>');
					$("#result1").slideDown();
				}else{
					alert(data.msg);
				}
				$('#submit_card').val('立即购买');
			} 
		});
	});
	$("#submit_query").click(function(){
		var qq=$("#qq3").val();
		if(qq==''){alert('请确保每项不能为空！');return false;}
		$('#submit_query').val('Loading');
		$('#result2').hide();
		$('#list').html('');
		$.ajax({
			type : "POST",
			url : "ajax.php?act=query",
			data : {qq:qq},
			dataType : 'json',
			success : function(data) {
				if(data.code == 0){
					$.each(data.data, function(i, item){
						status=item.status==1?'<font color=green>已完成</font>':'<font color=blue>待处理</font>';
						$('#list').append('<tr tid='+item.tid+'><td>'+item.qq+'</td><td>'+item.name+'</td><td>'+item.addtime+'</td><td>'+status+'</td></tr>');
					});
					$("#result2").slideDown();
				}else{
					alert(data.msg);
				}
				$('#submit_query').val('立即查询');
			} 
		});
	});
$("#buy_alipay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=alipay&orderid='+orderid;
});
$("#buy_qqpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=qqpay&orderid='+orderid;
});
$("#buy_wxpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=wxpay&orderid='+orderid;
});
$("#buy_tenpay").click(function(){
	var orderid=$("#orderid").val();
	window.location.href='other/submit.php?type=tenpay&orderid='+orderid;
});
var isModal=<?php echo empty($conf['modal'])?'false':'true';?>;
if( !$.cookie('op') && isModal==true){
	$('#myModal').modal({
		keyboard: true
	});
	var cookietime = new Date(); 
	cookietime.setTime(cookietime.getTime() + (10*60*1000));
	$.cookie('op', false, { expires: cookietime });
}
});
</script>
</div>
</div>
</body>
<div class="dandelion">
  <span class="smalldan"></span>
  <span class="bigdan"></span>
</div>
</html>