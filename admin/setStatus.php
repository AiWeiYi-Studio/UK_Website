<?php
/**
 * 设置补领状态
**/
include("../includes/common.php");
if($islogin==1){}else exit('{"code":301,"msg":"未登录"}');

$id=intval($_GET['name']);
$status=intval($_GET['status']);
if($status==4){
	if($DB->query("DELETE FROM ukyun_orders WHERE id='$id'"))
		exit('{"code":200}');
	else
		exit('{"code":400,"msg":"删除订单失败！'.$DB->error().'"}');
}else{
	if($DB->query("update ukyun_orders set status='$status' where id='{$id}'"))
		exit('{"code":200}');
	else
		exit('{"code":400,"msg":"修改订单失败！'.$DB->error().'"}');
}