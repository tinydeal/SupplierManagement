<?php
/*
 * @auther lion
 * @date 2013-1-31
 */
$username = $_GET ['username'];
require_once 'class/user.class.php';
require_once 'class/user_service.class.php';
$user = new User ( null, null, null, null, $username, null, null, null, null, null );
$user_service = new UserService ();
$rs ['status'] = $user_service->checkUsername ($user );
echo json_encode ( $rs );
?>