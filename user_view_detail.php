<?php
/*
 * @auther lion	
 * @date 2013-1-31
 */
require_once 'class/user.class.php';
require_once 'class/user_service.class.php';
require_once 'class/code_names.class.php';

$user=unserialize($_SESSION['user']);
$id=$user->id;
$name=$user->name;
$category_name=$user->category_name;
$username=$user->username;
$telephone=$user->telephone;
$email=$user->email;
$state=$user->state;
$note=$user->note;
unset($_SESSION["user"]);
?>
<div class="span7" style="margin-left: auto;margin-right: auto;">
<h3>人员信息</h3>
<table class="table table-bordered table-hover ">
<thead >
<tr><th colspan="4">基本信息</th></tr>
</thead>

<tr>
<td >用户名</td><td ><?=$username?></td>
<td >人员类型</td><td ><?=$category_name?></td>
</tr>
<tr >
<td >姓名</td><td ><?=$name?></td>
<td >电话</td><td ><?=$telephone?></td>
</tr>
<tr >
<td >电子邮箱</td><td ><?=$email?></td>
<td >账号状态</td><td ><?=CodeNames::$user_state[$state]?></td>
</tr>

<tr>
<td >备注</td><td  colspan="3"><?=$note?></td>
</tr>


</table>
<a class='btn btn-primary' href='./index.php?mod=user&action=edit_get&eid=<?=$id?>'>修改</a>
<a   class="btn" href="javascript:history.go(-1);">返回</a>
</div>