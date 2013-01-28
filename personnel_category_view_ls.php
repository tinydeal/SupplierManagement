<?php
/*
 * @auther lion
 * @date 2013-1-28
 */
require_once 'class/personnel_category_service.class.php';
require_once 'class/personnel_category.class.php';
$personnel_category_service=new PersonnelCategoryService();
$array_personnel_category=$personnel_category_service->listAll();
?>


<div class="search-form">
<form class="form-inline" >
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
    	<td>$personnel_category->category_name</td> 
        <td>$personnel_category->permission_name</td>
       <td><a type='button' class='btn btn-primary' herf='./index.php?mod=personnel_category&action=edit_get'>修改</a></td>
      </tr>";
    }
    
    
    ?>
      
    </tbody>
  </table>
</div>
