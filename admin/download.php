<?php

include("../includes/common.php");

if($islogin==1){}else exit("<script language='javascript'>window.location.href='./login.php';</script>");

$tid=intval($_GET['tid']);
$orderby=($_GET['orderby']==1)?"desc":"asc";

$date=date("Y-m-d");
$data='';

$rs=$DB->query("SELECT * FROM ukyun_orders WHERE tid='{$tid}' and status=0 order by addtime {$orderby} limit 1000");

while($row = $DB->fetch($rs))
{
	$data.=$row['qq'].'----'.$row['value']."\r\n";
	if($_GET['sign']==1)$DB->query("update `ukyun_orders` set status=1 where `id`='{$row['id']}'");
}

$file_name='output_'.$tid.'_'.$date.'__'.time().'.txt';
$file_size=strlen($data);
header("Content-Description: File Transfer");
header("Content-Type:application/force-download");
header("Content-Length: {$file_size}");
header("Content-Disposition:attachment; filename={$file_name}");
echo $data;
?>