<?php
/*
 * @auther lion
 * @date 2013-1-30
 */
require_once 'class/personnel_category_service.class.php';
require_once 'class/personnel_category.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$personnel_category_service=new PersonnelCategoryService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=personnel_category&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=trim($_GET["keywords"]);
		if(!empty($keywords)){
		$array_personnel_category=$personnel_category_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
		$nums=$personnel_category_service->getListRowsByKeywords($keywords);
		$url="index.php?mod=personnel_category&action=ls&keywords=$keywords&p=";
		}else{
			$array_personnel_category=$personnel_category_service->listAll($pageCurrent,$page_size);
			$nums=$personnel_category_service->getListRows();
		}
}else{
$array_personnel_category=$personnel_category_service->listAll($pageCurrent,$page_size);
$nums=$personnel_category_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="personnel_category">
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
        <td>".CodeNames::$permission_name[$personnel_category->permission_name]."</td>
       <td><a class='btn btn-primary' href='./index.php?mod=personnel_category&action=edit_get&eid=".$personnel_category->id."'>修改</a></td>
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
  				$('#keywords').val("<?php echo $keywords?>"); 
                     } );
</script>
