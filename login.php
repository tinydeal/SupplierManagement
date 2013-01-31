<?php
/*
 * @auther lion
 * @date 2013-1-31
 */
session_start();
if(isset($_COOKIE['username']) && isset($_COOKIE['pwd'])){
	$name=$_COOKIE['username'];
	$pwd=$_COOKIE['pwd'];
	echo $name.$pwd;
	if(!(empty($username)||empty($pwd))){
		require_once 'class/user.class.php';
	  	require_once 'class/user_service.class.php';	
		$user=new User(null,null,null,null,$username,$pwd,null,null,null,null);
		$user_service=new UserService();
		$rs=$user_service->validateUser($user);
	if($rs){
		$url="./index.php";
		$_SESSION['username']=$username;
		header("Location: $url");
	}
		
	}

}

if (isset ($_SESSION['username'])) {
	$url = "./index.php";
	header("Location: $url");
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Language" content="en" />
	<meta name="GENERATOR" content="PHPEclipse 1.2.0" />
	<title>title</title>
	<?php
		require_once './includes/css.php';
		require_once './includes/js.php';
	?> 
	<style type="text/css">
		body
		{
			margin:20px;
			padding:20px;
			
			
		}
</style>

</head>
<body>
<form class="form-horizontal"  action="index.php?mod=user&action=user_validate" method="post" id="form">
       <legend>用户登陆</legend>
 
 <?php
if (isset ($_SESSION['error'])) {
	echo "<div class='alert fade in alert-error'>
	        <button type='button' class='close' data-dismiss='alert' >&times;</button>
	        <strong>账号或密码错误</strong>
	        </div>";
	session_unset($_SESSION['error']);
} 
if (isset ($_SESSION['register'])) {
	echo "<div class='alert fade in alert-success'>
	        <button type='button' class='close' data-dismiss='alert' >&times;</button>
	        <strong>注册成功，请等待管理员审核</strong>
	        </div>";
	session_unset($_SESSION['register']);
}
if (isset ($_SESSION['image_code_error'])) {
	echo "<div class='alert fade in alert-error'>
	        <button type='button' class='close' data-dismiss='alert' >&times;</button>
	        <strong>验证码错误</strong>
	        </div>";
	session_unset($_SESSION['image_code_error']);
}
?>
  <div class="control-group" >
    <label class="control-label">用户名</label>
    <div class="controls" >
      <input type="text" id="username" name="username" required>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword" type="text" >密码</label>
    <div class="controls">
      <input type="password" id="pwd" placeholder="" name="pwd" required>
    </div>
  </div>
    <div class="control-group">
    <label class="control-label" for="input_image_code" type="text" >验证码</label>
    <div class="controls">
      <input type="text" id="input_image_code" placeholder="" name="input_image_code" required pattern="[a-zA-Z0-9_]{4}$" data-validation-pattern-message="验证码长度不对"> <img src="image.php"/>
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
<label class="checkbox">
      <input type="checkbox" name="auto_login">自动登陆
    </label>
    </div>
  </div>
    <div class="control-group">
    <div class="controls">

      <button type="submit" class="btn">登陆</button>
      <a class="btn btn-primary" href="./register.php">注册</a>
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
                 $(".close").click(function(){
                 	 $(".alert").alert('close');
                 });
                 
                 })
                     } ); 
                     
                     
                     
</script>
	
</body>
</html>