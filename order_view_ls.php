<?php
/*
 * @auther lion
 * @date 2013-2-4
 */

require_once 'class/order_service.class.php';
require_once 'class/order.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$order_service=new OrderService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=order&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=trim($_GET["keywords"]);
		if(!empty($keywords)){
		$array_order=$order_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
		$nums=$order_service->getListRowsByKeywords($keywords);
		$url="index.php?mod=order&action=ls&keywords=$keywords&p=";
		}else{
			$array_order=$order_service->listAll($pageCurrent,$page_size);
			$nums=$order_service->getListRows();
		}
}else{
$array_order=$order_service->listAll($pageCurrent,$page_size);
$nums=$order_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="order">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">产品管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=order&action=add_get' style="float: right;">新增采购单</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>订单 编号</th> 
        <th>供应商</th> 
        <th>订单状态</th> 
        <th>操作</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_order as $order){
    	echo "<tr> 
    	<td><a href='./index.php?mod=order&action=detail&did=$order->id'>$order->order_number</td>
    	<td>$order->supplier_name</td>
    	<td>".CodeNames::$order_status[$order->status]."</td>
       <td><a class='btn btn-primary' href='./index.php?mod=order&action=edit_get&eid=".$order->id."'>修改</a></td>
      </tr>";
    }
    
    
    ?>
      
    </tbody>
  </table>
  <?php
	  $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$url);
  ?>
</div>

<script>
  $(function () {
  				$('#keywords').val("<?=$keywords?>");
                     } );
</script>