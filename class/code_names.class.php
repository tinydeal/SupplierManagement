<?php
class CodeNames {
	public static $permission_name_procurement = "permission_name_procurement";
	public static $permission_name_order = "permission_name_order";
	public static $permission_name_administrator = "permission_name_administrator";
	public static $permission_name = array ('permission_name_procurement' => "采购", 'permission_name_order' => "下单", 'permission_name_administrator' => "系统管理" );
	public static $permission_search_replace = array ('采购' => "permission_name_procurement", '下单' => "permission_name_order", '系统管理' => "permission_name_administrator" );
	public static $user_state_disable = "user_state_disable";
	public static $user_state_normal = "user_state_normal";
	public static $user_state = array ('user_state_normal' => "正常", 'user_state_disable' => "禁用" );
	public static $user_search_replace = array ('正常' => "user_state_normal", '禁用' => "user_state_disable" );
	public static $order_status_pending_audit = "order_status_pending_audit"; //待审核
	public static $order_status_audited = "order_status_audited"; //已审核
	public static $order_status_procurement = "order_status_procurement"; //采购中 
	public static $order_status_completed = "order_status_completed"; //已完成
	public static $order_status = array ('order_status_pending_audit' => "待审核", 'order_status_audited' => "已审核", 'order_status_procurement' => "采购中", 'order_status_completed' => "已完成" );
	public static $order_status_search_replace = array ('待审核' => "order_status_pending_audit", '已审核' => "order_status_audited", '采购中' => "order_status_procurement", '已完成' => "order_status_completed" );

}
?>