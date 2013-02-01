<?php
/*
 * @auther lion	
 * @date 2013-2-1
 */
require_once 'class/goods_category.class.php';
require_once 'class/goods_category_service.class.php';
$goods_category_service=new GoodsCategoryService();
$array_goods_category=$goods_category_service->getAll();
?>
<h3>新增产品</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=goods&action=add_post" method="post">
  <div class="control-group">
    <label class="control-label" for="goods_name">产品名称</label>
    <div class="controls">
      <input type="text" id="goods_name" placeholder="" name="goods_name" required>
    </div>
  </div>
     <div class="control-group">
    <label class="control-label" for="goods_category_id">产品类型</label>
    <div class="controls">
      <select name="goods_category_id" id="goods_category_id">
      		<?php foreach ($array_goods_category as $goods_category){
      			$goods_category_name=$goods_category->goods_category_name;
      			$id=$goods_category->id;
      			echo "<option value='$id'>$goods_category_name</option>";
      		}?>
      		
      </select>
    </div>
  </div> 
   <div class="control-group">
   <label class="control-label" for="price">价格</label>
    <div class="controls">
      <input type="text" id="price" placeholder="" name="price" required>
    </div>
  </div>  
     <div class="control-group">
   <label class="control-label" for="size">规格</label>
    <div class="controls">
      <input type="text" id="size" placeholder="" name="size" >
    </div>
  </div>  
     <div class="control-group">
   <label class="control-label" for="color">颜色</label>
    <div class="controls">
      <input type="text" id="color" placeholder="" name="color" >
    </div>
  </div>
     <div class="control-group">
   <label class="control-label" for="description">描述</label>
    <div class="controls">
      <textarea type="text" id="description" placeholder="" name="description" ></textarea>
    </div>
  </div>  
     <div class="control-group">
   <label class="control-label" for="website">网页</label>
    <div class="controls">
      <input type="text" id="website" placeholder="" name="website" >
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
                    
                     } );
</script>