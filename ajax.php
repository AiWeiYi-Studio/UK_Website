<?php
include("./includes/common.php");
$act=isset($_GET['act'])?daddslashes($_GET['act']):null;

@header('Content-Type: application/json; charset=UTF-8');

switch($act){
case 'pay':
	$tid=intval($_POST['tid']);
	$qq=daddslashes($_POST['qq']);
	$tool=$DB->get_row("select * from ukyun_shops where tid='$tid' limit 1");
	if($tool && $tool['active']==1){
		$thtime=date("Y-m-d").' 00:00:00';
		$row=$DB->get_row("select * from ukyun_orders where tid='$tid' and qq='$qq' order by id desc limit 1");
		if($row['qq'] && $row['status']==0)
			exit('{"code":-1,"msg":"您今天添加的'.$tool['name'].'在此之前购买的订单未完成，请勿重复提交！"}');
		elseif($row['addtime']>$thtime)
			exit('{"code":-1,"msg":"您今天已添加过'.$tool['name'].'在此之前购买的订单未完成，请勿重复提交！"}');
		else
		{
			$need=$tool['price'];
			$trade_no=date("YmdHis").rand(111,999);
			$sql="insert into `ukyun_pay` (`trade_no`,`tid`,`qq`,`name`,`money`,`addtime`,`status`) values ('".$trade_no."','".$tid."','".$qq."','".$tool['name']."','".$need."','".$date."','0')";
			if($DB->query($sql)){
				exit('{"code":0,"msg":"提交订单成功！","trade_no":"'.$trade_no.'","need":"'.$need.'"}');
			}else{
				exit('{"code":-1,"msg":"提交订单失败！'.$DB->error().'"}');
			}
		}
	}else{
		exit('{"code":-2,"msg":"该商品不存在"}');
	}
break;
case 'card':
	$qq=daddslashes($_POST['qq']);
	$km=daddslashes($_POST['km']);
	$myrow=$DB->get_row("select * from ukyun_kms where km='$km' limit 1");
	if(!$myrow)
	{
		exit('{"code":-1,"msg":"此卡密不存在！"}');
	}
	elseif($myrow['user']!=0){
		exit('{"code":-1,"msg":"此卡密已被使用！"}');
	}
	else
	{
		$tid=$myrow['tid'];
		$tool=$DB->get_row("select * from ukyun_shops where tid='$tid' limit 1");
		if($tool && $tool['active']==1){
			$thtime=date("Y-m-d").' 00:00:00';
			$row=$DB->get_row("select * from ukyun_orders where tid='$tid' and qq='$qq' order by id desc limit 1");
			if($row['qq'] && $row['status']==0)
				exit('{"code":-1,"msg":"您今天添加的'.$tool['name'].'在此之前购买的订单未完成，请勿重复提交！"}');
			elseif($row['addtime']>$thtime)
				exit('{"code":-1,"msg":"您今天已添加过'.$tool['name'].'在此之前购买的订单未完成，请勿重复提交！"}');
			else
			{
				$value=$myrow['value']?$myrow['value']:'1000';
				$sql="insert into `ukyun_orders` (`tid`,`qq`,`value`,`addtime`,`status`) values ('".$tid."','".$qq."','".$value."','".$date."','0')";
				if($DB->query($sql)){
					$DB->query("update `ukyun_kms` set `user` ='$qq',`usetime` ='".$date."' where `kid`='{$myrow['kid']}'");
					exit('{"code":0,"msg":"'.$tool['name'].' 下单成功！你可以在进度查询中查看订单进度"}');
				}else{
					exit('{"code":-1,"msg":"'.$tool['name'].' 下单失败！'.$DB->error().'"}');
				}
			}
		}else{
			exit('{"code":-2,"msg":"该商品不存在"}');
		}
	}
break;
case 'query':
	$qq=daddslashes($_POST['qq']);
	$limit=isset($_POST['limit'])?intval($_POST['limit']):10;
	$rs=$DB->query("SELECT * FROM ukyun_shops WHERE active=1 order by sort asc");
	while($res = $DB->fetch($rs)){
		$ukyun_func[$res['tid']]=$res['name'];
	}
	$rs=$DB->query("SELECT * FROM ukyun_orders WHERE qq='{$qq}' order by id desc limit $limit");
	while($res = $DB->fetch($rs)){
		$data[]=array('id'=>$res['id'],'tid'=>$res['tid'],'qq'=>$res['qq'],'name'=>$ukyun_func[$res['tid']],'addtime'=>$res['addtime'],'endtime'=>$res['endtime'],'status'=>$res['status']);
	}
	$result=array("code"=>0,"msg"=>"succ","data"=>$data);
	exit(json_encode($result));
break;
default:
	exit('{"code":-4,"msg":"No Act"}');
break;
}