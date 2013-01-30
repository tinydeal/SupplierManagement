<?php
/*
 * @auther lion
 * @date 2013-1-28
 */
require_once 'class/personnel_category_service.class.php';
require_once 'class/personnel_category.class.php';
require_once 'class/sub_pages.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=4;   	
$personnel_category_service=new PersonnelCategoryService();
//总条目数 
$nums=$personnel_category_service->getListRows();
//每次显示的页数  
$sub_pages=2;  
$array_personnel_category=$personnel_category_service->listAll($pageCurrent,$page_size);
?>


<div class="search-form">
<form class="form-inline" action="./index.php?mod=personnel_category&action=ls" method="get">
  <input type="text" class="search-query">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">人员分类管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=personnel_category&action=add_get' style="float: right;">新增人员分类</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>分类名称</th>
        <th>权限</th>
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_personnel_category as $personnel_category){
    	echo "<tr> 
    	<td>$personnel_category->personnel_category_name</td>  
        <td>$personnel_category->permission_name</td>
       <td><a class='btn btn-primary' href='./index.php?mod=personnel_category&action=edit_get&eid=".$personnel_category->id."'>修改</a></td>
      </tr>";
    }
    
    
    ?>
      
    </tbody>
  </table>
  <?php    
	  $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,"index.php?mod=personnel_category&action=ls&p=");
  ?>
</div>
