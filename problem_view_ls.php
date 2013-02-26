<?php
/*
 * @auther lion
 * @date 2013-2-2
 */
require_once 'class/problem_service.class.php';
require_once 'class/problem.class.php';
require_once 'class/sub_pages.class.php';
require_once 'class/code_names.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$problem_service=new ProblemService();
//总条目数 

//每次显示的页数  
$sub_pages=10; 

$url="index.php?mod=problem&action=ls&p=";
if(isset($_GET["keywords"])){
		$keywords=trim($_GET["keywords"]);
		if(!empty($keywords)){
		$array_problem=$problem_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
		$nums=$problem_service->getListRowsByKeywords($keywords);
		$url="index.php?mod=problem&action=ls&keywords=$keywords&p=";
		}else{
			$array_problem=$problem_service->listAll($pageCurrent,$page_size);
			$nums=$problem_service->getListRows();
		}
}else{
$array_problem=$problem_service->listAll($pageCurrent,$page_size);
$nums=$problem_service->getListRows();
}

?>

<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="problem">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">合作问题记录管理</a>
   
  </li>
  <a type='button' class='btn btn-primary' href='./index.php?mod=problem&action=add_get' style="float: right;">新增问题记录</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>问题类型</th> 
        <th>供应商名称</th> 
        <th>描述</th> 
        <th>操作</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_problem as $problem){
    	echo "<tr> 
    	<td><a href='./index.php?mod=problem&action=detail&did=$problem->id'>$problem->problem_name_category</td>
    	<td>$problem->supplier_name</td>
    	<td>$problem->description</td>
       <td><a class='btn btn-primary' href='./index.php?mod=problem&action=edit_get&eid=".$problem->id."'>修改</a></td>
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