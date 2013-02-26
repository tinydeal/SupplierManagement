<?php
/*
 * @auther lion
 * @date 2013-1-31
 */
require_once 'class/personnel_category.class.php';
require_once 'class/personnel_category_service.class.php';
$personnel_category_service=new PersonnelCategoryService();
$array_personnel_category=$personnel_category_service->getAll();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />
	<meta name="GENERATOR" content="PHPEclipse 1.2.0" />
	<?php
		require_once './includes/css.php';
		require_once './includes/js.php';
	?> 
	<title>title</title>
</head>
<body>

<form class="form-horizontal"  action="./index.php?mod=user&action=user_register" method="post" id="form">
       <legend>用户注册</legend>

  <div class="control-group" id="check_name" >
    <label class="control-label">用户名</label>
    <div class="controls" >
      <input type="text" id="username" name="username" required pattern="^[a-zA-Z][a-zA-Z0-9_]{4,15}$" data-validation-pattern-message="字母开头，允许5-16字节，允许字母数字下划线">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">密码</label>
    <div class="controls">
      <input type="password" id="pwd" placeholder="" name="pwd" required pattern="[a-zA-Z0-9_]{5,15}$" data-validation-pattern-message="密码长度六位以上">
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="inputPassword">确认密码</label>
    <div class="controls">
      <input type="password" id="rppwd" placeholder="" name="rppwd" data-validation-matches-match="pwd" data-validation-matches-message=
    "两次密码必须一致"  required>
    </div>
  </div>
   <div class="control-group">
    <label class="control-label" for="name">姓名</label>
    <div class="controls">
      <input type="text" id="name" placeholder="" name="name"   required>
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
    <div class="controls">

      <button type="submit" class="btn btn-primary">提交</button>
      <a class="btn" href="javascript:history.go(-1);">返回</a>
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
                    
                    $("#username").blur(function(){
                    var username= $.trim($("#username").val());
                    
                     $.get("./check_username.php",{username:username},function(response){
                         if(!response.status){
                          $("#check_name .help-block").text("用户名已被使用");
                          $("#check_name").toggleClass("error");
                         }else{
                             $("#check_name .help-block").text("用户名可以使用");
                             $("#check_name").toggleClass("success"); 
                         }
                     },"json");
					}) 
                     } );
</script>

</body>
</html>