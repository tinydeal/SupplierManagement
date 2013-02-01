<?php
/*
 * @auther lion	
 * @date 2013-2-1
 */



require_once 'class/goods_category_service.class.php';
require_once 'class/goods_category.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$goods_category_service=new GoodsCategoryService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=goods_category&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=trim($_GET["keywords"]);
		if(!empty($keywords)){
			$array_goods_category=$goods_category_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
			$nums=$goods_category_service->getListRowsByKeywords($keywords);
			$url="index.php?mod=goods_category&action=ls&keywords=$keywords&p=";
		}else{
			$array_goods_category=$goods_category_service->listAll($pageCurrent,$page_size);
			$nums=$goods_category_service->getListRows();
		}
}else{
$array_goods_category=$goods_category_service->listAll($pageCurrent,$page_size);
$nums=$goods_category_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="goods_category">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">产品分类管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=goods_category&action=add_get' style="float: right;">新增产品分类</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>分类名称</th>
        <th>操作</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_goods_category as $goods_category){
    	echo "<tr> 
    	<td>$goods_category->goods_category_name</td>
       <td><a class='btn btn-primary' href='./index.php?mod=goods_category&action=edit_get&eid=".$goods_category->id."'>修改</a></td>
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
  				$('#keywords').val("<?=$keywords?>"); 
                     } );
</script>