<?php
/*
 * @auther lion
 * @date 2013-2-1
 */
$goods = unserialize ( $_SESSION ['goods'] );
$id = $goods->id;
$goods_name = $goods->goods_name;
$goods_category_id = $goods->goods_category_id;
$goods_category_name=$goods->goods_category_name;
$system_number=$goods->system_number;
$price = $goods->price;
$size = $goods->size;
$color = $goods->color;
$description = $goods->description;
$website = $goods->website;
$note = $goods->note;
unset ( $_SESSION ["goods"] );
?>
<div class="span7" style="margin-left: auto;margin-right: auto;">
<h3>产品信息</h3>
<table class="table table-bordered table-hover ">
<thead >
<tr><th colspan="4">基本信息</th></tr>
</thead>

<tr>
<td >产品名称</td><td ><?php echo $goods_name?></td>
<td >产品分类</td><td ><?php echo $goods_category_name?></td>
</tr>
<tr >
<td >系统编号</td><td ><?php echo $system_number?></td>
<td >价格</td><td ><?php echo $price?></td>
</tr>
<tr >
<td >规格</td><td ><?php echo $size?></td>
<td >颜色</td><td ><?php echo $color?></td>
</tr>

<tr>
<td >描述</td><td  colspan="3"><?php echo $description?></td>
</tr>

<tr>
<td >网址</td><td  colspan="3"><?php echo $website?></td>
</tr>

<tr>
<td >备注</td><td  colspan="3"><?php echo $note?></td>
</tr>


</table>
<a class='btn btn-primary' href='./index.php?mod=goods&action=edit_get&eid=<?php echo $id?>'>修改</a>
<a   class="btn" href="javascript:history.go(-1);">返回</a>
</div>