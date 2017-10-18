<?php
require 'dirset.php';
include $strRootP.'\include\page-top.php';

session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
$_SESSION = array();
session_regenerate_id(true);

header('Location: index.php');
die();
?>