<?php
/*
 * @auther lion	
 * @date 2013-2-1
 */
$goods_category=unserialize($_SESSION['goods_category']);
$id=$goods_category->id;
$goods_category_name=$goods_category->goods_category_name; 
unset($_SESSION["goods_category"]);
$_SESSION['id']=$id;

?>
<h3>修改产品类别</h3>
<hr class="bs-docs-separator">
<div class="div-form">
<form class="form-horizontal" action="./index.php?mod=goods_category&action=edit_post" method="post">
  <div class="control-group">
    <label class="control-label" for="goods_category_name">产品类别名称</label>
    <div class="controls">
      <input type="text" id="goods_category_name" placeholder="" name="goods_category_name" required>
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
  				$('#goods_category_name').val("<?=$goods_category_name?>");
                    
                     } );
</script>