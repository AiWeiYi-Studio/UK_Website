<?php
/**
 * 系统设置
**/
include("../includes/common.php");
$title='后台管理';
include './head.php';
if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");
?>
<div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
<?php
$mod=isset($_GET['mod'])?$_GET['mod']:pay;
if($mod=='pay_n'){
	saveSetting('alipay_api',$_POST['alipay_api']);
	saveSetting('alipay_pid',$_POST['alipay_pid']);
	saveSetting('alipay_key',$_POST['alipay_key']);
	saveSetting('alipay_account',$_POST['alipay_account']);
	saveSetting('alipay2_api',$_POST['alipay2_api']);
	saveSetting('tenpay_api',$_POST['tenpay_api']);
	saveSetting('tenpay_pid',$_POST['tenpay_pid']);
	saveSetting('tenpay_key',$_POST['tenpay_key']);
	saveSetting('qqpay_api',$_POST['qqpay_api']);
	saveSetting('qqpay_pid',$_POST['qqpay_pid']);
	saveSetting('qqpay_key',$_POST['qqpay_key']);
	saveSetting('wxpay_api',$_POST['wxpay_api']);
	saveSetting('epay_pid',$_POST['epay_pid']);
	saveSetting('epay_key',$_POST['epay_key']);
	saveSetting('pay_api',$_POST['pay_api']);
	saveSetting('pay_other',$_POST['pay_other']);
	$ad=$CACHE->clear();
	if($ad)showmsg('修改成功！',1);
	else showmsg('修改失败！<br/>'.$DB->error(),4);
}elseif($mod=='pay'){
?>
<div class="block">
<div class="block-title"><h3 class="panel-title">商城支付接口设置</h3></div>
<div class="card-body">
  <form action="./payset.php?mod=pay_n" method="post" class="form-horizontal" role="form">
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay_api" default="<?php echo $conf['alipay_api']?>"><option value="0">关闭</option><option value="1">支付宝官方即时到账接口</option><option value="2">易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_01" style="<?php if($conf['alipay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">收款人支付宝账号</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_account" class="form-control"
				   value="<?php echo $conf['alipay_account']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">合作者身份(PID)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_pid" class="form-control" value="<?php echo $conf['alipay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">安全校验码(Key)</label>
		<div class="col-lg-8">
			<input type="text" name="alipay_key" class="form-control" value="<?php echo $conf['alipay_key']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">支付宝手机网站支付</label>
		<div class="col-lg-8">
			<select class="form-control" name="alipay2_api" default="<?php echo $conf['alipay2_api']?>"><option value="0">关闭</option><option value="1">支付宝官方手机网站支付接口</option></select>
			<pre id="payapi_02"  style="<?php if($conf['alipay2_api']!=1){?>display:none;<?php }?>">相关信息与以上支付宝即时到账接口一致，开启前请确保已开通支付宝手机支付，否则会导致手机用户无法支付！</pre>
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">财付通支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="tenpay_api" default="<?php echo $conf['tenpay_api']?>"><option value="0">关闭</option><option value="1">财付通官方即时到账接口</option><option value="2">易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_03" style="<?php if($conf['tenpay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通商户号</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_pid" class="form-control"
				   value="<?php echo $conf['tenpay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">财付通密钥</label>
		<div class="col-lg-8">
			<input type="text" name="tenpay_key" class="form-control" value="<?php echo $conf['tenpay_key']?>">
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="qqpay_api" default="<?php echo $conf['qqpay_api']?>"><option value="0">关闭</option><option value="1">QQ钱包官方即时到账接口</option><option value="2">易支付免签约接口</option></select>
		</div>
	</div>
	<div id="payapi_05" style="<?php if($conf['qqpay_api']!=1){?>display:none;<?php }?>">
	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包商户号</label>
		<div class="col-lg-8">
			<input type="text" name="qqpay_pid" class="form-control"
				   value="<?php echo $conf['qqpay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">QQ钱包密钥</label>
		<div class="col-lg-8">
			<input type="text" name="qqpay_key" class="form-control" value="<?php echo $conf['qqpay_key']?>">
		</div>
	</div>
	</div>

	<div class="form-group">
		<label class="col-lg-3 control-label">微信支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="wxpay_api" default="<?php echo $conf['wxpay_api']?>"><option value="0">关闭</option><option value="1">微信官方即时到账接口</option><option value="2">易支付免签约接口</option></select>
			<pre id="payapi_04"  style="<?php if($conf['wxpay_api']!=1){?>display:none;<?php }?>"><font color="green">*微信即时到账相关信息配置请修改includes/wxpay/WxPay.Config.php</font></pre>
		</div>
	</div>
	<?php if($conf['alipay_api']==2 || $conf['tenpay_api']==2 || $conf['tenpay_api']==2 || $conf['wxpay_api']==2){?>
<div class="form-group">
		<label class="col-lg-3 control-label">易支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="pay_other" default="<?php echo $conf['pay_other']?>">
				<option value="1">列表自选</option>
			    <option value="2">其它（手动输入）</option>
				</select>
		</div>
	</div>
	<?php if($conf['pay_other']==1){?>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付接口</label>
		<div class="col-lg-8">
			<select class="form-control" name="pay_api" default="<?php echo $conf['pay_api']?>">
				<option value="http://pay.ukyun.cn/">熙颜云支付</option>
			    <option value="http://pays.sddyun.cn/">ABC云支付</option>
			    <option value="http://pay.v8jisu.cn/">彩虹易支付</option>
				</select>
		</div></div>
					<?php }?>
	<?php if($conf['pay_other']==2){?>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付接口</label>
		<div class="col-lg-8">
			<input type="text" name="pay_api" class="form-control"
				   value="<?php echo $conf['pay_api']?>">
		</div></div>
			<?php }?>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付商户ID</label>
		<div class="col-lg-8">
			<input type="text" name="epay_pid" class="form-control"
				   value="<?php echo $conf['epay_pid']?>">
		</div>
	</div>
	<div class="form-group">
		<label class="col-lg-3 control-label">易支付商户密钥</label>
		<div class="col-lg-8">
			<input type="text" name="epay_key" class="form-control" value="<?php echo $conf['epay_key']?>">
					</div>
	</div>
		<div class="col-lg-8"><a href="payset.php?mod=epay">进入易支付结算设置及订单查询页面</a></div>
		<?php }?>
	<div class="form-group">
	  <div class="col-sm-offset-3 col-sm-8"><input type="submit" name="submit" value="修改" class="btn btn-primary form-control"/><br/>
	 </div>
	</div>
  </form>
</div>
</div>
<script>
$("select[name=\'alipay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_01").css("display","inherit");
	}else{
		$("#payapi_01").css("display","none");
	}
});
$("select[name=\'tenpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_03").css("display","inherit");
	}else{
		$("#payapi_03").css("display","none");
	}
});
$("select[name=\'wxpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_04").css("display","inherit");
	}else{
		$("#payapi_04").css("display","none");
	}
});
$("select[name=\'qqpay_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_05").css("display","inherit");
	}else{
		$("#payapi_05").css("display","none");
	}
});
$("select[name=\'alipay2_api\']").change(function(){
	if($(this).val() == 1){
		$("#payapi_02").css("display","inherit");
	}else{
		$("#payapi_02").css("display","none");
	}
});
</script>
<?php }?>
<script>
var items = $("select[default]");
for (i = 0; i < items.length; i++) {
	$(items[i]).val($(items[i]).attr("default"));
}
</script>
    </div>
  </div>