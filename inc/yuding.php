<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-config.php');

$yd_name = htmlspecialchars($_POST['yd-name']);
$yd_url = htmlspecialchars($_POST['yd-url']);
$yd_phone = htmlspecialchars($_POST['yd-phone']);
$yd_jihua = htmlspecialchars($_POST['yd-jihua']);
$yd_date = date('Y-m-d');

global $wpdb;
$wpdb->insert('yd',array('ID'=>NULL,'yd_name'=>$yd_name,'yd_url'=>$yd_url,'yd_phone'=>$yd_phone,'yd_jihua'=>$yd_jihua,'yd_date'=>$yd_date));
$wpdb->close();
?>