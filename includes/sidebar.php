<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
?>

<ul class="nav nav-pills nav-stacked">
	<li class="active"><a href="#">首页</a></li>
	<li><a href="#">供应商分类管理</a></li>
	<li><a href="#">供应商管理</a></li>
	<li><a href="#">产品管理</a></li>
	<li><a href="#">产品采购单管理</a></li>
	<li><a href="#">合作问题记录管理</a></li>
	<li id="personnel_category"><a href="#">人员分类管理</a></li>
	<li ><a href="#">人员管理</a></li>
</ul>
<script type="text/javascript">
var GET = $.urlGet();
var mod = GET['mod']; 
$('.nav li').removeClass("active");
$('#'+mod).toggleClass("active");
</script>