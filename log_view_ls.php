<?php
/*
 * @auther udzhou
 * @date 2013-1-30
 */
require_once 'class/log_service.class.php';
//require_once 'class/log.class.php';
require_once 'class/sub_pages.class.php';

if(isset($_GET["p"]))
	$pageCurrent=$_GET["p"];  
else
  	$pageCurrent=1; 
//每页显示的条数  
$page_size=10;   	
$log_service=new LogService();
//总条目数 
$nums=$log_service->getListRows();
//每次显示的页数  
$sub_pages=10;  
$url="index.php?mod=log&action=ls&p=";
if(isset($_GET["keywords"])){
    $keywords=$_GET["keywords"];
    $array_log=$log_service->listAllByKeywords($pageCurrent,$page_size,$keywords);
    $nums=$log_service->getListRowsByKeywords($keywords);
    if(!empty($keywords)){
      $url="index.php?mod=log&action=ls&keywords=$keywords&p=";
    }
}else{
$array_log=$log_service->listAll($pageCurrent,$page_size);
$nums=$log_service->getListRows();
}
?>


<div class="search-form">
<form class="form-inline" action="./index.php" method="get">
   
  <input type="hidden" class="search-query" name="mod" value="log">
  <input type="hidden" class="search-query" name="action" value="ls">
  <input type="text" class="search-query" name="keywords" id="keywords">
  <button type="submit" class="btn">搜索</button>
</form>
</div>


<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">系统日志</a>   
  </li> 
</ul>

<table class="table table-bordered table-striped  table-hover" id="table">
  <thead>
      <tr>
        <th>操作信息</th>
        <th>操作人</th>
        <th>修改时间</th>
        <th>日志创建时间</th>
      </tr>
    </thead>
    <tbody>
    <?php 
    foreach ($array_log as $log){
    	echo "<tr> 
    	<td>$log->operation_msg</td>  
        <td>$log->username</td>
       <td>$log->modified</td>
       <td>$log->created</td>
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
          $('#keywords').val("<?php echo $_GET["keywords"]?>");
                     } );
</script>