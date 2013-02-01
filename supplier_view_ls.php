<?php
/*
 * @auther udzhou
 * @date 2013-2-1
 */
require_once 'class/supplier_service.class.php';
//require_once 'class/supplier.class.php';
require_once 'class/sub_pages.class.php';

if(isset($_GET["p"]))
  $pageCurrent=$_GET["p"];  
else
    $pageCurrent=1; 
//每页显示的条数  
$page_size=10;    
$supplier_service=new SupplierService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=supplier&action=ls&p=";
if(isset($_GET["keywords"])){
    $keywords=$_GET["keywords"];
    $array_supplier=$supplier_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
    $nums=$supplier_service->getListRowsByKeywords($keywords);
    if(!empty($keywords)){
      $url="index.php?mod=supplier&action=ls&keywords=$keywords&p=";
    }
  }else{
  $array_supplier=$supplier_service->listAll($pageCurrent,$page_size);
  $nums=$supplier_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="supplier">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">供应商管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=supplier&action=add_get' style="float: right;">新增供应商</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>供应商名称</th>
        <th>类别</th>
        <th>批价区间</th>       
        <th>产品风格</th>
        <th>产品属类</th>
        <th>图片</th>
        <th>网址</th>
        <th>联系人</th>
        <th>手机</th>        
        <th>地址</th>
        <th>备注</th>        
        <th>操作</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_supplier as $supplier){
      if($supplier->is_provide_pictures){
        $supplier->is_provide_pictures="有";
      }else{
        $supplier->is_provide_pictures="无";
      }       
      echo "<tr> 
      <td>$supplier->supplier_name</td>
      <td>$supplier->supplier_category_name</td>
      <td>$supplier->wholesale_num_min~$supplier->wholesale_num_max</td>      
      <td>$supplier->goods_style</td> 
      <td>$supplier->goods_category</td>     
      <td>$supplier->is_provide_pictures</td>
      <td>$supplier->website</td>
      <td>$supplier->linkman</td> 
      <td>$supplier->telephone</td>      
      <td>$supplier->province$supplier->city$supplier->village$supplier->address_detial</td>
      <td>$supplier->note</td>          
      <td><a class='btn btn-primary' href='./index.php?mod=supplier&action=edit_get&eid=".$supplier->id."'>修改</a></td>
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
