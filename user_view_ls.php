<?php
/*
 * @auther lion
 * @date 2013-1-28
 */
require_once 'class/user_service.class.php';
require_once 'class/user.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$user_service=new UserService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=user&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=$_GET["keywords"];
		$array_user=$user_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
		$nums=$user_service->getListRowsByKeywords($keywords);
		if(!empty($keywords)){
			$url="index.php?mod=user&action=ls&keywords=$keywords&p=";
		}
}else{
$array_user=$user_service->listAll($pageCurrent,$page_size);
$nums=$user_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="user">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">人员分类管理</a>
   
  </li>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>用户名</th>
        <th>类型</th>
        <th>姓名</th>
        <th>电话</th>
        <th>邮箱</th>
        <th>状态</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_user as $user){
    	echo "<tr> 
    	<td><a href='./index.php?mod=user&action=detail&did=$user->id'>$user->username</a></td>
        <td>$user->category_name</td>
        <td>$user->name</td>
        <td>$user->telephone</td>
        <td>$user->email</td>
        <td>".CodeNames::$user_state[$user->state]."</td>
       <td><a class='btn btn-primary' href='./index.php?mod=user&action=edit_get&eid=".$user->id."'>修改</a></td>
      </tr>";
    }
    ?>
      
    </tbody>
  </table>
  <?php
	  $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$url);
  ?>
</div>

<script>
  $(function () {
  				$('#keywords').val("<?=$_GET["keywords"]?>");
                } );
</script>