<?php
require_once 'class/database.class.php';
$db=Database::getInstance();
//printf("影响行数".$db->Execute("insert into personnel_category (category_name) values ('小坑坑')"));
//print_r("上次插入id".$db->getLastId());
print_r($db->getAll("select * from personnel_category ",1,10)) ;
?>