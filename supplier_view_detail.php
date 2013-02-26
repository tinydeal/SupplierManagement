<?php
/*
 * @auther udzhou	
 * @date 2013-2-1
 */
require_once 'class/supplier_category_service.class.php';

$supplier=unserialize($_SESSION['supplier']);
$id=$supplier->id;
$supplier_name=$supplier->supplier_name;
$supplier_category_id=$supplier->supplier_category_id;
$supplier_category_name=$supplier->supplier_category_name;
$wholesale_num_min=$supplier->wholesale_num_min;
$wholesale_num_max=$supplier->wholesale_num_max;
$goods_style=$supplier->goods_style;
$goods_category=$supplier->goods_category;
if($supplier->is_provide_pictures){
        $is_provide_pictures="有";
      }else{
        $is_provide_pictures="无";
}   
$website=$supplier->website;
$linkman=$supplier->linkman;
$telephone=$supplier->telephone;
$province=$supplier->province;
$city=$supplier->city;
$village=$supplier->village;
$address_detial=$supplier->address_detial;
$note=$supplier->note;
unset($_SESSION["supplier"]);
?>
<div class="span12" style="margin-left: auto;margin-right: auto;">
<h3 style="float:left">供应商信息</h3>
<div style="float:right;margin-top:12px">
<a class='btn btn-primary' href='./index.php?mod=supplier&action=edit_get&eid=<?php echo $id?>'>修改</a>
<a class="btn" href="javascript:history.go(-1);">返回</a>
</div>
<table class="table table-bordered table-hover ">
<thead >
<tr><th colspan="4">基本信息</th>

</tr>
</thead>

<tr>
<td >供应商名称</td><td ><?php echo $supplier_name?></td>
<td >类别</td><td ><?php echo $supplier_category_name?></td>
</tr>
<tr >
<td >批价区间</td><td ><?php echo $wholesale_num_min?>~<?=$wholesale_num_max?></td>
<td >产品风格</td><td ><?php echo $goods_style?></td>
</tr>
<tr >
<td >产品属类</td><td ><?php echo $goods_category?></td>
<td >图片</td><td ><?php echo $is_provide_pictures?></td>
</tr>
<tr >
<td >网址</td><td ><?php echo $website?></td>
<td >联系人</td><td ><?php echo $linkman?></td>
</tr>
<tr >
<td >手机</td><td ><?php echo $telephone?></td>
<td >地址</td><td ><?php echo $province.$city.$village.$address_detial?></td>
</tr>

<tr>
<td >备注</td><td  colspan="3"><?=$note?></td>
</tr>


</table>
</div>


<?php
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
$sql="select t_goods.* from t_goods,t_supplier_rel_goods where t_goods.id=t_supplier_rel_goods.goods_id and t_supplier_rel_goods.supplier_id=".$id;
$url="index.php?mod=supplier&action=detial&p=";
$array_goods=$goods_service->listAll($pageCurrent,$page_size,
$sql);
$nums=$goods_service->getListRows("select count(*) from t_goods,t_supplier_rel_goods where t_goods.id=t_supplier_rel_goods.goods_id and t_supplier_rel_goods.supplier_id=".$id);
?>


<div class="span12" style="margin-left: auto;margin-right: auto;">
<div class="datatable">

<ul class="nav nav-tabs">
  <li class="active">
    <a href="#">供应商产品信息</a>
   
  </li>
  <a href="#addGoods" role="button" class='btn btn-primary' data-toggle="modal" style="float: right;">添加供应商产品</a>
</ul>

<table class="table table-bordered table-striped  table-hover" id="tableAddGoods">
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
</div>





<?php   
$goods_service=new GoodsService();
$page_size=$goods_service->getListRows("SELECT COUNT(*) FROM t_goods WHERE t_goods.id NOT IN(SELECT goods_id FROM t_supplier_rel_goods WHERE t_supplier_rel_goods.supplier_id=".$id.")");
$sql="select t_goods.* from t_goods where t_goods.id NOT IN(SELECT goods_id FROM t_supplier_rel_goods WHERE t_supplier_rel_goods.supplier_id=".$id.")";
$array_goods=$goods_service->listAll(1,$page_size,
$sql);

?>
<!-- Modal -->
<div id="addGoods" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">添加供应商产品</h3>
  </div>
  <div class="modal-body">
   <form class="form-horizontal" action="./index.php?mod=supplier&action=detail&did=<?=$id?>" method="post">
  <div class="control-group">
    <table class="table table-bordered table-striped  table-hover" id="tableModal">
  <thead>
      <tr>
        <th>产品名称</th> 
        <th>产品类别</th> 
        <th>系统编号</th> 
        <th>价格</th> 
        <th>规格</th> 
        <th>颜色</th> 
        <th>添加</th> 
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
      <td><label class='checkbox inline'><input name='goods_id[]' type='checkbox' id='$goods->id' value='$goods->id'>
      </label></td>
      </tr>";
    }      
    ?>      
    </tbody>
  </table>
  <input style="display:none" id="submit"  type="submit" class="btn btn-primary" />
  </div>  
</form>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
    <button id="save" class="btn btn-primary" data-dismiss="modal">保存</button>   
  </div>
</div>
 <script type="text/javascript">    
    $('#save').click(function(){
      $('#submit').click();       
    });           
</script>