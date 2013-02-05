<?php
/*
 * @auther udzhou
 * @date 2013 2-4
 */
require_once './class/database.class.php';
date_default_timezone_set('PRC');
$current_time=date('Y-m-d H:i:s');
$goods_id = stripslashes(trim($_POST['goods_id']));
$time_range = stripslashes(trim($_POST['time_range']));
$history_time=date('Y-m-d H:i:s',strtotime('-$time_range day'));
$g_db=Database::getInstance();
$PageSize=$g_db->getRows("select count(*) from t_price_change where goods_id=".$goods_id);
$sql="select price,modified from t_price_change where goods_id=".$goods_id." and modified between '".$history_time."' and '".$current_time."' order by modified";
$array_price_change=$g_db->getAll($sql,1,$PageSize);
//$arr['success'] = 1;
echo json_encode($array_price_change);
?>