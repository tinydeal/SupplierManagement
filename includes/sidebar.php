<?php
/*
 * @auther lion
 * @date 2013-1-26
 */
?>

<ul class="nav nav-pills nav-stacked">
	<li class="active" id="home"><a href="index.php?mod=home">首页</a></li>
	<?php
		switch($_SESSION['user_permission_name']){
		case 'permission_name_procurement':			
			echo "<li id='supplier_category'><a href='index.php?mod=supplier_category'>供应商分类管理</a></li>
	<li id='supplier'><a href='index.php?mod=supplier'>供应商管理</a></li>
	<li id='goods_category'><a href='index.php?mod=goods_category'>产品分类管理</a></li>	
	<li id='goods'><a href='index.php?mod=goods'>产品管理</a></li>";
			break;
		case 'permission_name_order':
			echo "<li id='order'><a href='index.php?mod=order'>产品采购单管理</a></li>
	<li id='problem'><a href='index.php?mod=problem'>合作问题记录管理</a></li>";
			break;
		case 'permission_name_administrator':
			echo "<li id='supplier_category'><a href='index.php?mod=supplier_category'>供应商分类管理</a></li>
	<li id='supplier'><a href='index.php?mod=supplier'>供应商管理</a></li>
	<li id='goods_category'><a href='index.php?mod=goods_category'>产品分类管理</a></li>	
	<li id='goods'><a href='index.php?mod=goods'>产品管理</a></li><li id='order'><a href='index.php?mod=order'>产品采购单管理</a></li>
	<li id='problem'><a href='index.php?mod=problem'>合作问题记录管理</a></li><li id='personnel_category'><a href='index.php?mod=personnel_category'>人员分类管理</a></li>
	<li id='user'><a href='index.php?mod=user'>人员管理</a></li>
	<li id='log'><a href='index.php?mod=log'>系统日志</a></li>";
			break;
	}
	?>	
</ul>
<script type="text/javascript">
var GET = $.urlGet();
var mod = GET['mod']; 
$('.nav li').removeClass("active");
$('#'+mod).toggleClass("active");
</script>