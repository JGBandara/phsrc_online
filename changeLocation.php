<?php
session_start();
if(isset($_REQUEST['id']) && $_REQUEST['id']!==""){
  $_SESSION["locationId"] = $_REQUEST['id'];
}
$ex = $_REQUEST['ex'];
$q = $_REQUEST['q'];
header('Location: https://phsrc.lk/phsrc_online/main.php');
//    header('Location: http://core.sethsiri.com/main.php');