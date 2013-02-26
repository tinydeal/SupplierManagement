<?php
/*
 * @auther lion	
 * @date 2013-1-28
 */
require_once 'class/code_names.class.php';
$personnel_category=unserialize($_SESSION['personnel_category']);
$id=$personnel_category->id;
$personnel_category_name=$personnel_category->personnel_category_name; 
$permission_name=$personnel_category->permission_name;
unset($_SESSION["personnel_category"]);
$_SESSION['id']=$id; 
?>
<h3>修改人员类别</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=personnel_category&action=edit_post" method="post">
  <div class="control-group">
    <label class="control-label" for="personnel_category_name">人员类别名称</label>
    <div class="controls">
      <input type="text" id="personnel_category_name" placeholder="" name="personnel_category_name" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="permission_name" >权限</label>
    <div class="controls">
      <select name="permission_name" id="permission_name">
              <option value="<?php echo CodeNames::$permission_name_procurement?>">采购</option>
              <option value="<?php echo CodeNames::$permission_name_order?>">产品下单</option>
              <option value="<?php echo CodeNames::$permission_name_administrator?>">管理员</option>
            </select>
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
  				$('#personnel_category_name').val("<?php echo $personnel_category_name?>");
                $('#permission_name').val("<?php echo $permission_name?>");
                    
                     } );
</script>