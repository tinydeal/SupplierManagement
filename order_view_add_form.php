<?php
/*
 * @auther lion
 * @date 2013-2-4
 */
require_once 'class/supplier.class.php';
require_once 'class/supplier_service.class.php';
require_once 'class/goods.class.php';
require_once 'class/goods_service.class.php';
$supplier_service=new SupplierService();
$array_supplier=$supplier_service->getAll();
if(isset($_GET["supplier_id"])){
	$supplier_id=$_GET["supplier_id"];
}else{
	$supplier_id=$array_supplier[0]->id;
}
$goods_service=new GoodsService();
$array_goods=$goods_service->getGoodsBySupplierId($supplier_id);
 
?>
<h3>新增采购单</h3>
<hr class="bs-docs-separator">
<div class="div-form ">
<form class="form-horizontal" action="./index.php?mod=order&action=add_post" method="post">

       <div class="control-group">
    <label class="control-label" for="supplier_id">供应商</label>
    <div class="controls">
      <select name="supplier_id" id="supplier_id">
      		<?php foreach ($array_supplier as $supplier){
      			$supplier_name=$supplier->supplier_name;
      			$id=$supplier->id;
      			echo "<option value='$id'>$supplier_name</option>";
      		}?>
      		
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
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-primary">添加</button>
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
  $("#supplier_id").val(<?=$supplier_id?>);
  $("#supplier_id").change(function(){
			window.location.href="index.php?mod=order&action=add_get&supplier_id="+$("#supplier_id").val();
	  });
                    
                     } );
  </script>