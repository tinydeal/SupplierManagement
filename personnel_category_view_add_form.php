<?php
/*
 * @auther lion
 * @date 2013-1-28
 */
require_once 'class/code_names.class.php';

?>
<h3>新增人员类别</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=personnel_category&action=add_post" method="post">
  <div class="control-group">
    <label class="control-label" for="personnel_category_name">人员类别名称</label>
    <div class="controls">
      <input type="text" id="personnel_category_name" placeholder="" name="personnel_category_name" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="permission_name" >权限</label>
    <div class="controls">
      <select name="permission_name">
              <option value="<?php echo CodeNames::$permission_name_procurement?>"><?php echo CodeNames::$permission_name['permission_name_procurement']?></option>
              <option value="<?php echo CodeNames::$permission_name_order?>"><?php echo CodeNames::$permission_name['permission_name_order']?></option>
              <option value="<?php echo CodeNames::$permission_name_administrator?>"><?php echo CodeNames::$permission_name['permission_name_administrator']?></option>
            </select>
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