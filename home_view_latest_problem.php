<?php
/*
 * @auther udzhou
 * @date 2013 2-4
 */
require_once 'class/problem_service.class.php';
require_once 'class/problem.class.php';
require_once 'class/sub_pages.class.php';
if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$problem_service=new ProblemService();
//总条目数 
//$sql="select * from t_problem order by modified desc";
//每次显示的页数  
$sub_pages=10; 
$url="index.php?mod=problem&action=ls&p=";
$array_problem=$problem_service->listAll($pageCurrent,$page_size);
$nums=$problem_service->getListRows();


?>
<ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="./index.php?mod=home&action=latest_problem">最新问题</a></li>
  <li><a href="./index.php?mod=home&action=price_change">价格变化</a></li>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="price_change">
  	<table class="table table-bordered table-striped  table-hover" id="table">
  	<thead>
      <tr>
        <th>问题类型</th>          
        <th>描述</th> 
        <th>时间</th>
        <th>操作</th> 
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_problem as $problem){
    	echo "<tr> 
    	<td><a href='./index.php?mod=problem&action=detail&did=$problem->id'>$problem->problem_name_category</td>
    	<td>$problem->description</td>
    	<td>$problem->modified</td>
       <td><a class='btn btn-primary' href='./index.php?mod=problem&action=detail&did=$problem->id'>查看</a></td>
      </tr>";
    }
    
    
    ?>
      
    </tbody>
  </table>
  	<?php
	  $subPages=new SubPages($page_size,$nums,$pageCurrent,$sub_pages,$url);
  	?>
  </div>  
</div>