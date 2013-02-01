<?php
/*
 * @auther lion
 * @date 2013-2-1
 */
require_once 'class/goods_service.class.php';
require_once 'class/goods.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$goods_service=new GoodsService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=goods&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=trim($_GET["keywords"]);
		if(!empty($keywords)){
		$array_goods=$goods_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
		$nums=$goods_service->getListRowsByKeywords($keywords);
		$url="index.php?mod=goods&action=ls&keywords=$keywords&p=";
		}else{
			$array_goods=$goods_service->listAll($pageCurrent,$page_size);
			$nums=$goods_service->getListRows();
		}
}else{
$array_goods=$goods_service->listAll($pageCurrent,$page_size);
$nums=$goods_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="goods">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">产品管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=goods&action=add_get' style="float: right;">新增产品</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>产品名称</th> 
        <th>产品类别</th> 
        <th>系统编号</th> 
        <th>价格</th> 
        <th>规格</th> 
        <th>颜色</th> 
        <th>操作</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_goods as $goods){
    	echo "<tr> 
    	<td><a href='./index.php?mod=goods&action=detail&did=$goods->id'>$goods->goods_name</td>
    	<td>$goods->goods_category_name</td>
    	<td>$goods->system_number</td>
    	<td>$goods->price</td>
    	<td>$goods->size</td>
    	<td>$goods->color</td>
       <td><a class='btn btn-primary' href='./index.php?mod=goods&action=edit_get&eid=".$goods->id."'>修改</a></td>
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