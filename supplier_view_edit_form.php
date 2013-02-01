<?php
/*
 * @auther udzhou	
 * @date 2013-2-1
 */
require_once 'class/supplier_category_service.class.php';
$pageCurrent=1;
$supplier_category_service=new SupplierCategoryService();
$nums=$supplier_category_service->getListRows();   
$array_supplier_category=$supplier_category_service->listAll($pageCurrent,$nums);

$supplier=unserialize($_SESSION['supplier']);
$id=$supplier->id;
$supplier_name=$supplier->supplier_name;
$supplier_category_id=$supplier->supplier_category_id;
$supplier_category_name=$supplier->supplier_category_name;
$wholesale_num_min=$supplier->wholesale_num_min;
$wholesale_num_max=$supplier->wholesale_num_max;
$goods_style=$supplier->goods_style;
$goods_category=$supplier->goods_category;
$is_provide_pictures=$supplier->is_provide_pictures;
$website=$supplier->website;
$linkman=$supplier->linkman;
$telephone=$supplier->telephone;
$province=$supplier->province;
$city=$supplier->city;
$village=$supplier->village;
$address_detial=$supplier->address_detial;
$note=$supplier->note;
unset($_SESSION["supplier"]);
$_SESSION['id']=$id; 
?>
<h3>修改供应商信息</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=supplier&action=edit_post" method="post">
  <div class="control-group">
    <label class="control-label" for="supplier_name">供应商名称</label>
    <div class="controls">
      <input type="text" id="supplier_name" placeholder="" name="supplier_name" required>
    </div>

    <label class="control-label" for="supplier_category_id">供应商类别</label>
    <div class="controls">
      <select name="supplier_category_id" id="supplier_category_id">
      <?php 
        foreach ($array_supplier_category as $supplier_category){      
        echo "
        <option value='$supplier_category->id'>$supplier_category->supplier_category_name</option> ";
        }       
      ?>          
        </select>
    </div>

     <label class="control-label" for="wholesale_num_min">批发最小数量</label>
    <div class="controls">
      <input type="text" id="wholesale_num_min" placeholder="" name="wholesale_num_min" required>
    </div>
     <label class="control-label" for="wholesale_num_max">批发最大数量</label>
    <div class="controls">
      <input type="text" id="wholesale_num_max" placeholder="" name="wholesale_num_max" required>
    </div>
    <label class="control-label" for="goods_style">产品风格</label>
    <div class="controls">
      <input type="text" id="goods_style" placeholder="欧美" name="goods_style" required>
    </div>
     <label class="control-label" for="goods_category">产品属类</label>
    <div class="controls">
      <input type="text" id="goods_category_name" placeholder="批发" name="goods_category" required>
    </div>
    
     <label class="control-label" for="is_provide_pictures">是否提供图片</label>
    <div class="controls">
     <label class="radio">
      <input type="radio" name="is_provide_pictures" id="is_provide_pictures1" value="1">是  
     </label>
     <label class="radio">
      <input type="radio" name="is_provide_pictures" id="is_provide_pictures0" value="0">否  
     </label>
    </div>

     <label class="control-label" for="website">网址</label>
    <div class="controls">
      <input type="text" id="website" placeholder="http://" name="website" required>
    </div>
    <label class="control-label" for="linkman">联系人</label>
    <div class="controls">
      <input type="text" id="linkman" placeholder="" name="linkman" required>
    </div>
     <label class="control-label" for="telephone">手机</label>
    <div class="controls">
      <input type="text" id="telephone" placeholder="" name="telephone" required>
    </div>

    <label class="control-label" for="address_detial" >地址</label>
    <div class="controls">
      <select name="province" id="province">
              <option value="广东省">广东省</option>
              <option value="江苏省">江苏省</option>
              <option value="湖北省">湖北省</option>
              <option value="">无</option>
      </select> 
      <select name="city" id="city">             
              <option value="深圳市">深圳市</option>
              <option value="广州市">广州市</option>
              <option value="东莞市">东莞市</option>
              <option value="">无</option>
      </select>
      <select name="village" id="village">             
              <option value="南山区">南山区</option>
              <option value="福田区">福田区</option>
              <option value="宝安区">宝安区</option>
              <option value="">无</option>
      </select>
      <input type="text" id="address_detial" placeholder="具体地址" name="address_detial" required>  
    </div> 

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
  				    $('#supplier_name').val("<?=$supplier_name?>");              
              $('#supplier_category_name').val("<?=$supplier_category_name?>");
              $('#wholesale_num_min').val("<?=$wholesale_num_min?>"); 
              $('#wholesale_num_max').val("<?=$wholesale_num_max?>"); 
              $('#goods_style').val("<?=$goods_style?>");   
              $('#goods_category_name').val("<?=$goods_category?>"); 
              if(<?=$is_provide_pictures?>){
                 $('#is_provide_pictures1').attr("checked",true);
              }else{
                $('#is_provide_pictures0').attr("checked",true);
              } 
              $('#website').val("<?=$website?>");              
              $('#linkman').val("<?=$linkman?>"); 
              $('#telephone').val("<?=$telephone?>"); 
              $('#province').val("<?=$province?>");       
              $('#city').val("<?=$city?>"); 
              $('#village').val("<?=$village?>"); 
              $('#address_detial').val("<?=$address_detial?>");  
              $('#note').val("<?=$note?>");   
              });
</script>