<?php
/*
 * @auther lion
 * @date 2013-1-31
 */
require_once 'class/personnel_category.class.php';
require_once 'class/personnel_category_service.class.php';
require_once 'class/user.class.php';
require_once 'class/user_service.class.php';
require_once 'class/code_names.class.php';
$personnel_category_service=new PersonnelCategoryService();
$array_personnel_category=$personnel_category_service->getAll();

$user=unserialize($_SESSION['user']);
$id=$user->id;
$name=$user->name;
$category_name_id=$user->category_name_id;
$username=$user->username;
$telephone=$user->telephone;
$email=$user->email;
$state=$user->state;

unset($_SESSION["user"]);
$_SESSION['id']=$id;
?>
<form class="form-horizontal"  action="./index.php?mod=user&action=edit_post" method="post" id="form">
       <legend>人员信息修改</legend>
  <div class="control-group" id="check_name" >
    <label class="control-label">用户名</label>
    <div class="controls" >
      <input type="text" id="username" name="username" readonly>
    </div>
  </div>

   <div class="control-group">
    <label class="control-label" for="name">姓名</label>
    <div class="controls">
      <input type="text" id="name" placeholder="" name="name"   readonly>
    </div>
  </div>
     <div class="control-group">
    <label class="control-label" for="category_name_id">人员类型</label>
    <div class="controls">
      <select name="category_name_id" id="category_name_id">
      		<?php foreach ($array_personnel_category as $personnel_category){
      			$personnel_category_name=$personnel_category->personnel_category_name;
      			$id=$personnel_category->id;
      			echo "<option value='$id'>$personnel_category_name</option>";
      		}?>
      		
      </select>
    </div>
  </div>
     <div class="control-group">
    <label class="control-label" for="telephone">电话</label>
    <div class="controls">
      <input type="text" id="telephone" placeholder="" name="telephone"  required>
    </div>
  </div>
  
       <div class="control-group">
    <label class="control-label" for="email">邮箱</label>
    <div class="controls">
      <input type="text" id="email" placeholder="" name="email" pattern="\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*" data-validation-pattern-message="请输入正确的邮箱"  required>
    </div>
  </div>
       <div class="control-group">
    <label class="control-label" for="state">状态</label>
    <div class="controls">
      <select name="state" id="state">
			<option value="<?php echo CodeNames::$user_state_disable?>"><?php echo CodeNames::$user_state['user_state_disable']?></option>
			<option value="<?php echo CodeNames::$user_state_normal?>"><?php echo CodeNames::$user_state['user_state_normal']?></option>
      </select>
    </div>
  </div>
  
         <div class="control-group">
    <label class="control-label" for="note">备注</label>
    <div class="controls">
      <textarea type="text" id=""note"" placeholder="" name="note"></textarea>
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">

      <button type="submit" class="btn btn-primary">修改</button>
      <a   class="btn" href="javascript:history.go(-1);">返回</a>
    </div>
  </div>
</form>
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
  $("#name").val('<?php echo $name?>');  
  $("#username").val("<?php echo $username?>"); 
  $("#category_name_id").val('<?php echo $category_name_id?>'); 
  $("#email").val('<?php echo $email?>');
  $("#telephone").val('<?php echo $telephone?>'); 
  $("#state").val('<?php echo $state?>'); 

					}); 
</script>