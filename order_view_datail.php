<?php
/*
 * @auther lion
 * @date 2013-2-5
 */
require_once 'class/supplier.class.php';
require_once 'class/supplier_service.class.php';
require_once 'class/order_goods.class.php';
require_once 'class/order_service.class.php';
require_once 'class/code_names.class.php';





$supplier_service=new SupplierService();
$order = unserialize ( $_SESSION ['order'] );
$id = $order->id;
$order_number = $order->order_number;
$supplier_id = $order->supplier_id;
$supplier=$supplier_service->getSupplierById($supplier_id);
$supplier_name=$supplier->supplier_name;
$status = $order->status;
$note = $order->note;
unset ( $_SESSION ["order"] );
$_SESSION ['id'] = $id;
$order_service=new OrderService();
$array_order_goods=$order_service->getGoodsByOrderId($id);
?>
<div class="span12" style="margin-left: auto;margin-right: auto;">
<h3 style="float:left">采购单信息</h3>
<div style="float:right;margin-top:12px">
<a class='btn btn-primary' href='./index.php?mod=order&action=edit_get&eid=<?php echo $id?>'>修改</a>
<a class="btn" href="javascript:history.go(-1);">返回</a>
</div>
<table class="table table-bordered table-hover ">
<thead >
<tr><th colspan="4">基本信息</th>

</tr>
</thead>

<tr>
<td >采购单号</td><td ><?php echo $order_number?></td>
<td >供应商名称</td><td ><?php echo $supplier_name?></td>
</tr>

<tr >
<td >订单状态</td><td  colspan="3"><?php echo CodeNames::$order_status[$status]?></td>
</tr>
<tr >
<td >备注</td><td  colspan="3"><?php echo $note?></td>
</tr>

</table>
</div>

<?php

require_once 'class/sub_pages.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url=sprintf("index.php?mod=order&action=detail&did=%d&p=",$id);
$array_order_goods=$order_service->getGoodsByOrderIdSubPage($pageCurrent,$page_size,$id);
$nums=$order_service->getGoodsByOrderIdCount($id);

?>
<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">采购单商品信息</a>
   
  </li>
  <a href="#addGoods" role="button" class='btn btn-primary' data-toggle="modal" style="float: right;">添加采购单产品</a>
</ul>
  <table class="table table-bordered table-striped  table-hover table-condensed" >
  <thead >
    <tr><th  >商品名称</th>
   		<th  >商品编号</th>
		<th  >商品数量</th>
		<th  >是否缺货</th>
	</tr>
  </thead>
  <tbody>
  
  <?php 
  		 foreach ($array_order_goods as $order_goods){
  		 	$is_out_of_stock_name;
			if($order_goods->is_out_of_stock){
				$is_out_of_stock_name='是';
			}else{
				$is_out_of_stock_name='否';
}
    		echo "<tr> 
    		<td>
                <a href='./index.php?mod=goods&action=detail&did=$order_goods->goods_id'>$order_goods->goods_name</a>
            </td>
    		<td>$order_goods->system_number</td>
    		<td>$order_goods->goods_number</td>
    		<td>$is_out_of_stock_name</td>
      </tr>" ; };
  ?>

  
  </tbody>
  </table>
  <?php
	  $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$url);
	  
	  require_once 'class/goods.class.php';
	  require_once 'class/goods_service.class.php';
	  $goods_service=new GoodsService();
	  $array_goods=$goods_service->getGoodsBySupplierIdNotInOrder($supplier_id, $id);
	  
  ?>
<!-- Modal -->
<div id="addGoods" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">添加供应商产品</h3>
  </div>
  <div class="modal-body">
   <form class="form-horizontal" action="./index.php?mod=order&action=detail_post&did=<?=$id?>" method="post">
  <div class="control-group">
 	 <input name="order_id" type="hidden" value="<?=$id?>">
     <table class="table table-bordered table-striped  table-hover table-condensed" id="table" >
  <thead >
    <tr><th  >商品名称</th>
   		<th  >商品编号</th>
		<th  >商品数量</th>
	</tr>
  </thead>
  <tbody>
  
  <?php 
  		 foreach ($array_goods as $goods){
    		echo "<tr> 
    		<td>
             		 <label  class='checkbox'>
                	 <input type='checkbox'  id='goods_id' name='goods_id[]' value='$goods->id'><a href='./index.php?mod=goods&action=detail&did=$goods->id'>$goods->goods_name</a>
              </label>
            </td>
    		<td>$goods->system_number</td>
    		<td><input class='input-small' type='text' name='goods_number[]' id='goods_number' /></td>
      </tr>" ; };
  ?>

  
  </tbody>
  </table>
  <input style="display:none" id="submit"  type="submit" class="btn btn-primary" />
  </div>  
</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    <button id="save" class="btn btn-primary" data-dismiss="modal">保存</button>   
  </div>
</div>
 <script type="text/javascript">    
    $('#save').click(function(){
      $('#submit').click();       
    });           
</script>    