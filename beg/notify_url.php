<?php
include("../includes/common.php");
require_once("./lib/notify.class.php");
$alipayNotify = new AlipayNotify($alipay_config);
$verify_result = $alipayNotify->verifyNotify();
if($verify_result) {
	$out_trade_no = $_GET['out_trade_no'];
	$trade_no = $_GET['trade_no'];
	$trade_status = $_GET['trade_status'];
	$type = $_GET['type'];
	if ($_GET['trade_status'] == 'TRADE_SUCCESS') {
	echo "success";	
}
else {
echo "fail";
}
?>