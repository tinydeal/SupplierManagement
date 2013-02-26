<?php
/*
 * @auther lion
 * @date 2013-2-1
 */
if(isset($_SESSION["logined_user"])){
	$logined_user=unserialize($_SESSION["logined_user"]);
	$id=$logined_user->id;
	$username=$logined_user->username;
}else {
	header("Location: ./login.php");
}
?>

<form class="form-horizontal"  action="./index.php?mod=user&action=pwd_change_post" method="post" id="form">
       <legend>修改密码</legend>
  <div class="control-group" id="check_name" >
    <label class="control-label">用户名</label>
    <div class="controls" >
      <input type="text" id="username" name="username" readonly>
    </div>
  </div>
  
   <div class="control-group">
    <label class="control-label" for="inputPassword">密码</label>
    <div class="controls">
      <input type="password" id="pwd" placeholder="" name="pwd" required>
    </div>
  </div>
  
  
    <div class="control-group">
    <label class="control-label" for="inputPassword">新密码</label>
    <div class="controls">
      <input type="password" id="new_pwd" placeholder="" name="new_pwd" required pattern="[a-zA-Z0-9_]{5,15}$" data-validation-pattern-message="密码长度六位以上">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">确认密码</label>
    <div class="controls">
      <input type="password" id="rppwd" placeholder="" name="rppwd" data-validation-matches-match="new_pwd" data-validation-matches-message=
    "两次密码必须一致"  required>
    </div>
  </div>


  
  <div class="control-group">
    <div class="controls">

      <button type="submit" class="btn btn-primary">提交</button>
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
  $("#username").val("<?php echo $username?>"); 

					}); 
</script>