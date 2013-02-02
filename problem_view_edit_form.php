<?php
/*
 * @auther lion
 * @date 2013-2-2
 */
require_once 'class/supplier.class.php';
require_once 'class/supplier_service.class.php';
$supplier_service=new SupplierService();
$array_supplier=$supplier_service->getAll();
$problem = unserialize ( $_SESSION ['problem'] );
$id = $problem->id;
$problem_name_category = $problem->problem_name_category;
$supplier_id = $problem->supplier_id;
$description=$problem->description;
$note = $problem->note;
unset ( $_SESSION ["problem"] );
$_SESSION ['id'] = $id;
?>
<h3>修改合作问题记录</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=problem&action=add_post" method="post">
     <div class="control-group">
    <label class="control-label" for="problem_name_category">合作问题类型</label>
    <div class="controls">
      <select name="problem_name_category" id="problem_name_category" class="input-xlarge">
 			<option value="给样期限、给样是否及时">给样期限、给样是否及时问题</option>
 			<option value="给样与大货是否一致问题">给样与大货是否一致问题</option>
 			<option value="下单问题">下单问题</option>
 			<option value="服务态度问题">服务态度问题</option>
 			<option value="收货验收问题">收货验收问题</option>
 			<option value="发货速度、正确发货率及售后问题">发货速度、正确发货率及售后问题</option>
 			<option value="其他">其他</option>
      		
      </select>
    </div>
  </div> 
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
   <label class="control-label" for="description">问题描述</label>
    <div class="controls">
      <textarea type="text" id="description" placeholder="" name="description" required></textarea>
    </div>
  </div>  
   <div class="control-group">
   <label class="control-label" for="note">备注</label>
    <div class="controls">
      <textarea type="text" id="note" placeholder="" name="note" ></textarea>
    </div>
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
  $("#problem_name_category").val("<?=$problem_name_category?>");
  $("#supplier_id").val("<?=$supplier_id?>");    
  $("#description").val("<?=$description?>");    
  $("#note").val("<?=$note?>");     
                     } );
</script>