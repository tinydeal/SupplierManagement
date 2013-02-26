<?php
/*
 * @auther udzhou	
 * @date 2013-1-31
 */
$supplier_category=unserialize($_SESSION['supplier_category']);
$id=$supplier_category->id;
$supplier_category_name=$supplier_category->supplier_category_name;
unset($_SESSION["supplier_category"]);
$_SESSION['id']=$id; 
?>
<h3>修改供应商类别</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=supplier_category&action=edit_post" method="post">
  <div class="control-group">
    <label class="control-label" for="supplier_category_name">供应商类别名称</label>
    <div class="controls">
      <input type="text" id="supplier_category_name" placeholder="" name="supplier_category_name" required>
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
  				    $('#supplier_category_name').val("<?php echo $supplier_category_name?>");              
                    
              });
</script>