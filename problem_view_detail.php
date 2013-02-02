<?php
/*
 * @auther lion	
 * @date 2013-2-2
 */
$problem = unserialize ( $_SESSION ['problem'] );
$id = $problem->id;
$problem_name_category = $problem->problem_name_category;
$supplier_id = $problem->supplier_id;
$supplier_name = $problem->supplier_name;
$description=$problem->description;
$note = $problem->note;
unset ( $_SESSION ["problem"] );
$_SESSION ['id'] = $id;
?>
<div class="span7" style="margin-left: auto;margin-right: auto;">
<h3>合作问题记录</h3>
<table class="table table-bordered table-hover ">
<thead >
<tr><th colspan="4">基本信息</th></tr>
</thead>

<tr>
<td >合作问题类型</td><td ><?=$problem_name_category?></td>
</tr>
<tr >
<td >供应商</td><td ><?=$supplier_name?></td>
</tr>
<tr >
<td >问题描述</td><td ><?=$description?></td>
</tr>

<tr>
<td >备注</td><td  colspan="3"><?=$note?></td>
</tr>


</table>
<a class='btn btn-primary' href='./index.php?mod=problem&action=edit_get&eid=<?=$id?>'>修改</a>
<a   class="btn" href="javascript:history.go(-1);">返回</a>
</div>