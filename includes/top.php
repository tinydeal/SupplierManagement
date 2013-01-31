<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
?>

<div id="navbar" class="navbar navbar-inverse  navbar-static">
<div class="navbar-inner">
<div class="container" style="width: auto;"><a class="brand" href="#">供应商管理系统</a>

<ul class="nav pull-right">
	<li id="fat-menu" class="dropdown"><a href="#" class="dropdown-toggle"
		data-toggle="dropdown"><?= $_SESSION["username"]?><b class="caret"></b></a>
	<ul class="dropdown-menu">
		<li><a href="#">个人信息</a></li>
		<li><a href="#">修改密码</a></li>
		<li class="divider"></li>
		<li><a href="#">退出</a></li>
	</ul>
	</li>
</ul>
</div>
</div>
</div>
