<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

setlocale(LC_ALL, 'en_US.UTF8');
mb_internal_encoding("UTF-8");

define('Site_Version', '?v=01');

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "firmstep");
define("DB_PORT", 3306);
define("DB_CHARSET", "utf8");
?>