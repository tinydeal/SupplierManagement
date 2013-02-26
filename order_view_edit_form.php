<?php
/*
 * @auther lion
 * @date 2013-2-4
 */
require_once 'class/supplier.class.php';
require_once 'class/supplier_service.class.php';
require_once 'class/order_goods.class.php';
require_once 'class/order_service.class.php';
require_once 'class/code_names.class.php';
$supplier_service=new SupplierService();
$array_supplier=$supplier_service->getAll();
$order = unserialize ( $_SESSION ['order'] );
$id = $order->id;
$order_number = $order->order_number;
$supplier_id = $order->supplier_id;
$status = $order->status;
$note = $order->note;
unset ( $_SESSION ["order"] );
$_SESSION ['id'] = $id;
$order_service=new OrderService();
$array_order_goods=$order_service->getGoodsByOrderId($id);

?>
<h3>修改采购单</h3>
<hr class="bs-docs-separator">
<div class="div-form ">
<form class="form-horizontal" action="./index.php?mod=order&action=edit_post" method="post"> 

       <div class="control-group">
    <label class="control-label" for="order_number">订单编号</label>
    <div class="controls">
      <input type="text" id="order_number" placeholder="" name="order_number" readonly/>
    </div>
    </div>
           <div class="control-group">
    <label class="control-label" for="supplier_id">供应商</label>
    <div class="controls">
    <input type="hidden" name="supplier_id" value="<?=$supplier_id?>">
      <select name="supplier_id" id="supplier_id" disabled>
      		<?php foreach ($array_supplier as $supplier){
      			$supplier_name=$supplier->supplier_name;
      			$id=$supplier->id;
      			echo "<option value='$id'>$supplier_name</option>";
      		}?>
      		
      </select>
    </div>
  </div>
  

      <div class="control-group">
    <label class="control-label" for="status" >订单状态</label>
    <div class="controls">
      <select name="status" id="status">
              <option value="<?php echo CodeNames::$order_status_pending_audit?>"><?php echo CodeNames::$order_status['order_status_pending_audit']?></option>
              <option value="<?php echo CodeNames::$order_status_audited?>"><?php echo CodeNames::$order_status['order_status_audited']?></option>
              <option value="<?php echo CodeNames::$order_status_procurement?>"><?php echo CodeNames::$order_status['order_status_procurement']?></option>
              <option value="<?php echo CodeNames::$order_status_completed?>"><?php echo CodeNames::$order_status['order_status_completed']?></option>
            </select>
    </div>
  </div> 
    
   <div class="control-group">
   <label class="control-label" for="note">备注</label>
    <div class="controls">
      <textarea type="text" id="note" placeholder="" name="note" ></textarea>
    </div>
  </div>
  <div class="control-group"> 
  <table class="table table-bordered table-striped  table-hover table-condensed" id="table" style="width: 30%; margin-left: 100px;">
  <thead >
    <tr><th style="width: 30%;">商品名称</th>
   		<th style="width: 30%;">商品编号</th>
		<th style="width: 10%;">商品数量</th>
		<th style="width: 30%;">是否缺货</th>
	</tr>
  </thead>
  <tbody>
  
  <?php 
  		 foreach ($array_order_goods as $order_goods){
    		echo "<tr> 
    		<td>
                	<input type='hidden'  id='goods_id' name='goods_id[]' value='$order_goods->goods_id'><a href='./index.php?mod=goods&action=detail&did=$order_goods->goods_id'>$order_goods->goods_name</a>
            </td>
    		<td>$order_goods->system_number</td>
    		<td><input class='input-small' type='text' name='goods_number[]' id='goods_number' value='$order_goods->goods_number' /></td>
			<td><input type='checkbox'  id='is_out_of_stock' name='is_out_of_stock[]'";
    		if($order_goods->is_out_of_stock) echo "checked='checked'";
    		echo "value='$order_goods->goods_id'></td>
      </tr>" ; };
  ?>

  
  </tbody>
  
  </table>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">修改</button>
      <a   class="btn" href="javascript:history.go(-1);">返回</a>
    </div>
  </div>
</form>
</div>  
<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation({
                        preventSubmit: true,
                        submitError: function($form, event, errors) {
                            // Here I do nothing, but you could do something like display 
                            // the error messages to the user, log, etc.
                        },
                        submitSuccess: function($form, event) {
                        },
                        filter: function() {
                            return $(this).is(":visible");
                        }
                    });
  
  $("#order_number").val("<?php echo $order_number?>");
  $("#supplier_id").val("<?php echo $supplier_id?>");
  $("#status").val("<?php echo $status?>");
  $("#note").val("<?php echo $note?>");
  $("#supplier_id").change(function(){
			return false;
	  });
                    
                     } );
  </script>
